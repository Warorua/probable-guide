<?php include './includes/header.php' ?>
<?php

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch fields without sanitizing here because we have custom validation
    $type = $_POST['type'] ?? '';
    $docType = $_POST['doc_type'] ?? ''; // Using strip_tags for basic HTML tag removal
    $docNumber = $_POST['doc_number'] ?? '';

    // Sanitize the 'method' field to ensure it's an integer
    $type = filter_var($type, FILTER_SANITIZE_NUMBER_INT);
    
    // Sanitize 'doc_type' with strip_tags as previously discussed
    $docType = strip_tags($docType);

    // Custom validation for 'doc_number'
    if (strlen($docNumber) > 10 && strlen($docNumber) < 12) {
        // If more than 10 characters, letters are allowed so just sanitize for HTML content
        $docNumberSanitized = strip_tags($docNumber);
    } else {
        // If 10 characters or less, it should be all integers
        if (filter_var($docNumber, FILTER_VALIDATE_INT) === false) {
			//$_SESSION['info'] = 
            $_SESSION['info'] = "Invalid document number!";
			header('location: indVerify');
            return; // Stop further processing
        } else {
            $docNumberSanitized = $docNumber;
        }
    }

    // Continue with the method validation
    if (filter_var($type, FILTER_VALIDATE_INT) === false) {
        $_SESSION['info'] = "Invalid method value.";
		header('location: indVerify');
    } else if (!in_array($docType, ['id_no', 'passport', 'kra'])) {
        $_SESSION['info'] = "Invalid document type.";
		header('location: indVerify');
    } 
} else {
    // Form not submitted
    $_SESSION['info'] = "Please submit the form.";
	header('location: indVerify');
}

?>



<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			<?php include './includes/menu_stjhsfyj.php' ?>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header tablet and mobile-->
				<div class="header-mobile py-3">
					<!--begin::Container-->
					<div class="container d-flex flex-stack">
						<!--begin::Mobile logo-->
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
							<a href="./index.html">
								<img alt="Logo" src="./assets/media/logos/logo-demo9.svg" class="h-35px" />
							</a>
						</div>
						<!--end::Mobile logo-->
						<!--begin::Aside toggle-->
						<button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
							<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
							<span class="svg-icon svg-icon-2x me-n1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
									<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</button>
						<!--end::Aside toggle-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header tablet and mobile-->
				<!--begin::Header-->
				<?php include './includes/topbar_asgklamd.php' ?>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Container-->
					<div class="container-xxl" id="kt_content_container">
						<!--begin::Layout-->
						<div class="d-flex flex-column flex-lg-row">

							<div id="querySidebar">
								<!--begin::Sidebar-->
								<div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
									<!--begin::Card-->
									<div class="card mb-5 mb-xl-8">
										<!--begin::Card body-->
										<div class="card-body">
											<!--begin::Summary-->
											<!--begin::User Info-->
											<div class="d-flex flex-center flex-column py-5">
												<!--begin::Avatar-->
												<div class="symbol symbol-100px symbol-circle mb-7">
													<img src="./assets/media/avatars/300-6.jpg" alt="image" />
												</div>
												<!--end::Avatar-->
												<!--begin::Name-->
												<a href="#" class="fs-3 btn btn-primary fw-bolder mb-3 disabled placeholder col-4" aria-hidden="true"></a>
												<!--end::Name-->
												<!--begin::Position-->
												<div class="mb-9">
													<!--begin::Badge-->
													<span class="badge badge-lg badge-light-primary placeholder col-6"></span>
													<!--begin::Badge-->
												</div>
												<!--end::Position-->
												<!--begin::Info-->
											</div>
											<!--end::User Info-->
											<!--end::Summary-->
											<!--begin::Details toggle-->
											<div class="d-flex flex-stack fs-4 py-3">
												<div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Registry of Persons Profile
													<span class="ms-2 rotate-180">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
												</div>

											</div>
											<!--end::Details toggle-->
											<div class="separator"></div>
											<!--begin::Details content-->
											<div id="kt_user_view_details" class="collapse show">
												<div class="pb-5 fs-6">
													<p class="bg-secondary rounded border border-transparent h-600px w-100" aria-hidden="true">
														<span class="placeholder"></span>
													</p>
												</div>
											</div>
											<!--end::Details content-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->

									<!--begin::Card-->
									<div class="card mb-5 mb-xl-8">
										<!--begin::Card body-->
										<div class="card-body">
											<!--begin::Details toggle-->
											<div class="d-flex flex-stack fs-4 py-3">
												<div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details2">KRA Profile
													<span class="ms-2 rotate-180">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
												</div>

											</div>
											<!--end::Details toggle-->
											<div class="separator"></div>
											<!--begin::Details content-->
											<div id="kt_user_view_details2" class="collapse show">
												<div class="pb-5 fs-6">
													<p class="bg-secondary rounded border border-transparent h-600px w-100" aria-hidden="true">
														<span class="placeholder"></span>
													</p>
												</div>
											</div>
											<!--end::Details content-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->


								</div>
								<!--end::Sidebar-->
							</div>


							<!--begin::Content-->
							<div class="flex-lg-row-fluid ms-lg-15">

								<!--begin:::Tabs-->
								<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
									<!--begin:::Tab item-->
									<li class="nav-item">
										<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
									</li>
									<!--end:::Tab item-->
									<!--begin:::Tab item-->
									<li class="nav-item">
										<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Expound Data</a>
									</li>
									<!--end:::Tab item-->
									<!--begin:::Tab item-->
									<li class="nav-item">
										<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Documents</a>
									</li>
									<!--end:::Tab item-->
								</ul>
								<!--end:::Tabs-->
								<!--begin:::Tab content-->
								<div class="tab-content" id="myTabContent">

									<!--begin:::Tab pane-->
									<div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
										<!--begin::Card-->
										<div class="card pt-4 mb-6 mb-xl-9">
											<!--begin::Card header-->
											<div class="card-header mt-6">
												<!--begin::Card title-->
												<div class="card-title flex-column">
													<h2 class="mb-1">AI-Powered User Insights Overview</h2>
													<div class="fs-6 fw-bold text-muted">Unlock Insights, Empower Decisions: AI-Driven Intelligence</div>
												</div>
												<!--end::Card title-->
												<!--begin::Card toolbar-->
											</div>
											<!--end::Card header-->
											<!--begin::Card body-->
											<div class="card-body pt-0 pb-5" id="theAIBlock">
												<p class="bg-secondary rounded border border-transparent h-1000px w-100 mt-12" aria-hidden="true">
													<span class="placeholder"></span>
												</p>
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end:::Tab pane-->
									<!--begin:::Tab pane-->
									<div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
										<!--begin::Card-->
										<div class="card pt-4 mb-6 mb-xl-9">
											<!--begin::Card header-->
											<div class="card-header border-0">
												<!--begin::Card title-->
												<div class="card-title">
													<h2>Common data Profile</h2>
												</div>
												<!--end::Card title-->
											</div>
											<!--end::Card header-->
											<!--begin::Card body-->
											<div class="card-body pt-0 pb-5" id="expoundDataHtml">
												<p class="bg-secondary rounded border border-transparent h-1000px w-100 mt-12" aria-hidden="true">
													<span class="placeholder"></span>
												</p>
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end:::Tab pane-->
									<!--begin:::Tab pane-->
									<div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
										<!--begin::Card-->
										<div class="card pt-4 mb-6 mb-xl-9">
											<!--begin::Card header-->
											<div class="card-header border-0">
												<!--begin::Card title-->
												<div class="card-title">
													<h2>Availabe User Documents</h2>
												</div>
												<!--end::Card title-->
											</div>
											<!--end::Card header-->
											<!--begin::Card body-->
											<div class="card-body pt-0 pb-5">
												<p class="bg-secondary rounded border border-transparent h-1000px w-100 mt-12" aria-hidden="true">
													<span class="placeholder"></span>
												</p>
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end:::Tab pane-->
								</div>
								<!--end:::Tab content-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Layout-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div class="container-xxl d-flex flex-column flex-md-row flex-stack">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-gray-400 fw-bold me-1">Created by</span>
							<a href="https://keenthemes.com/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Keenthemes</a>
						</div>
						<!--end::Copyright-->
						<!--begin::Menu-->
						<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
							<li class="menu-item">
								<a href="https://keenthemes.com/" target="_blank" class="menu-link px-2">About</a>
							</li>
							<li class="menu-item">
								<a href="https://devs.keenthemes.com/" target="_blank" class="menu-link px-2">Support</a>
							</li>
							<li class="menu-item">
								<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
							</li>
						</ul>
						<!--end::Menu-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->
	<!--begin::Drawers-->

	<!--end::Drawers-->
	<!--end::Main-->
	<!--begin::Engage drawers-->


	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
	<!--begin::Modals-->

	<!--end::Modals-->
	<?php include './includes/scripts_aselkawer89.php' ?>

</body>
<!--end::Body-->
<?php include './includes/alert.php' ?>
<!--apps/user-management/users/view.html :01:58-->
<script>
	var target = document.querySelector("#content");

	var blockUI = new KTBlockUI(target, {
		message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
		overlayClass: "bg-secondary bg-opacity-25 rounded border border-transparent",
	});
</script>
<script>
	$(document).ready(function() {
		blockUI.block();
		// Define the data to be sent
		var dataToSend = <?php echo json_encode($_POST) ?>;

		// Perform the AJAX request
		$.ajax({
			url: 'queryEngine', // Replace with your endpoint URL
			type: 'POST',
			data: dataToSend,
			dataType: 'json', // Expecting JSON response
			success: function(response) {
				blockUI.release();
				// Assuming 'response' is the JSON object received from the server
				// Update the HTML elements based on the response keys
				try {
					// Now response is expected to be a JSON object
					// Check for required keys in the response
					if ('expoundDataHtml' in response && 'json' in response && 'sidebar' in response) {
						$('#expoundDataHtml').html(response.expoundDataHtml);
						$('#json').html(JSON.stringify(response.json, null, 2));
						$('#querySidebar').html(response.sidebar);

						var dataToSendNext = response.json;
						console.log("Data to send in the second request:", dataToSendNext);
						var payload = dataToSendNext;

						var target = document.querySelector("#theAIBlock");

						var AIblock = new KTBlockUI(target, {
							message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
							overlayClass: "bg-secondary bg-opacity-25 rounded border border-transparent",
						});
						AIblock.block();
						$.ajax({
							url: 'gptEngine', // Replace with your endpoint URL
							type: 'POST',
							data: {
								payload: payload
							},
							dataType: 'json', // Expecting JSON response
							success: function(response2) {
								AIblock.release();
								// Assuming 'response' is the JSON object received from the server
								// Update the HTML elements based on the response keys
								try {
									// Now response is expected to be a JSON object
									// Check for required keys in the response
									if ('gptRes' in response2) {
										$('#theAIBlock').html(response2.gptRes);

									} else if('error' in response2) {
										// If any of the keys are missing, alert the user
										alert(response2.error);
									} else {
										// If any of the keys are missing, alert the user
										alert("Required information is missing from the response.");
									}
								} catch (e) {
									// If response cannot be processed
									alert("Error processing the response.");
								}
							},
							error: function(xhr, status, error) {
								console.error("Error occurred: " + error);
							}
						});
					} else {
						// If any of the keys are missing, alert the user
						alert("Required information is missing from the response.");
					}
				} catch (e) {
					// If response cannot be processed
					alert("Error processing the response.");
				}
			},
			error: function(xhr, status, error) {
				console.error("Error occurred: " + error);
			}
		});
	});
</script>

</html>
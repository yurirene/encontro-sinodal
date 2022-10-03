<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Encontro Sinodal</title>
	<meta content="I Encontro de Mocidades Presbiterianas do Sínodo Setentrional" name="description">
	<meta content="Encontro de Mocidade, Setentrional, UMP, UMP Amazonas, UMP Roraima, Jovens Presbiterianos, Presbiteriana, Amazonas" name="keywords">

	<!-- Favicons -->
	<link href="/favicon.png" rel="icon">
	<link href="/site/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="/site/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="/site/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/site/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="/site/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="/site/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="/site/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="/site/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="/site/assets/css/style.css" rel="stylesheet">

	<!-- =======================================================
	* Template Name: Arsha - v4.7.1
	* Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
	* Author: BootstrapMade.com
	* License: https://bootstrapmade.com/license/
	======================================================== -->

	<style>
		.check {
			position: relative !important;
			display: inline-block !important;
			border: 1px solid #a9a9a9 !important;
			border-radius: .25em !important;
			width: 1.3em !important;
			height: 1.3em !important;
			float: left !important;
			margin-right: .5em !important;
		}
	</style>
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top ">
		<div class="container d-flex align-items-center">
			<h1 class="logo me-auto"><a href="index.html">Camisa Encontro Sinodal</a></h1>
		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center">

		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
					<h1>Camisa do Encontro Sinodal</h1>
				</div>
				<div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
					<img src="/site/assets/img/encontro.png" class="img-fluid animated" alt="">
				</div>
			</div>
		</div>

	</section><!-- End Hero -->

	<main id="main">


		<!-- ======= About Us Section ======= -->
		<section id="about" class="about">
			<div class="container" data-aos="fade-up">

				<div class="section-title">
					<h2>Camisa</h2>
				</div>

				<div class="row content">
					<div class="col-lg-8 offset-lg-2">
						<div class="card p-5 shadow" style="border-radius: 20px; border-bottom-color: #08c788; border-bottom-width: 10px;">
							<div class="card-body">
								<img class="img-fluid" src="/site/assets/img/camisa.jpeg"></div>

							<br><br>

							<h2 class="text-center">R$ 35,00</h2>
						</div>
					</div>
				</div>

			</div>
		</section><!-- End About Us Section --
			<!-- ======= Services Section ======= -->
		
		<!-- ======= Contact Section ======= -->
		<section id="contact" class="contact">
			<div class="container" data-aos="fade-up">

				<div class="section-title">
					<h2>Peça Já a sua</h2>
				</div>

				<div class="row">
					<div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
						
						<form role="form" class="php-email-form">
							@csrf
							<div class="row">
								<div class="form-group col-md-6">
									<label for="nome">Nome</label>
									<input type="text" name="nome" class="form-control" id="nome" required>
								</div>
								<div class="form-group col-md-6">
									<label for="celular">Celular</label>
									<input type="text" class="form-control celular" name="celular" id="celular" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="federacao">Federação</label>
									<select class="form-control" name="federacao" id="federacao" required>
										<option value="">Selecione uma Federação</option>
										<option value="FAMP">FAMP</option>
										<option value="FEPAM">FEPAM</option>
										<option value="FMS">FMS</option>
										<option value="FMRR">FMRR</option>
										<option value="FPSAM">FPSAM</option>
										<option value="FPMAN">FPMAN</option>
										<option value="Outro">Outro</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="igreja">Igreja</label>
									<input type="text" class="form-control" name="igreja" id="igreja" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="quantidade">Quantidade</label>
									<input type="number" step="1" min="1" value="1" class="form-control" name="quantidade" id="quantidade" required>
								</div>
								<div class="form-group col-md-6">
									<label for="tamanho">Tamanho</label>
									<select class="form-control" name="tamanho" id="tamanho" required>
										<option value="">Selecione um tamanho</option>
										<option value="PP">PP</option>
										<option value="P">P</option>
										<option value="M">M</option>
										<option value="G">G</option>
										<option value="GG">GG</option>
									</select>
								</div>
							</div>
							
							<div class="text-center"><button type="submit">Confirmar</button></div>

						</form>
					</div>

				</div>

			</div>
		</section><!-- End Contact Section -->

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<footer id="footer">

		<div class="container footer-bottom clearfix">
			<div class="copyright">
				&copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
			</div>
			<div class="credits">
				<!-- All the links in the footer should remain intact. -->
				<!-- You can delete the links only if you purchased the pro version. -->
				<!-- Licensing information: https://bootstrapmade.com/license/ -->
				<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
				Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<div id="preloader"></div>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="/site/assets/vendor/aos/aos.js"></script>
	<script src="/site/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/site/assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="/site/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="/site/assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="/site/assets/vendor/waypoints/noframework.waypoints.js"></script>
	<script
	src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous"></script>
	<!-- Template Main JS File -->
	<script src="/site/assets/js/main.js"></script>
	<script src="/jquery.mask.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.13/dist/sweetalert2.all.min.js"></script>
	<script>

		$(document).ready(function(){
			$('.celular').mask('(00)00000-0000');
		});
	</script>
	@if(session()->has('mensagem') && session('mensagem') == true)
		<script>
			Swal.fire('Camisa Solicitada com Sucesso')
			.then((result) => {
				if (result.isConfirmed) {
					window.open("https://api.whatsapp.com/send?l=pt-BR&phone=5592988475481&text=Nome%20{{session('nome_inscrito')}}%2C%20Quantidade%20{{session('quantidade')}}", '_blank' );
				}
			})

		</script>
	@endif


	@if(session()->has('mensagem') && session('mensagem') == false)
		<script>
			Swal.fire('Erro ao Realizar Inscrição')
		</script>
	@endif
	
	@if($errors->any())
		@foreach($errors->all() as $error)
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Erro',
				text: '{{$error}}'
			});
		</script>
		@endforeach
	@endif
</body>

</html>
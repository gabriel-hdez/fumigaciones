<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 	FOOTER		-->
		<footer class="page-footer blue-grey darken-4 content <?php //if(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == TRUE){echo 'content';}?>">
			<div class="container">
				<div class="row">
					<div class="col s12 l6">
						<h4 class="white-text">
							<span style="font-weight: 800;"><?php echo strtoupper(APP_NAME);?></span>
						</h4>
						<p class="grey-text text-lighten-4">Fumigación integral, compra y venta de productos: insecticidas, fetilizantes y roenticidas.</p>
					</div>
					<!-- <div class="col s12 l3 offset-l3">
						<h5 class="white-text">Links de interes</h5>
						<ul>
							<li>
								<a class="grey-text text-lighten-3" href="#!">www.dace.upta.com</a>
							</li>
							<li>
								<a class="grey-text text-lighten-3" href="#!">www.uptadi.net</a>
							</li>
						</ul>
					</div> -->
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					Todos los derechos reservados <span>© <script type="text/javascript"> document.write(new Date().getFullYear()); </script>.
					</span>
					<!-- <span class="right">Página renderizada en <strong>{elapsed_time}</strong> segundos</span> -->
					<span class="right">Página renderizada en <strong id="rendered"></strong> segundos</span>
				</div>
			</div>
		</footer>
	</body>
</html>
<!-- Footer -->
<footer class="footer display-flex first-axe-sp-around second-axe-center <?php echo $bkgdColorHeadFoot; ?> white-font">
	
	<a href="#" class="white-font"><span>mentions légales</span></a>
	<a href="http://www.devzata.fr/" title="Développeur de cette application" target="_blank" class="white-font"><span>Devzata</span></a>
    
</footer>

</body>

	<!-- utilisation de jQuery : -->
<!-- 	<script
	src="https://code.jquery.com/jquery-3.1.1.min.js"
 	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  	crossorigin="anonymous"></script> -->
    
    <!-- lien vers feuille JS : -->
	<?php if ($activePage === 'bottle-selected-rud') { ?>
	    
	    <script src="js/basics.js"></script>

	<?php } else if ($activePage === 'user') { ?>

	    <script src="js/basics2.js"></script>

	<?php } ?>

</html>
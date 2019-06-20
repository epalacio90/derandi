<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/17/19
 * Time: 4:07 PM
 */
?>

<?php
//This will close a general component only if it is not set to the opposite
if(isset($container) && $container == 'false'){

}else{
    echo '</div>';
}
?>


<!-- ========================= FOOTER ========================= -->
<footer class="section-footer footerColor white">
    <div class="container">
        <section class="footer-bottom row">
            <div class="col-sm-6">
                <a href="#" onclick="sendWhatsApp()" class="text-white">
                    <i class="fa fa-whatsapp"><img src="<?php echo base_url('assets/public/images/whatsapp.png') ?>" style="height:45px"> Envíanos un whatsapp</i>
                </a>
            </div>
            <div class="col-sm-3">
               <center>
                   <a href="<?php site_url('privacy') ?>"  class="text-white">
                      Aviso de privacidad - Términos y condiciones
                   </a>
               </center>
            </div>

            <div class="col-sm-3">
                <p class="text-sm-right">
                    Copyright &copy 2019 <br>
                </p>
            </div>
        </section> <!-- //footer-top -->
    </div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
<script>
    function sendWhatsApp(){
        var body = "Estoy interesado en comprar en D'erandí";

        const urlString = "https://wa.me/52"+ '5549063308' + "?text=" + body;

        const uriParsed = encodeURI(urlString);

        var win = window.open(uriParsed, '_blank');
        //setTimeout(function() { win.close() }, 8000);

    }
</script>

</body>
</html>

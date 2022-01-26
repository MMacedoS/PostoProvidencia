  

        </div>
    </div>


    <script>
        let btn= document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');
        let search = document.querySelector('.bx-search');

        btn.onclick=function(){
            sidebar.classList.toggle("active");
        }
    </script>
    <script type="text/javascript" src="<?=ROTA_JS?>/sweetAlert.js"></script>
    <script type="text/javascript" src="<?=ROTA_JS?>/alerta-tempo.js"></script>

</body>
</html>
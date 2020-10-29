    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/responsive.bootstrap4.min.css">

     
    <!-- jQuery library -->
    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/fontawesome-free-5.13.0-web/css/all.min.css">
    
    <link rel="stylesheet" id="themeSelect">

    <!-- datatable -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/buttons.flash.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>


   

    <script>
        

      var getTheme = localStorage.getItem('Theme Name');

      var b = document.querySelector("#themeSelect");


      if(getTheme == "Green Light"){

        b.setAttribute('href' , "assets/css/theme1.css");
        
      }else if(getTheme == "Blue"){

        b.setAttribute('href' , "assets/css/style.css");

      }else if(getTheme == "Purple"){

        b.setAttribute('href' , "assets/css/theme2.css");

      }else if(getTheme == "Black"){

        b.setAttribute('href' , 'assets/css/theme3.css');

      }else if(getTheme == 'Dark Red'){

        b.setAttribute('href' , 'assets/css/theme4.css');
        
      }
    </script>
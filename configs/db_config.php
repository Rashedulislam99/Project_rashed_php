<?php   
   //Remote
   
    //  define("SERVER","localhost");
    //  define("USER","rashedul");
    //  define("DATABASE","wdpf66_rashedul");
    //  define("PASSWORD","7057@;;");

   //Local
   
    define("SERVER","localhost");
    define("USER","root");//rajib
    define("DATABASE","wdpfsms");
    define("PASSWORD","");

    $db=new mysqli(SERVER,USER,PASSWORD,DATABASE);
    $tx="core_";
    

?>
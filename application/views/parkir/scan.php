    <body>
        <div class="cont">
            <img src="<?php echo base_url();?>assets/images/nfc.png">
            <a href="Parkir/pilih"><h1>Please scan your NFC card!</h1></a>
        </div>
        <script>

            function autoRefresh()
            {
                window.location = window.location.href;
            }

            setInterval('autoRefresh()', 1000); // this will reload page after every 5 secounds; Method I
        </script>
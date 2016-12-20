    <body>
        <div class="cont">
            <a>
                <?php $sisa = $saldo - $tagihan;?>
                <h3 align="center"; >Parking Time: <?php echo $hours; ?> Hour <?php echo $minutes; ?> minutes</h3>
                <h1 align="center">cost total: Rp <?php echo $tagihan; ?></h1>
                <h3 align="center">balance: Rp <?php echo $saldo; ?> remaining balance: Rp <?php echo $sisa; ?></h3>
            </a>
            
            <form action="<?php echo base_url();?>Parkir/<?php if($jenispeng == "0") echo "bayar"; else echo "langganan";?>" method="post">
                <input type="hidden" name ="idpeng" value="<?php echo $idpeng;?>">
                <input type="hidden" name ="idtag" value="<?php echo $idtag;?>">
                <input type="hidden" name ="tagihan" value="<?php echo $sisa;?>">
                <button align="center" type="submit" class="checkout-button"><?php if($jenispeng == "0") echo "Bayar"; else echo "Langganan";?> &raquo;</button>
            </form>
            
        </div>
<?php if ($act <> "" and $subact=="") { ?>
<div class="container p20v">
        <center><h1>SPA-процедуры</h1></center>
        <div class="services" id="services">

            <?php
            $spas = $db->query("select * from `services` where `category`='spa'")->fetch_all(MYSQLI_ASSOC);
            foreach ($spas as $spa) { ?>

            <div class="service">
                <div class="image-box"><img src="<?=$spa['image'];?>"></div>
                <div class="info">
                    <div class="name"><?=$spa['title'];?></div>
                    <div class="description"><?=$spa['shortdescription'];?></div>
                    <div class="price">
                        <?php
                        if ($totaldiscount>0) {
                            echo "<s>".$spa['price']."</s> ".round($spa['price']*(1-$totaldiscount/100));
                        } else {
                            echo $spa['price'];
                        }
                        ?>
                        руб. / <?=$spa['time'];?> мин.
                     </div>
                </div>
                <a href="/<?=$spa['category'];?>/<?=$spa['name'];?>">Перейти</a>
            </div>

            <? } ?>
        </div>
        <center><h1>Массаж</h1></center>
        <div class="services">
            
            <?php
            $massages = $db->query("select * from `services` where `category`='massage'")->fetch_all(MYSQLI_ASSOC);
            foreach ($massages as $massage) { ?>

            <div class="service">
                <div class="image-box"><img src="<?=$massage['image'];?>"></div>
                <div class="info">
                    <div class="name"><?=$massage['title'];?></div>
                    <div class="description"><?=$massage['shortdescription'];?></div>
                    <div class="price">
                        <?php
                        if ($totaldiscount>0) {
                            echo "<s>".$massage['price']."</s> ".round($massage['price']*(1-$totaldiscount/100));
                        } else {
                            echo $massage['price'];
                        }
                        ?>
                        руб. / <?=$massage['time'];?> мин.
                    </div>
                </div>
                <a href="/<?=$massage['category'];?>/<?=$massage['name'];?>">Перейти</a>
            </div>

            <? } ?>
            
        </div>
    </div>
<? } else if ($act <> "" and $subact <> "") {
	$result = $db->query("select * from `services` where `category` = '$act' and `name` = '$subact' limit 1");
	if ($result->num_rows<1) {header("Location: /404");} else {
		$result = $result->fetch_assoc();
		?>

		<div class="content container service-detail">
			<div class="image">
				<img src="<?=$result['image'];?>">
			</div>
			<div class="info">
				<h1><?=$result['title'];?></h1>
				<p class="shortdescription"><?=$result['shortdescription'];?></p>
				<hr>
				<p class="fulldescription"><?=$result['description'];?></p>
				<div class="cost">
					Цена: 
					<?php
                    if ($totaldiscount>0) {
                        echo "<s>".$result['price']."</s> ".round($result['price']*(1-$totaldiscount/100));
                    } else {
                        echo $result['price'];
                    }
                    ?>
					₽ <span class="small">/ <?=$result['time'];?> мин.</span>
				</div>
			</div>
		</div>

	<?php }
} else {
	header("Location: /404");
}
?>
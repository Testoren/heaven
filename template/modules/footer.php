<div class="footer">
    <div class="container grid-4">
        <div class="about">
            <img src="/template/media/logo-transparent-white.png">
            <p><b><?=getConfVar("orgname");?></b></p>
            <p></p>
            <p><a href="tel:<?=getConfVar("phone");?>">
                <?php $phone = getConfVar("phone"); echo sprintf("%s (%s) %s-%s-%s", substr($phone,0,1), substr($phone,1,3), substr($phone,4,3), substr($phone,7,2), substr($phone,9,2)); ?>
            </a></p>
            <p><?=getConfVar("address");?></p>
            <p>ИНН: <?=getConfVar("inn");?><br>КПП: <?=getConfVar("kpp");?><br>ОГРН: <?=getConfVar("ogrn");?></p>

        </div>
        <div>
            <a href="/about">О нас</a><br>
            <a href="/contact">Контакты</a><br>
            <a href="/certificates">Подарочные сертификаты</a><br><br>
            SPA:
            <ul>
                <li><a href="/spa/for-man">SPA для мужчин</a></li>
                <li><a href="/spa/for-woman">SPA для женщин</a></li>
                <li><a href="/spa/for-couples">SPA для двоих</a></li>
                <li><a href="/spa/cedar-barrel">Кедровая бочка</a></li>
            </ul>
        </div>
        <div>
            Массаж:
            <ul>
                <li><a href="/massage/classic">Классический общий массаж</a></li>
                <li><a href="/massage/back">Массаж спины</a></li>
                <li><a href="/massage/anticellulite">Антицеллюлитный массаж</a></li>
                <li><a href="/massage/lymph">Лимфодренажный массаж</a></li>
                <li><a href="/massage/weight-loss">Массаж для похудения</a></li>
                <li><a href="/massage/for-woman">Массаж для женщин</a></li>
                <li><a href="/massage/face">Массаж лица</a></li>
                <li><a href="/massage/sport">Спортивный массаж</a></li>
                <li><a href="/massage/for-couples">Массаж для двоих</a></li>
            </ul>
        </div>
        <div class="developer">
            <p><a href="//<?=$_SERVER['SERVER_NAME'];?>"><?=$_SERVER['SERVER_NAME'];?></a> &copy; <?=date("Y");?></p>
            <p><?=getConfVar("developer");?></p>
        </div>
    </div>
</div>
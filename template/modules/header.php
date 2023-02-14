<div class="header <? if(!isMainpage()) {echo "minimized";} ?>">
    <? if(isMainpage()): ?>
    <div class="header_bg">
        <video src="/template/media/bgvid.mp4" class="header_bg_video" autoplay loop muted></video>
        <div class="header_bg_overlay"></div>
    </div>
    <div class="wellcoming_outer">
        <div class="wellcoming">
            <div class="heading">SPA-салон «Heaven»</div>
            <div class="description">Полный спектр SPA-услуг по приятным ценам – только в «Небесах»</div>
            <a href="#services">К списку услуг</a>
        </div>
    </div>
    <? endif; ?>
    <div class="header_navbar_outer <? if(!isMainpage()) {echo "sticked";} ?>">
        <div class="header_navbar container">
            <div class="header_logo">
                <a href="/">
                    <img src="/template/media/logo-transparent-white.png">
                </a>
            </div>
            <ul class="header_navigation">
                <li>
                    <a>SPA <span class="caret"></span></a>
                    <ul class="subnav">
                        <li><a href="/spa/for-man">SPA для мужчин</a></li>
                        <li><a href="/spa/for-woman">SPA для женщин</a></li>
                        <li><a href="/spa/for-couples">SPA для двоих</a></li>
                        <li><a href="/spa/cedar-barrel">Кедровая бочка</a></li>
                    </ul>
                </li>
                <li>
                    <a>Массаж <span class="caret"></span></a>
                    <ul class="subnav">
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
                </li>
                <li><a href="/about">О нас</a></li>
                <li><a href="/contact">Контакты</a></li>
                <li><a href="/certificates">Сертификаты</a></li>
                <li><a href="/testing">ТЕСТ ФУНКЦИИ</a></li>
            </ul>
            <div class="header_user_profile">
                <?php if (userLoggedIn()): ?>
                
                <a><?=$currentUser['name'];?> (<?=$currentUser['email'];?>) <span class="caret"></span></a>
                <ul class="subnav">
                    <li><a href="/profile">Профиль</a></li>
                    <li><a href="/logout">Выход</a></li>
                </ul>
                
                <? else: ?>
                
                <a href="/login">Личный кабинет</a>
                
                <? endif; ?>
            </div>
            <a class="toggle_navigation">Меню</a>
        </div>
    </div>
</div>
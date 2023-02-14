<div class="page_heading">
    Профиль
</div>
<div class="content container">
    <table style="width:auto;">
        <tr>
            <td>ID:</td>
            <td><?=$currentUser['id'];?></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><?=$currentUser['email'];?></td>
        </tr>
        <tr>
            <td>Имя:</td>
            <td><?=$currentUser['name'];?></td>
        </tr>
        <tr>
            <td>Дата регистрации:</td>
            <td><?=date("d.m.Y \в H:i:s",$currentUser['regdate']);?></td>
        </tr>
        <tr>
            <td>Дата последнего входа:</td>
            <td><?=date("d.m.Y \в H:i:s",$currentUser['lastlogin']);?></td>
        </tr>
    </table>

</div>
<?php $osztaly = osztaly(); 
$id = $_GET['oid'] ?? 1;
$osztalyok = osztalyok($id);
$osztalyoklista = osztalyoklista($id);
?>
<div class="w3-container content"><h2>Osztályok</h2>
<p class='w3-right-align'>
    <?php foreach($osztaly as $o): ?>
        | <a href='./?p=osztaly&oid=<?= $o['id']?>'><?= $o['nev']?></a>   
    <?php endforeach ?>|
</p>
<p><?=$osztalyok['nev']?>: <?=count($osztalyoklista)?> tanuló - Osztályfőnök: <?=$osztalyok['ofo']?></p>
<table>
	<tr>
		<th></th>
		<th>Név</th>
		<th class='ctr'>Késések</th>
		<th></th>
	</tr>
    <?php foreach($osztalyoklista as $key => $tanulo): ?>	
        <tr class='sor'>      
            <td class='num'><?= $key+1?>.</td>
            <td><?= $tanulo['nev']?></td>
            <td class='ctr'><?= $tanulo['ossz']?></td>
            <td class='ctr'><a href='./?p=reszlet&tanulo=<?= $tanulo['id']?>'><img src='./front/img/info.png'></a></td>
        </tr>
    <?php endforeach ?>
</table>
</div>
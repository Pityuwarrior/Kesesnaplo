<?php $listareszlet = reszletlista($_GET['tanulo']); 
    $reszlet = reszlet($_GET['tanulo']);
?>
<div class="w3-container content"><h2><?= $reszlet['nev']?></h2>
<div>
	<div class="adat">Tanulói azonosító:</div>
	<div class="adat"><?= $reszlet['tazon']?></div>
</div>
<div>
	<div class="adat">Osztály:</div>
	<div class="adat"><a href='./?p=osztalyok&oid=4'><?= $reszlet['onev']?></a></div>
</div>
<div>
	<div class="adat">Osztályfőnök:</div>
	<div class="adat"><?= $reszlet['ofo']?></div>
</div>
<div>
	<div class="adat">Késések:</div>
	<div class="adat">Összesen <?= count($listareszlet) ?> db késés</div>
</div>
<table>
	<tr>
		<th></th>
		<th class='ctr'>Dátum</th>
		<th class='ctr'>Igazolt</th>
		<th class='ctr'>Megjegyzés</th>
		<th class='ctr'></th>
		<th class='ctr'></th>
	</tr>
<?php
    foreach($listareszlet as $key => $keses): ?>	
        <tr class='sor'>
            <td><?=$key+1?>.</td>
            <td class='ctr'><?= $keses['datum']?></td>
            <?php if($keses['igazolt'] == 1): ?>
                <td class='ctr'><img class='icon' src='./front/img/ok.png'></td>
            <?php else: ?>
                <td class='ctr'><p>-</p></td>
            <?php endif; ?>
            <td class='ctr'><?= $keses['megjegyzes']?></td>
            <td class='ctr'>
                <a href='./?p=modositas&modid=<?= $keses['id']?>'>
                    <img src='./front/img/update.png' alt='módosítás' title='Módosítás'>
                </a>
            </td>
            <td class='ctr'>
                <a href='./?p=torles&delid=<?= $keses['id']?>'>
                    <img src='./front/img/delete.png' alt='törlés' title='Törlés'>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
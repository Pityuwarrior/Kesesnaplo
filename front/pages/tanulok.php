<div class="w3-container content">
<h2>Tanulók késései</h2>
<?php $tanulokeses = tanulokeses(); ?>
<p>Regisztrált késők: <?= count($tanulokeses) ?> tanuló</p>
<table>
	<tr>
		<th class='str'>Név</th>
		<th class='ctr'>Osztály</th>
		<th class='ctr'>Igazolt</th>
		<th class='ctr'>Igazolatlan</th>
		<th class='ctr'><a href='./?p=ujkeses'>
			<img src='./front/img/insert.png' alt='új' title='Új késés hozzáadása'>
		</a></th>
	</tr>
<?php
    foreach($tanulokeses as $keses): ?>
    <tr class='sor'>
		<td><?= $keses['tanulonev'] ?></td>
		<td class='ctr'><?= $keses['osztalynev'] ?></td>
		<td class='ctr'><?= $keses['igazolt'] ?></td>
		<td class='ctr'><?= $keses['igazolatlan'] ?></td>
		<td class='ctr'><a href='./?p=reszlet&tanulo=<?=$keses['id']?>'>
			<img src='./front/img/info.png' alt='info' title='Részletek'>
		</a></td>
	</tr>
    <?php endforeach; ?>
</table>

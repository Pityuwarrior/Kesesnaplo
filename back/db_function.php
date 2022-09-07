
<?php
//fetch csak egy értékkel(tömb = egy sor) tér vissza.
//fetchall meg több értékkel(tömb a tömben) tér vissza.
include("./back/adatbazis.php");
function Jelszo($nev, $pw)
{
    $sql="SELECT * FROM keses_admin
        WHERE uNev = ? ";
    $e = connect()->prepare($sql);
    $e->execute([$nev]);
    $result = $e->fetch(PDO::FETCH_ASSOC);
    if (isset($result['pw'])) 
    {
        return password_verify($pw, $result['pw']) ?$result["uID"]: false;
    }
    return false;
}
function userinfo()
{
    global $belepve;
    global $nev;
    if(!$belepve)
    {
        return null;
    }
    $sql="SELECT * FROM keses_admin
        WHERE uID = ? ";
    $e = connect()->prepare($sql);
    $e->execute([$nev]);
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function tanulokeses()
{
    $sql = <<<SQL
    SELECT 
    t.nev as tanulonev, 
    o.nev as osztalynev,
    (SELECT 
        COUNT(ke.igazolt) 
        FROM keses ke 
        WHERE ke.igazolt = 1 
        AND ke.tanuloID = t.id) as igazolt,
    (SELECT
        COUNT(ke.igazolt) 
        FROM keses ke 
        WHERE ke.igazolt = 0 
        AND ke.tanuloID = t.id) as igazolatlan,
    t.id as id
    FROM tanulo t 
    LEFT JOIN keses k ON k.tanuloID = t.id
    LEFT JOIN osztaly o ON t.osztalyID = o.id
    GROUP BY t.id
    HAVING igazolt > 0 OR igazolatlan > 0
    ORDER BY t.nev ASC;
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function reszletlista($id)
{
    $sql = <<<SQL
    SELECT 
    k.mikor as datum,
    k.igazolt as igazolt,
    m.megj as megjegyzes,
    k.id as id
    FROM keses k 
    LEFT JOIN megjegyzes m ON k.megjID = m.id
    WHERE k.tanuloID = $id ;
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function reszlet($id)
{
    $sql = <<<SQL
    SELECT 
    t.tanuloazon as tazon,
    t.nev as nev,
    o.nev as onev,
    o.ofo as ofo,
    o.id as osid
    FROM tanulo t
    INNER JOIN osztaly o ON t.osztalyID = o.id
    WHERE t.id = $id ;
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function ossztanulo()
{
    $sql = <<<SQL
    SELECT 
    t.nev as nev,
    t.id as id,
    o.nev as onev
    FROM tanulo t
    INNER JOIN osztaly o ON t.osztalyID = o.id
    ORDER BY t.nev ASC;
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function megjegyzes()
{
    $sql = <<<SQL
    SELECT 
    id,
    megj
    FROM megjegyzes
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function osztaly()
{
    $sql = <<<SQL
    SELECT 
    nev,
    id
    FROM osztaly
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function osztalyok($id)
{
    $sql = <<<SQL
    SELECT 
    nev,
    id,
    ofo
    FROM osztaly
    WHERE id = $id 
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function osztalyoklista($id)
{
    $sql = <<<SQL
    SELECT 
    t.nev as nev,
    t.id as id,
    (SELECT 
        COUNT(ke.igazolt) 
        FROM keses ke 
        WHERE ke.tanuloID = t.id) as ossz
    FROM tanulo t
    LEFT JOIN keses k ON t.id = k.tanuloID
    WHERE t.osztalyID = $id 
    ORDER BY t.nev ASC;
    SQL;
    $e = connect ()->query($sql);
    $e->execute();
    $result = $e->fetchAll();
    return $result;
}
function ujkeses($datum,$id,$ig,$megj){
    $sql = <<<SQL
    INSERT INTO keses(mikor, tanuloID, igazolt, megjID)
    VALUES (?,?,?,?)
    SQL;
    $e = connect ()->prepare($sql);
    $e->execute([$datum,$id,$ig,$megj]);
   $sql2 = <<<SQL
    SELECT 
    nev,
    id
    FROM tanulo
    WHERE id = ?;
    SQL;
    $e = connect ()->prepare($sql2);
    $e->execute([$id]);
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
}
// Mielőtt az adatbázis modosításra kerül kiírja a nevet és a dátumot az db-ből.
function modositas($id)
{
    $sql = <<<SQL
    SELECT 
    t.nev as nev,
    k.mikor as datum,
    t.id as id,
    k.igazolt as igazolt,
    k.megjID as megjid
    FROM  keses k
    LEFT JOIN tanulo t ON t.id = k.tanuloID
    WHERE k.id = ?
    SQL;
    $e = connect ()->prepare($sql);
    $e->execute([$id]);
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
} 
//Frissíti az adatbázis ha a gomb lenyomásra került.
function modositas2($id,$ig,$megj)
{
    $sql = <<<SQL
    UPDATE keses
    SET igazolt = ?, megjID = ?
    WHERE id = ?;
    SQL;
    $e = connect ()->prepare($sql);
    $e->execute([$ig,$megj,$id]);
}
//Törlés előtt be kérjük az adatokat.
function torles($id)
{
    $sql = <<<SQL
    SELECT 
    t.nev as nev,
    k.mikor as datum,
    t.id as id,
    k.igazolt as igazolt,
    m.megj as megj
    FROM  keses k
    LEFT JOIN tanulo t ON t.id = k.tanuloID
    LEFT JOIN megjegyzes m ON m.id = k.megjID
    WHERE k.id = ?
    SQL;
    $e = connect ()->prepare($sql);
    $e->execute([$id]);
    $result = $e->fetch(PDO::FETCH_ASSOC);
    return $result;
}
//Töröl az adatbázisban ha a gomb lenyomásra került.
function torles2($id)
{
    $sql = <<<SQL
    DELETE FROM keses WHERE id = ?;
    SQL;
    $e = connect ()->prepare($sql);
    $e->execute([$id]);
}


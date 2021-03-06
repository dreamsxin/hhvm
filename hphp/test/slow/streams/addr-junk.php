<?hh

abstract final class GetRandomPortStatics {
  public static $base = -1;
}

// borrowed from test/slow/ext_stream/ext_stream.php
function get_random_port() {
  if (GetRandomPortStatics::$base == -1) {
    GetRandomPortStatics::$base = 12345 + (int)((int)(microtime(false) * 100) % 30000);
  }
  return ++GetRandomPortStatics::$base;
}

function retry_bind_server() {
  for ($i = 0; $i < 20; ++$i) {
    $port = get_random_port();
    $address = "tcp://127.0.0.1:" . $port;

    $server = @stream_socket_server($address);
    if ($server !== false) {
      return array($port, $address, $server);
    }
  }
  throw new Exception("Couldn't bind server");
}


<<__EntryPoint>>
function main_addr_junk() {
list($port, $addr, $server) = retry_bind_server();
$client_addr = $addr . "/foo/bar/baz";
$client = stream_socket_client($client_addr);
$s = stream_socket_accept($server);
var_dump($client);
}

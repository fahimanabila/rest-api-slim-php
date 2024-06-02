<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
// use Slim\Http\Response as Response
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Selamat datang di API Mahasiswa Polines!');
        return $response;
    });

    $app->post('/api/students', function (Request $request, Response $response) {

        $post = (array)$request->getParsedBody();
    
        $nim = $post['nim'];
        $nama = $post['nama'];
        $angkatan = $post['angkatan'];
        $semester = $post['semester'];
        $ipk = $post['ipk'];
        $email = $post['email'];
        $telepon = $post['telepon'];

        $db = $this->get(PDO::class);
        $sth = $db->prepare("INSERT INTO mahasiswa SET nim='$nim', nama='$nama', angkatan='$angkatan', semester='$semester', ipk='$ipk', email='$email', telepon='$telepon';");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        $payload = json_encode($data);
        
        $response->getBody()->write($payload.''.(string)json_encode(["status" => "success"], 200));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->put('/api/students/{id}', function (Request $request, Response $response, $args) {

        $post = (array)$request->getParsedBody();
    
        $nama = $post['nama'];
        $angkatan = $post['angkatan'];
        $semester = $post['semester'];
        $ipk = $post['ipk'];
        $email = $post['email'];
        $telepon = $post['telepon'];
        $nim = $args['id'];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("UPDATE mahasiswa SET nim='$nim', nama='$nama', angkatan='$angkatan', semester='$semester', ipk='$ipk', email='$email', telepon='$telepon' WHERE nim='$nim';");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload.''.(string)json_encode(["status" => "success"], 200));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/api/students/search', function(Request $request, Response $response, $args) {
        $keyword = $_GET['keyword'];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR semester LIKE '%$keyword%'");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });
    

    $app->get('/api/students', function(Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM mahasiswa");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/api/students/{id}', function (Request $request, Response $response, $args) {
        $id = $args["id"];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM mahasiswa WHERE nim = '$id'");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->delete("/api/students/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("DELETE FROM mahasiswa WHERE nim='$id'");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write((string)json_encode(["status" => "success"], 200));
        $response->withHeader('Content-Type', 'application/json');
        return $response;
    });

    $app->delete("/api/students", function (Request $request, Response $response, $args){
        $db = $this->get(PDO::class);
        $sth = $db->prepare("DELETE FROM mahasiswa");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write((string)json_encode(["status" => "success"], 200));
        $response->withHeader('Content-Type', 'application/json');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};

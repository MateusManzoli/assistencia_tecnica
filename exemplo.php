<?php
/*
  use Silex\Application;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;

  //loader do Composer
  $loader = require_once __DIR__ . '/vendor/autoload.php';
  //cria a aplicação
  $app = new Application();
  $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'db.options' => array(
  'driver' => 'pdo_sqlite',
  'path' => __DIR__ . '/app.db',
  ),
  ));
  $app->post('/produto/{id}', function ($id) use ($app) {
  if ($id == null) {
  $sql = "SELECT * FROM assistencia_tecnica.produto";
  $cervejas = $app['db']->fetchAll($sql);
  return new Response(json_encode($cervejas), 200);
  }

  $sql = "SELECT * FROM assitencia_tecnica.produto WHERE nome = ?";
  $cerveja = $app['db']->fetchAssoc($sql, array($id));
  if (!$cerveja) {
  return new Response(json_encode('Não encontrada'), 404);
  }
  return new Response(json_encode($cerveja), 200);
  })->value('id', null);

  $app->post('/produto', function (Request $request) use ($app) {
  //pega os dados
  if (!$data = $request->get('cerveja')) {
  return new Response('Faltam parâmetros', 400);
  }
  $app['db']->insert('produto', array('nome' => $data['nome'], 'estilo' => $data['estilo']));

  //redireciona para a nova cerveja
  return $app->redirect('/produto/' . $data['nome'], 201);
  });

  $app->put('/produto/{id}', function (Request $request, $id) use ($app) {
  //pega os dados
  if (!$data = $request->get('cerveja')) {
  return new Response('Faltam parâmetros', 400);
  }
  $sql = "SELECT * FROM assistencia_tecnica.produto WHERE nome = ?";
  $cerveja = $app['db']->fetchAssoc($sql, array($id));
  if (!$cerveja) {
  return new Response(json_encode('Não encontrada'), 404);
  }
  //Persiste na base de dados
  $app['db']->update(
  'produtos', array('nome' => $data['nome'], 'estilo' => $data['estilo']), array('id' => $cerveja['id'])
  );

  return new Response('Produto atualizado', 200);
  });

  $app->delete('/produto/{id}', function (Request $request, $id) use ($app) {
  //busca da base de dados
  $sql = "SELECT * FROM assistencia_tecnica.produto WHERE nome = ?";
  $cerveja = $app['db']->fetchAssoc($sql, array($id));
  if (!$cerveja) {
  return new Response(json_encode('Não encontrada'), 404);
  }
  $app['db']->delete('cervejas', array('id' => $cerveja['id']));

  return new Response('Produto removido', 200);
  });

  // $app->before(function (Request $request) use ($app) {
  //     if( ! $request->headers->has('authorization')){
  //         return new Response('Unauthorized', 401);
  //     }
  //     require_once 'configs/clients.php';
  //     if (!in_array($request->headers->get('authorization'), array_keys($clients))) {
  //         return new Response('Unauthorized', 401);
  //     }
  // });
  $app->after(function (Request $request, Response $response) {
  $response->headers->set('Content-Type', 'text/json');
  });

  $app->run();
 */

$loader = require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

$app = new Application();

$cervejas = array(
    "marcas" => array('Skol', 'Brahma', 'Itaipava'),
    'estilos' => array('Pilsen', 'Stout'),
);
//Criacao da Rota
/* $app->get('/produto', function() use ($cervejas) {
  return implode(',', $cervejas[');
  });

  $app->get('/estilos', function() use ($cervejas) {
  return implode(',', $cervejas['estilos']);
  }); */

/* $app->get('/cervejas/{id}', function ($id) use ($cervejas) {
  if ($id == null) {
  return implode(',', $cervejas['marcas']);
  }
  $key = array_search($id, $cervejas['marcas']);

  if ($key === null) {
  return 'Não encontrada';
  }
  return $cervejas['marcas'][$key];
  })->value('id', null); */

$app->get('/cervejas/{id}', function ($id) use ($cervejas) {
    if ($id == null) {
        $result = implode(',', $cervejas['marcas']);
        return new Response(json_encode($result), 200);
    }
    $key = array_search($id, $cervejas['marcas']);
    if ($key === null) {
        return new Response(json_encode('Não encontrada', 404));
    }
    return new Response(json_encode($cervejas['marcas'][$key]), 200);
})->value('id', null);
$app->after(function(Request $request, Response $response) {
    $response->headers->set('Content-Type', 'text/json');
});

//ADICIONANDO NOVA CERVEJA
$app->post('/cervejas', function (Request $request) use ($app) {
    //pega dados
    if (!$data = $request->get('cerveja')) {
        return new Response('Faltam parametros', 400);
    }
    //Persiste na base de dados(considerado um entidade doctrine)
    $cerveja = new Cerveja();
    $ceveja->nome = $data['nome'];
    $cerveja->estilo = $data['estilo'];
    $cerveja->Save();
    //redireciona para a nova cerveja
    return $app->redirect('/cervejas/' . $data['nome'], 201);
});

// ALTERANDO UMA CERVEJA
$aPP->put('/cerveja/{id}', function (Request $request, $id) use ($app) {
    //PEGA DADOS
    if (!$data = $request->get('cerveja')) {
        return new Response('Faltam parametros', 400);
    }
    //Persiste na basa de dados
    $cerveja->nome = $data['nome'];
    $cerveja->estilo = $data['estilo'];
    $cerveja->save();

    return new Response('Cerveja atualizada', 200);
});

//DELETE
$app->delete('/cervejas/{id}', function (Request $request, $id) use ($app) {
    //Buscar da base de dados
    if (!$cerveja = $app['db']->find($id)) {
        return new Response('Não encontrada', 404);
    }
    $cerveja->delete();
    return new Response('Cerveja removida', 200);
})
?>
</html>

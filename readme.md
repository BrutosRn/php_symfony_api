//Cette erreur indique un problème de CORS (Cross-Origin Resource //Sharing). Votre application Vue.js, qui s'exécute sur http:////localhost:5173, essaie d'accéder à une API sur http://127.0.0.//1:8000, et le serveur de l'API ne permet pas cette requête //cross-origin.
//Pour résoudre ce problème, vous devez configurer votre serveur //Symfony pour autoriser les requêtes CORS. Voici comment procéder :
//
//Installez le bundle NelmioCorsBundle dans votre projet Symfony :
//
//bashCopycomposer require nelmio/cors-bundle
//
//Configurez le bundle dans votre fichier config/packages///nelmio_cors.yaml :
//
//yamlCopynelmio_cors:
//    defaults:
//        origin_regex: true
//        allow_origin: ['%env(CORS_ALLOW_ORIGIN)%']
//        allow_methods: ['GET', 'OPTIONS', 'POST', 'PUT', 'PATCH', //'DELETE']
//        allow_headers: ['Content-Type', 'Authorization']
//        expose_headers: ['Link']
//        max_age: 3600
//    paths:
//        '^/api/':
//            allow_origin: ['http://localhost:5173']
//            allow_headers: ['X-Custom-Auth']
//            allow_methods: ['POST', 'PUT', 'GET', 'DELETE']
//            max_age: 3600
//
//Dans votre fichier .env, ajoutez la variable suivante :
//
//CopyCORS_ALLOW_ORIGIN=^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$
//Cette configuration permettra les requêtes CORS depuis http:////localhost:5173 vers tous les endpoints commençant par /api/.
//
//Assurez-vous que le bundle est activé dans votre fichier config///bundles.php :
//
//phpCopyreturn [
//    // ...
//    Nelmio\CorsBundle\NelmioCorsBundle::class => ['all' => true],
//];
//
//Nettoyez le cache de Symfony :
//
//bashCopyphp bin/console cache:clear
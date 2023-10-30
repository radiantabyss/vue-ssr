<?php
namespace LumiVueSSR\Commands;

class RoutesCommand implements CommandInterface
{
    public static function run($options) {
        $public_middleware = explode(',', $_ENV['LUMI_PUBLIC_MIDDLEWARE'] ?? '');
        $files = scandir('src/Routes');

        foreach ( $files as $file ) {
            if ( in_array($file, ['.', '..']) ) {
                continue;
            }

            $contents = file_get_contents('src/Routes/'.$file);
            $contents = str_replace('export default ', '', $contents);
            $contents = preg_replace('!//.*!', '', $contents);
            $contents = preg_replace('/(\w+):/', '"$1":', $contents);
            $contents = preg_replace('/,(\s*[\]}])/m', '$1', $contents);
            $contents = str_replace('];', ']', $contents);
            $contents = str_replace('\'', '"', $contents);
            $groups = decode_json($contents, true);

            if ( json_last_error() !== JSON_ERROR_NONE ) {
                throw new \Exception('Error in routes file: '.$file);
            }

            $string = "<?php \nuse Lumi\Core\Route;\nuse Lumi\Core\RouteCrud;\n";
            foreach ( $groups as $group ) {
                //check if group contains private middleware
                if ( count(array_diff($group['middleware'], $public_middleware)) ) {
                    continue;
                }

                $string .= "Route::group(['middleware' => [".str_replace("''", "", "'".implode("', '", $group['middleware'])."'")."]], function() {\n";

                foreach ( $group['routes'] as $route ) {
                    // $domain_string = implode('\\', array_pop(explode('.', $route['action']));
                    $string .= indent()."Route::get('".$route['path']."', '".str_replace('.', '\\', $route['action'])."');\n";
                }

                $string .= "});\n\n";
            }

            //if is main routes file, add any route
            if ( $file == 'Routes.js' ) {
                $string .= "Route::get('{any?}', 'Index\IndexAction')->where('any', '.*');\n";
            }

            $destination_file = preg_replace('/\.js$/', '', strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($file)))).'.php';
            file_put_contents('ssr/routes/'.$destination_file, $string);
        }
    }
}

<?php
// for WebP Converter for Media plugin - custom paths to convert images to webP
add_filter( 'webpc_supported_source_directory', function( bool $status, string $directory_name, string $server_path ): bool {
    $excluded_directories = [ 'wcpa_uploads' ];
    if ( ! $status || in_array( $directory_name, $excluded_directories ) ) {
        return false;
    }

    return $status;
}, 10, 3 );

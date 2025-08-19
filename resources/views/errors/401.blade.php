@include('errors.layout', [
    'code' => '401',
    'title' => 'Unauthorized Access!',
    'message' => 'Looks like you need proper credentials to dock here.'
])

<!DOCTYPE HTML>
<html>
<body>
  <?php
    /**
     * Request class.
     */
    class Request
    {
      private $method;
      private $path;
      private $url;
      private $user_agent;

      public function __construct($arg)
      {
        $this->method = $arg['REQUEST_METHOD'];
        $this->path = $arg['REQUEST_URI'];
        $this->url =  $arg['HTTP_HOST'].$arg['REQUEST_URI'];
        $this->user_agent = $arg['HTTP_USER_AGENT'];
      }
      public function getMethod() {
        return $this->method;
      }
      public function getPath() {
          return $this->path;
      }
      public function getURL() {
            return $this->url;
      }
      public function getUserAgent() {
        return $this->user_agent;
      }
    }
    /**
     * Get Request
     */
    class GetRequest extends Request
    {
      private $data;

      public function __construct($arg)
      {
        parent::__construct($arg);
         parse_str($arg['QUERY_STRING'], $this->data);
      }
      public function getData() {
        return json_encode($this->data);
      }
    }
   ?>
</body>
</html>

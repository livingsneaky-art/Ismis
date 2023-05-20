<?php
use PHPUnit\Framework\TestCase;


class AuthenticationTest extends TestCase
{
    public function test_user_login()
    {
        $_POST['id_num'] = '20300001';
        $_POST['password'] = '123';

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Buffer the output to capture the redirect
        ob_start();
        require 'login.php';
        $output = ob_get_clean();

        // Assert that the output contains the redirect to the "IndexStudent" page
        $this->assertStringContainsString('Location: IndexStudent', $output);
    }

    public function test_user_login_failed()
    {
        $_POST['id_num'] = '20300001';
        $_POST['password'] = 'wrongpassword'; // Provide an incorrect password

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'login.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('IndexStudent');
    }

    public function test_user_register()
    {
        $_POST['id_num'] = '20300001';
        $_POST['password'] = '123';
        $_POST['type'] = 'Student';
        $_POST['name'] = 'Hello';
        // Provide any additional required fields for successful registration

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'register.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('IndexStudent');
    }

    public function test_user_register_failed()
    {
        $_POST['id_num'] = '20300001';
        $_POST['password'] = '123';
        $_POST['type'] = 'Student';
        $_POST['name'] = 'Hello';
        // Provide any additional required fields for a failed registration attempt

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'register.php';
        ob_end_clean();

        // Assert that the page redirected to the login page
        $this->assertRedirect('login.php');
    }

    public function test_login_can_access_home_student()
    {
        // Simulate a successful login with valid credentials
        $_POST['id_num'] = '20300001';
        $_POST['password'] = '123';

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'login.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('IndexStudent');
    }

    public function test_login_can_access_home_faculty()
    {
        // Simulate a successful login with valid credentials
        $_POST['id_num'] = '20300002';
        $_POST['password'] = '123';

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'login.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('IndexFaculty');
    }


    public function test_user_logout(){
        // Simulate a successful login with valid credentials
        $_POST['id_num'] = '20300001';
        $_POST['password'] = '123';

        // Include the server script to make the necessary variables and functions available
        require './includes/server.php';

        // Start output buffering to capture the redirect
        ob_start();
        require 'login.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('IndexStudent');

        // Start output buffering to capture the redirect
        ob_start();
        require 'logout.php';
        ob_end_clean();

        // Assert that the page redirected to the "IndexStudent" page
        $this->assertRedirect('login.php');
    }
    
}

?>
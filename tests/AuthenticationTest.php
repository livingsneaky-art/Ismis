<?php
use PHPUnit\Framework\TestCase;


class AuthenticationTest extends TestCase
{
    public function testSuccessfulLoginRedirectsToIndexStudent()
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

    public function testFailedLoginRedirectsToIndexStudent()
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

    public function testSuccessfulRegistrationRedirectsToIndexStudent()
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

    public function testFailedRegistrationRedirectsToLoginPage()
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
}

?>
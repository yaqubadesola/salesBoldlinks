<?php
class approve extends configure {
    
    protected $day;
    protected $name;
    protected $dob;
    protected $phone;
    protected $mail;
    protected $location;
    protected $user;
    protected $pword;
    protected $photo;
    protected $resume;
    protected $role;
    protected $details;
    
    function setter($date, $fullname, $date_of_birth, $tel, $email, $address, $username, $password, $passport, $cv, $status) {
        $this->day = $date;
        $this->name = $fullname;
        $this->dob = $date_of_birth;
        $this->phone = $tel;
        $this->mail = $email;
        $this->location = $address;
        $this->user = $username;
        $this->pword = $password;
        $this->photo = $passport;
        $this->resume = $cv;
        $this->role = $status;
        $this->details = array('date'=>$this->day, 'fullname'=>$this->name, 'birthday'=>$this->dob, 'tel'=>$this->phoone, 
                                'email'=>$this->mail, 'address'=>$this->location, 'username'=>$this->user, 
                                'password'=>$this->pword, 'photo'=>$this->pword, 'cv'=>$this->resume, 'status'=>$this->role);
                                
    }
    
    function getter() {
        return $this->details;
    }
    
    function signup() {
        $this->setter($date, $fullname, $date_of_birth, $tel, $email, $address, $username, $password, $passport, $cv, $status);
        $this->getter();
        
         $insert_qry = "INSERT INTO login (date,fullname,birthday,tel,email,address,username,password,passport,cv,status)
        VALUES('{$this->details['date']}','{$this->details['fullname']}','{$this->details['birthday']}',
        '{$this->details['tel']}','{$this->details['email']}','{$this->details['address']}',
        '{$this->details['username']}','{$this->details['password']}','{$this->details['photo']}',
        '{$this->details['cv']}','{$this->details['status']}')"; 
        $result = mysqli_query($this->connect(),$insert_qry);
        
             
        if ($result) {
        echo "<script>alert('Signup Successful')</script>";
        echo 'Your application will be reviewed and approved by the admin';
        }      else {
        echo "<script>alert('A problem was encountered while signing up.')</script>";
        
} 
        
            
        
    }
    
}


?>
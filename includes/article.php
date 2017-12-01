<?php
  
   class Article
   {	
		public function fetch_wall_poster( $admin_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_poster WHERE (admin_id = ?);");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_group_status($user_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_user_requests WHERE (user_id = ?);");
			$query -> bindValue(1,$user_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_user_requests($admin_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_user_requests WHERE (admin_id = ? && status = ?);");
			$query -> bindValue(1,$admin_id);
			$query -> bindValue(2,"requested");
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_accepted_users($admin_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_user_requests WHERE (admin_id = ? && status = ?);");
			$query -> bindValue(1,$admin_id);
			$query -> bindValue(2,"accepted");
			$query->execute();
			return $query ->fetchAll();
		}
		
		public function fetch_userids()
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT MAX(user_id) as user_id FROM myyaara_user;");
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_adminforgetpassword($admin_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT admin_name, admin_password FROM myyaara_admin WHERE admin_email = ?;");
			$query -> bindValue(1,$admin_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_userforgetpassword($user_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT user_name, user_password FROM myyaara_user WHERE user_email = ?;");
			$query -> bindValue(1,$user_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_user_id($user_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT user_id FROM myyaara_user WHERE user_email = ?;");
			$query -> bindValue(1,$user_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_status($admin_id, $user_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT status FROM myyaara_user_requests WHERE (admin_id = ? && user_id = ? );");
			$query -> bindValue(1,$admin_id);
			$query -> bindValue(2,$user_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_userstory($user_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT user_name, user_mystory_title, user_mystory, user_mystory_picture FROM myyaara_user WHERE user_id = ?;");
			$query -> bindValue(1,$user_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_user_details($user_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_user WHERE user_id = ?;");
			$query -> bindValue(1,$user_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_adminids()
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT MAX(admin_id) as admin_id FROM myyaara_admin;");
			$query->execute();
			return $query ->fetch();
		
		}
		public function fetch_admin_detail($admin_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM myyaara_admin WHERE admin_id = ?;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_admin_details($admin_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM myyaara_admin WHERE admin_email = ?;");
			$query -> bindValue(1,$admin_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_admin_details_by_id($admin_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM myyaara_admin WHERE admin_id = ?;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_admin_profile_pic( $admin_email )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT admin_profile_pic FROM myyaara_admin WHERE admin_email = ? ;");
			$query -> bindValue(1,$admin_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_admin_id($admin_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT admin_id FROM myyaara_admin WHERE admin_email = ? ;");
			$query -> bindValue(1,$admin_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_college_information( $admin_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_college_information WHERE admin_id = ? ;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_college_pictures( $admin_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_college_pictures WHERE admin_id = ? ;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_personal_pictures( $user_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_user_pictures WHERE user_id = ? ;");
			$query -> bindValue(1,$user_id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_teachers_information( $admin_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM myyaara_teacher_information WHERE admin_id = ? ;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_college_pics_count( $admin_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT count(*) as count FROM myyaara_college_pictures WHERE admin_id = ? ;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_user_pics_count( $user_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT count(*) as count FROM myyaara_user_pictures WHERE user_id = ? ;");
			$query -> bindValue(1,$user_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_teacher_pics_count( $admin_id )
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT count(*) as count FROM myyaara_teacher_information WHERE admin_id = ? ;");
			$query -> bindValue(1,$admin_id);
			$query->execute();
			return $query ->fetch();
		}
		
		
		
		
   
		public function fetch_total_items_list($item_type)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM items WHERE type = ?;");
			$query -> bindValue(1,$item_type);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_item_details($item_no)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM items WHERE id = ?;");
			$query -> bindValue(1,$item_no);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_pamids()
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT MAX(pam_id) as pam_id FROM paminfo;");
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_customerid($customer_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM customers WHERE customer_email = ?;");
			$query -> bindValue(1,$customer_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_pamid($pam_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM paminfo WHERE pam_email = ?;");
			$query -> bindValue(1,$pam_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_paminfo($pam_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT *  FROM paminfo WHERE pam_id = ?;");
			$query -> bindValue(1,$pam_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_forgetdetails($customer_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT customer_name,customer_id,customer_password FROM customers WHERE customer_email = ?;");
			$query->bindValue(1,$customer_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_pamforgetdetails($pam_email)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT pam_name,pam_password FROM paminfo WHERE pam_email = ?;");
			$query->bindValue(1,$pam_email);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_shipping_carts($customer_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM customer_shifting_cart WHERE customer_id = ?;");
			$query->bindValue(1,$customer_id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_pam_shipping_carts($pam_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM customer_shifting_cart WHERE pam_id = ?;");
			$query->bindValue(1,$pam_id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_pending_shipping_carts()
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM customer_shifting_cart WHERE pam_id = ?;");
			$query->bindValue(1,0);
			$query->execute();
			return $query ->fetchAll();
		}
		public function fetch_submitted_quote_record($id, $pam_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM pamquotes WHERE order_id = ? AND pam_id = ?;");
			$query->bindValue(1,$id);
			$query->bindValue(2,$pam_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_submitted_quote_records($id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT * FROM pamquotes WHERE order_id = ?;");
			$query->bindValue(1,$id);
			$query->execute();
			return $query ->fetchAll();
		}
		public function check_selected_pam_details($id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT pam_id FROM customer_shifting_cart WHERE id = ?;");
			$query->bindValue(1,$id);
			$query->execute();
			return $query ->fetch();
		}
		public function check_for_pam_shifting_success($id,$pam_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT pam_status FROM customer_shifting_cart WHERE id = ? && pam_id = ?;");
			$query->bindValue(1,$id);
			$query->bindValue(2,$pam_id);
			$query->execute();
			return $query ->fetch();
		}
		public function check_for_customer_shifting_success($id,$customer_id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT customer_status FROM customer_shifting_cart WHERE id = ? && customer_id = ?;");
			$query->bindValue(1,$id);
			$query->bindValue(2,$customer_id);
			$query->execute();
			return $query ->fetch();
		}
		public function fetch_submitted_pam_feedback($id)
		{
			global $pdo;
			
			$query= $pdo->prepare("SELECT pam_status, pam_customer_feedback,pam_eazyshifting_feedback FROM customer_shifting_cart WHERE order_id = ?;");
			$query->bindValue(1,$id);
			$query->execute();
			return $query ->fetchAll();
		}
	}
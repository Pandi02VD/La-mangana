<?php
	class Conexion{
		public function conectar(){
			try {
				$pdo = new PDO("mysql:host=localhost;dbname=econodentalplus;charset=utf8", "cliente_econodentalplus", "1234",[
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_MX'" 
				]);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $pdo;
			} catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}
	}

<?php
	class DB {
		public static $instance = [];
	 
		private     $_sql = null,
					$_query = null,
					$_error = false,
					$_results = null,
					$_count = 0;
	 
		private function __construct($db = 'mysql') {
			try {
				$this->_sql = new PDO('mysql:host=' . Config::get($db . '/host') . ';dbname=' . Config::get($db . '/db'), Config::get($db . '/username'), Config::get($db . '/password'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_TIMEOUT => "5"));
				$this->_query = $this->_sql->prepare("SET NAMES utf8");
				$this->_query->execute();
			} catch(Exception  $e) {
				die("No MySQL Connection: " . $e->getMessage());
			}
			if(!$this->_sql){
				die("No MySQL Connection!");
			}
		}
	 
		/**
		 * Adatbázis instance lekérdezés. Így futási időben, csak egyszer kapcsolódik, utána az aktív kapcsolatot használja.
		 * @param string $db A beállításokban tárolt adatbázis neve.
		 * @return DB
		 */
		public static function getInstance($db = 'mysql') {
			if(!isset(self::$instance[$db]))
				self::$instance[$db] = new DB($db);
			return self::$instance[$db];
		}
	 
		/**
		 * Lekérdezéseket lehet létrehozni.
		 * @param string $sql Natív sql query. Lehet értékeket behelyettesíteni vele '?' karakterrel.
		 * @param array $params A behelyettesítések sorrendben.
		 * @return DB|int Ha insert query, az ID-t dobja vissza.
		 */
		public function query($sql, $params = array()) {
			$this->deleteResults();

			$this->_error = false;

			if($this->_query = $this->_sql->prepare($sql)) {
				$x = 1;
				if(count($params)) {
					foreach($params as $param) {
						$this->_query->bindValue($x, $param);
						$x++;
					}
				}

				if($this->_query->execute()) {
					switch (strtolower(substr($sql, 0, 6))) {
						case 'insert':
						case 'replace':
							return $this->_sql->lastInsertId();
							break;

						default:
							$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
							$this->_count = $this->_query->rowCount();
							break;
					}
				} else {
					$this->_error = true;
				}
			}
		   
			return $this;
		}
	 
		/**
		 * Minden adat lekérdezése egy adott táblából.
		 * @param string $table A tábla neve.
		 * @param array $where Milyen feltételekkel. Példa: ['id', '=', 1]
		 * @return DB
		 */
		public function get($table, $where) {
			return $this->action('SELECT *', $table, $where);
		}
	 
		/**
		 * Sor törlése egy adott táblából.
		 * @param string $table A tábla neve.
		 * @param array $where Milyen feltételekkel. Példa: ['id', '=', 1]
		 * @return DB
		 */
		public function delete($table, $where) {
			return $this->action('DELETE', $table, $where);
		}
	 
		/**
		 * SQL utasítás végrehajtása.
		 * @param string $action SQL utasítás (SELECT, DELETE, UPDATE ...)
		 * @param string $table Tábla neve.
		 * @param array $where Milyen feltételekkel. Példa: ['id', '=', 1]
		 * @return DB
		 */
		public function action($action, $table, $where = array()) {
			if(count($where) === 3) {
				$operators = array('=', '>', '<', '>=', '<=');
	 
				$field      = $where[0];
				$operator   = $where[1];
				$value      = $where[2];
	 
				if(in_array($operator, $operators)) {
					$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
	 
					if(!$this->query($sql, array($value))->error()) {
						return $this;
					}
	 
				}
			   
				return false;
			}
		}
	 
		/**
		 * Új sor beillesztése egy adott táblába.
		 * @param string $table Tábla neve.
		 * @param array $fields Beillesztendő értékek. Pl ['id' => 1, 'name' => 'Béla']
		 * @return int
		 */
		public function insert($table, $fields = array(), $key = 'INSERT') {
			$keys   = array_keys($fields);
			$values = null;
			$x      = 1;
	 
			foreach($fields as $value) {
				$values .= "?";
				if($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}
			$sql = $key . " INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
			return $this->query($sql, $fields);
		}
	 
		/**
		 * Új sor beillesztése vagy felülírása egy adott táblába.
		 * @param string $table Tábla neve.
		 * @param array $fields Beillesztendő értékek. Pl ['id' => 1, 'name' => 'Béla']
		 * @return int
		 */
		public function replace($table, $fields = array()) {
			return $this->insert($table, $fields, 'REPLACE');
		}

		/**
		 * Adat frissítése egy adott táblában.
		 * @param string $table Tábla neve.
		 * @param int $id A sor id-je, amit frissíteni kell.
		 * @param array $fields Frissítendő oszlopok. Pl ['email' => 'foo@example.hu']
		 * @param string $id_field Alapértelmezett: 'id'. Az $id változó általi keresett oszlop.
		 * @return bool
		 */
		public function update($table, $id, $fields = array(), $id_field = 'id') {
			$set    = null;
			$x      = 1;
			foreach($fields as $name => $value) {
				if (strtolower($value) == 'now()') {
					$set .= "`{$name}` = NOW()";
					unset($fields[$name]);
				} else {
					$set .= "`{$name}` = ?";
					if($x < count($fields)) {
						$set .= ', ';
					}

					$x++;
				}
			}
	 
			$sql = "UPDATE {$table} SET {$set} WHERE `{$id_field}` = {$id}";
	 
			if(!$this->query($sql, $fields)->error()) {
				return true;
			}
	 
			return false;
		}
	 
		/**
		 * Egy adott oszlop lekérdezése.
		 * @param string $table A tábla neve.
		 * @param int $id A sor ID-je.
		 * @param string $data Az oszlop neve. Alapértelmezett: 'name'
		 * @param string $idtab Az oszlop neve ami alapján keresünk. Alapértelmezett: 'id'
		 * @return string
		 */
		public function getDataStr($table, $id, $data = 'name', $idtab = 'id') {
			if (!isset($_cacheData[$table][$id][$data][$idtab])) {
				$d = $this->query('SELECT '.$data.' FROM '.$table.' WHERE '.$idtab.' = ?', [$id]);
				if ($d->count() == 1) {
					$d = $d->first()->$data;
				} else {
					$d = '';
				}
				$_cacheData[$table][$id][$data][$idtab] = $d;
			}
			return $_cacheData[$table][$id][$data][$idtab];
		}
	 
		/**
		 * Az utolsó lekérdezés értékei.
		 * @return array
		 */
		public function results() {
			return $this->_results;
		}
	 
		/**
		 * Az utolsó lekérdezés első értéke.
		 * @return object
		 */
		public function first() {
			return isset($this->_results[0]) ? $this->_results[0] : null;
		}

		/**
		 * Az utolsó lekérdezés darabszáma.
		 * @return int
		 */
		public function count() {
			return $this->_count;
		}
	 
		/**
		 * Az utolsó lekérdezési adatok törlése.
		 */
		public function deleteResults() {
			$this->_results = NULL;
			$this->_query = NULL;
			$this->_error = NULL;
			$this->_count = NULL;
		}
	 
		/**
		 * Az utolsó lekérdezés hibával zárult-e.
		 * @return bool
		 */
		public function error() {
			return $this->_error;
		}

		public static function now() {
			return date("Y-m-d H:i:s");
		}
	}
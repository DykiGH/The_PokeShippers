<?php
abstract class Utilisateur
{

	// Attributs
	private int $_IdCollectionneur;
	private string $_pseudo;
	private string $_mail;
	private string $_mdp;
	private string $_role;

	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) {
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	//getters
	public function getIdCollectionneur()
	{
		return $this->_IdCollectionneur;
	}

	public function getPseudo()
	{
		return $this->_pseudo;
	}

	public function getMdp()
	{
		return $this->_mdp;
	}

	public function getMail()
	{
		return $this->_mail;
	}

	public function getRole()
	{
		return $this->_role;
	}

	//setters

	public function setIdCollectionneur($IdCollectionneur)
	{
		$this->_IdCollectionneur = $IdCollectionneur;
	}

	public function setPseudo($pseudo)
	{
		$this->_pseudo = $pseudo;
	}


	public function setMail($mail)
	{
		$this->_mail = $mail;
	}

	public function setMdp($mdp)
	{
		$this->_mdp = $mdp;
	}


	public function setRole($role)
	{
		$this->_role = $role;
	}
}

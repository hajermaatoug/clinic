<?php
class MedicalRecord
{
    private $id = null;
    private $name = null;
    private $dateOfBirth = null;
    private $gender = null;
    private $medicalHistory = null;
    private $allergies = null;
    private $createdAt = null;
    private $userId = null;

    public function __construct($name, $dateOfBirth, $gender, $medicalHistory, $allergies, $userId)
    {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->gender = $gender;
        $this->medicalHistory = $medicalHistory;
        $this->allergies = $allergies;
        $this->userId = $userId;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getMedicalHistory()
    {
        return $this->medicalHistory;
    }

    public function setMedicalHistory($medicalHistory)
    {
        $this->medicalHistory = $medicalHistory;
    }

    public function getAllergies()
    {
        return $this->allergies;
    }

    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}

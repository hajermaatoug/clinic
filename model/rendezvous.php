<?php
class RendezVous
{
    private $id = null;
    private $medicalRecordId = null;
    private $appointmentDate = null;
    private $reason = null;
    private $status = 'Not Scheduled';
    private $createdAt = null;

    public function __construct($medicalRecordId, $appointmentDate, $reason, $status = 'Not Scheduled')
    {
        $this->medicalRecordId = $medicalRecordId;
        $this->appointmentDate = $appointmentDate;
        $this->reason = $reason;
        $this->status = $status;
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

    public function getMedicalRecordId()
    {
        return $this->medicalRecordId;
    }

    public function setMedicalRecordId($medicalRecordId)
    {
        $this->medicalRecordId = $medicalRecordId;
    }

    public function getAppointmentDate()
    {
        return $this->appointmentDate;
    }

    public function setAppointmentDate($appointmentDate)
    {
        $this->appointmentDate = $appointmentDate;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}

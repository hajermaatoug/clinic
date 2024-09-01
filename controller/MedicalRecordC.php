<?php
require_once('C:/xampp/htdocs/hajer_maatoug/WEB/config.php');
include 'C:/xampp/htdocs/hajer_maatoug/WEB/model/medicalrecord.php';

class MedicalRecordC
{
    public function create($medicalRecord)
    {
        $sql = "INSERT INTO `medical_record`(`name`, `date_of_birth`, `gender`, `medical_history`, `allergies`, `user_id`) VALUES (:name, :date_of_birth, :gender, :medical_history, :allergies, :user_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $medicalRecord->getName(),
                'date_of_birth' => $medicalRecord->getDateOfBirth(),
                'gender' => $medicalRecord->getGender(),
                'medical_history' => $medicalRecord->getMedicalHistory(),
                'allergies' => $medicalRecord->getAllergies(),
                'user_id' => $medicalRecord->getUserId(),
            ]);

            // Fetch the last inserted medical record
            $sql2 = "SELECT * FROM medical_record ORDER BY created_at DESC LIMIT 1";//sytax req
            $query2 = $db->prepare($sql2);//req en elle mm
            $query2->execute();//exucution req
            $f = $query2->fetch();  // Use $query2 instead of $query//fetch=unlock data 

            // Update the rendezvous record with the fetched medical_record_id
            $sql3 = "UPDATE `rendez_vous` SET `medical_record_id` = :idm WHERE `id` = :id";
            $query3 = $db->prepare($sql3);
            $query3->execute([
                'idm' => $f['id'],
                'id' => $_GET['id'],
            ]);

            header('Location: rdv.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }


    public function read()
    {
        $sql = "SELECT * FROM medical_record";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function search($r)
    {
        $sql = "SELECT * FROM medical_record WHERE id LIKE '%$r%' OR name LIKE '%$r%' OR gender LIKE '%$r%' OR medical_history LIKE '%$r%' OR allergies LIKE '%$r%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function sort($r)
    {
        $sql = "SELECT * FROM medical_record ORDER BY $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function findOne($id)
    {
        $sql = "SELECT * FROM medical_record WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $f = $query->fetch();
            return $f;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) {
            $db = config::getConnexion();
            $id = $_GET['delete'];
            $sql = "DELETE FROM `medical_record` WHERE id = :id";
            $req = $db->prepare($sql);
            try {
                $req->execute(['id' => $id]);
                header('Location:mr.php');
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }

    public function update($medicalRecord, $id)
    {
        $sql = "UPDATE `medical_record` SET `name`=:name, `date_of_birth`=:date_of_birth, `gender`=:gender, `medical_history`=:medical_history, `allergies`=:allergies, `user_id`=:user_id WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $medicalRecord->getName(),
                'date_of_birth' => $medicalRecord->getDateOfBirth(),
                'gender' => $medicalRecord->getGender(),
                'medical_history' => $medicalRecord->getMedicalHistory(),
                'allergies' => $medicalRecord->getAllergies(),
                'user_id' => $medicalRecord->getUserId(),
                'id' => $id,
            ]);
            header('Location:mr.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}

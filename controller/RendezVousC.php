<?php
require_once('C:/xampp/htdocs/hajer_maatoug/WEB/config.php');
include 'C:/xampp/htdocs/hajer_maatoug/WEB/model/rendezvous.php';

class RendezVousC
{
    public function create($rendezvous)
    {
        $sql = "INSERT INTO `rendez_vous`(`appointment_date`, `reason`) VALUES (:appointment_date, :reason)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'appointment_date' => $rendezvous->getAppointmentDate(),
                'reason' => $rendezvous->getReason(),
            ]);
            header('Location:rdv.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM rendez_vous";
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
        $sql = "SELECT * FROM rendez_vous WHERE id LIKE '%$r%' OR medical_record_id LIKE '%$r%' OR reason LIKE '%$r%' OR status LIKE '%$r%'";
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
        $sql = "SELECT * FROM rendez_vous ORDER BY $r";
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
        $sql = "SELECT * FROM rendez_vous WHERE id = :id";
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
            $sql = "DELETE FROM `rendez_vous` WHERE id = :id";
            $req = $db->prepare($sql);
            try {
                $req->execute(['id' => $id]);
                header('Location:rdv.php');
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }

    public function stat()
    {
        $sql = "SELECT 
    DATE_FORMAT(appointment_date, '%Y-%m') AS month_year,
    COUNT(*) AS rdv_count,
    (COUNT(*) / (SELECT COUNT(*) FROM rendez_vous) * 100) AS percentage
FROM 
    rendez_vous
GROUP BY 
    month_year
ORDER BY 
    month_year;
;";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($rendezvous, $id)
    {
        $sql = "UPDATE `rendez_vous` SET  `appointment_date`=:appointment_date, `reason`=:reason, `status`=:status WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'appointment_date' => $rendezvous->getAppointmentDate(),
                'reason' => $rendezvous->getReason(),
                'status' => $rendezvous->getStatus(),
                'id' => $id,
            ]);
            header('Location:rdv.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function take($idu, $id)
    {
        $sql = "UPDATE `rendez_vous` SET `status`='Scheduled',`id_user`= :idu WHERE `id` =:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idu' => $idu,
                'id' => $id,
            ]);
            header('Location:histo.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}

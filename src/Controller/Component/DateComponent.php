<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Date component
 */
class DateComponent extends Component
{
    /**
     * Calculate age using birthday
     * 
     * @param date $birthday
     * @return int $age
     */
    public function computeAge($birthday)
    {
        $bday = new \DateTime($birthday);
        $today = new \DateTime();

        return $bday->diff($today)->y;
    }
}

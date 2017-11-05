<?php

namespace App\APIs;

use Faker\Factory;
use \Carbon\Carbon;

class FakePatientData
{
    /**
     * Faker\Factory instance for generate fake data.
     *
     * @var Faker\Factory
     */
    private $faker;
    
    /**
     * Patient's gender.
     *
     * @var mixed
     */
    private $gender = '';

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Implementation.
     * Query patient data form api by $hn.
     *
     * @param string
     * @return array
     */
    public function getPatient($hn)
    {
        if ($this->gender === '') {
            $this->gender = (($hn % 2) == 0);
        }

        $data['reply_code'] = 0;
        $data['reply_text'] = 'OK';
        $data['hn'] = $hn;
        $data['title'] = $this->gender ? $this->faker->titleFemale : $this->faker->titleMale;
        $data['first_name'] = $this->gender ? $this->faker->firstNameFemale : $this->faker->firstNameMale;
        $data['last_name'] = $this->faker->lastName;
        $data['patient_name'] = $data['title'] . ' ' . $data['first_name'] . ' ' .$data['last_name'];
        $data['gender'] = $this->gender ? 0 : 1;
        $data['dob'] = $this->faker->date('Y-m-d', Carbon::now()->subYears(15));

        return $data;
    }

    /**
     * Implementation.
     * Query admission data form api by $an.
     *
     * @param string
     * @return array
     */
    public function getAdmission($an)
    {
        $this->gender = (($an % 2) == 0);
        $stay = $this->faker->numberBetween(1, 28); // random length of stay from 1 to 28 days
        
        $data['reply_code'] = 0;
        $data['reply_text'] = 'OK';
        $data['an'] = $an;
        $data['hn'] = $this->faker->ean8; // random 8 digits
        $patient = $this->getPatient($data['hn']);
        $data += $patient ;
        $data['datetime_admit'] = Carbon::now()->subDays($stay)->toDateTimeString();
        $data['ward_name'] = $this->faker->words(2, true);
        $data['attending_name'] = 'Dr. ' . $this->faker->firstName . ' ' . $this->faker->lastName;
        $data['datetime_dc'] = Carbon::now()->subDays($this->faker->numberBetween(1, $stay))->toDateTimeString();
        
        return $data;
    }

    /**
     * Implementation.
     * Query lastest admission data from api by $hn.
     *
     * @param string
     * @return array
     */
    public function getPatientLastestAdmission($hn)
    {
        $data['reply_code'] = 0;
        $data['reply_text'] = 'OK';

        $patient = $this->getPatient($hn);
        $data['an'] = $this->faker->ean8; // random 8 digits
        $admit = $this->getAdmission($data['an']);

        $data += $patient ;
        $data['datetime_admit'] = $admit['datetime_admit'];
        $data['ward_name'] = $admit['ward_name'];
        $data['attending_name'] = $admit['attending_name'];
        $data['datetime_dc'] = $admit['datetime_dc'];

        return $data;
    }
}

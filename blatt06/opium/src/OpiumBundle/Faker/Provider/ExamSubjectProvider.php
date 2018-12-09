<?php

namespace OpiumBundle\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class ExamSubjectProvider extends BaseProvider
{
    const SUBJECTS = [
        'Datenbanksysteme',
        'Informatik B: Grundlagen der Software-Entwicklung',
        'Informatik D: Einführung in die Theoretische Informatik',
        'Mathematik für Anwender I',
        'Mathematik für Anwender II',
        'Einführung in den Algorithmenentwurf',
        'Entwurf digitaler Systeme',
        'Mobilkommunikation',
        'Rechnernetze und deren Leistungsbewertung',
        'Robotik',
        'Scheduling',
        'Web-Technologien I',
        'Web-Technologien II',
        'Analysis II',
        'Diskrete Mathematik',
        'Funktionentheorie',
        'Numerische Mathematik',
        'Action & Cognition I',
        'Action & Cognition II',
        'Introduction to Artificial Intelligence and Logic Programming',
        'Introduction to Computational Linguistics',
        'Introduction to the Philosophy of Mind',
        'Machine Learning',
        'Neurodynamics',
        'Daten und Modelle',
        'Geographische Informationssysteme',
        'Gleichungsbasierte Modelle I',
        'Umweltrisikoanalyse',
        'Experimentalphysik 1',
        'Experimentalphysik 2',
        'Experimentalphysik 3',
        'Experimentalphysik 4',
        'Mathematische Methoden der Physik 2',
        'Theoretische Physik 1',
        'Theoretische Physik 2',
        'Theoretische Physik 3',
        'Theoretische Physik 4',
    ];

    public function examSubject()
    {
        return self::randomElement(self::SUBJECTS);
    }
}

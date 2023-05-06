<?php

namespace App\Traits;

use Zip;

trait ZipMakerTrait
{
    public function makeZip($pathFiles, $zipName, $savePath = null)
    {
        /**
         * Créer un dossier entitée: par ex tubes/smc/movies
         * Chercher la data, save en JSON et CSV (tubes-DATE.json/.csv) et les save dans le dossier entitées.
         * Ajouter les datasheets dans le dossier associé par entitée
         */
        $zip = Zip::create($zipName);

        foreach ($pathFiles as $file) {
            $filenameArray = explode("/", $file);
            $filename = $filenameArray[intval(sizeof($filenameArray) - 1)];
            $zip->add(public_path('storage/') . $file, 'tubes/datasheets/' . $filename);
        }

        // foreach ($files as $file) {
        //     $zip->add(public_path('storage/') . $file);
        // }
        $zip->saveTo(public_path() . '/storage');
        return 'ok';
    }
}
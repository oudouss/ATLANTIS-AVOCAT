<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeederCustom extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | Contacts
        |--------------------------------------------------------------------------
        */

        $contactDataType = DataType::where('slug', 'contacts')->firstOrFail();


        $dataRow = $this->dataRow($contactDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'category');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Catégorie',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" =>[
                        "option1" => "Adversaire",
                        "option2" => "Client",
                        "option3" => "Juge",
                        "option4" => "Mandataire Judiciaire",
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Type',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" => [
                        "option1" => "Homme",
                        "option2" => "Femme",
                        "option3" => "Personne Morale",
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Titre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default"=>"option1",
                    "options"=>[
                        "option1"=>"Madame",
                        "option2"=>"Mademoiselle",
                        "option3"=>"Monsieur",
                        "option4"=>"Personne Morale",
                        ],
                    "display" => [
                        'width' => 4,
                    ],    
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nom',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages"=>[
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'adress');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Adresse',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'cp');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Code Postal',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'city');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Ville',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'country');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Pays',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default"    => "Maroc",
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'cin');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'CIN',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun code CIN!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'ice');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'ICE',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun code ICE!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 11,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'phone');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Téléphone',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun TÉLÉPHONE!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 12,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Email',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun EMAIL!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'fix');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Fixe',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun TÉLÉPHONE FIXE!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'fax');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Fax',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun FAX!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 15,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'work');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Fonction',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun FONCTION!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 16,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'site');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Site',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez laisser ce champs vide, si aucun SITE!",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 17,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 18,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 19,
            ])->save();
        }
        $dataRow = $this->dataRow($contactDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Lawsuits
        |--------------------------------------------------------------------------
        */

        $affaireDataType = DataType::where('slug', 'affaires')->firstOrFail();


        $dataRow = $this->dataRow($affaireDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($affaireDataType, 'client_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Client',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'opponent_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Partie Adverse',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'caseType');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Domaine',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" => [
                        "option1"  => "Commercial",
                        "option2"  => "Communautaire",
                        "option3"  => "Environnement",
                        "option4"  => "Fiscal",
                        "option5"  => "Immobilier",
                        "option6"  => "Pénal",
                        "option7"  => "Public",
                        "option8"  => "Rural",
                        "option9"  => "Social",
                        "option10" => "Propriété Intellectuelle",
                        "option11" => "Relations internationales",
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'procedure');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Procédure',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" => [
                        "option1" => "Assignation",
                        "option2" => "Commandement Immobilier",
                        "option3" => "Contestation",
                        "option4" => "Nantissement F.C",
                        "option5" => "Mesures Conservatoires",
                        "option6"  => "Mesures Exécutoires",
                        "option7"  => "Recouvrement",
                        "option8"  => "Autres",
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'caseNum');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Réf Affaire',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation"=> [
                        "rule"=>"required",
                        "messages"=>[
                            "required"=>":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'fileNum');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Dossier N°',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required|unique:lawsuits,fileNum,id",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                            "unique"=> ":attribute: Ce dossier existe déjà. Choisisez un autre numéro!",

                        ],
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'curateur');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Procédure Curateur',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "on" => "Déclencher",
                    "off" => "Non",
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 11,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'state');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'État',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" => [
                    "option1" => "En-Cours",
                    "option2" => "Suspendue",
                    "option3" => "Classée",
                    "option4" => "Archivée",
                    ],
                    "display" => [
                        'width' => 4,
                    ],
                ],
                'order'        => 12,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'acceptation');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date Acceptation',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "format" => "%d-%m-%Y",
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                            "date" => ":attribute: Ce champ doit obligatoirement être une date.",
                        ],
                    ],
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'classement');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date Classement',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "format" => "%d-%m-%Y",
                    "validation" => [
                        "rule"  => "required_if:state,option3",
                        "messages" => [
                            "required_if" => ":attribute: Ce champ est obligatoire!",

                        ],
                    ],
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'archivage');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date Archivage',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "format" => "%d-%m-%Y",
                    "validation" => [
                        "rule"  => "required_if:state,option4",
                        "messages" => [
                            "required_if" => ":attribute: Ce champ est obligatoire!",

                        ],
                    ],
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 15,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'convention_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Convention',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description"   => "Vous pouvez laisser ce champs vide, si aucune convention",
                    "display"       => [
                        'width' => 6,
                    ],
                ],
                'order'        => 16,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'creance');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Créance',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Montant de la créance. Vous pouvez laisser ce champs vide, si aucune créance pour cette affaire!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 6,
                    ],
                    "validation" => [
                        "rule"  => "required_if:procedure,option1,option2,option3,option4",
                        "messages" => [
                            "required_if" => ":attribute: Ce champ est obligatoire, pour cette procédure!",

                        ],
                    ],
                ],
                'order'        => 18,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'notes');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Notes',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 19,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 40,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifiée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 41,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 42,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'lawsuit_belongsto_contact_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Client',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    "scope"         => "client",
                    "model"         => "App\\Contact",
                    "table"         => "contacts",
                    "type"          => "belongsTo",
                    "column"        => "client_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'lawsuit_belongsto_contact_relationship_1');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Partie Adverse',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    "scope"         => "adversaire",
                    "model"         => "App\\Contact",
                    "table"         => "contacts",
                    "type"          => "belongsTo",
                    "column"        => "opponent_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 6,
                    ],
                ], 
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'lawsuit_belongstomany_user_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Utilisateurs',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 0,
                'details'      => [
                    "scope"         => "client",
                    "model"         => "App\\User",
                    "table"         => "users",
                    "type"          => "belongsToMany",
                    "column"        => "id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "lawsuit_user",
                    "pivot"         => "1",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 12,
                    ],
                ], 
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($affaireDataType, 'lawsuit_belongsto_convention_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Convention',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description"   => "Vous pouvez laisser ce champs vide, si aucune convention",
                    "model"         => "App\\Convention",
                    "table"         => "conventions",
                    "type"          => "belongsTo",
                    "column"        => "convention_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 6,
                    ],
                ], 
                'order'        => 17,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Stades
        |--------------------------------------------------------------------------
        */

        $stadeDataType = DataType::where('slug', 'stades')->firstOrFail();

        $dataRow = $this->dataRow($stadeDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'lawsuit_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Affaire',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Titre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ],
                    "default" => "option1",
                    "options" => [
                    "option1"   => "A0: Acceptation Dossier (M.E.D)",
                    "option2"   => "A1: Audience",
                    "option3"   => "A2: Notification et Exécution CI",
                    "option4"   => "A3: Expertise Comptable",
                    "option5"   => "A4: Jugement A.D.D",
                    "option6"   => "A5: Jugement DEFINITIF",
                    "option7"   => "A6: Demande Notification et Execution (F.C)",
                    "option8"   => "A7: Adjudication",
                    "option9"   => "B0: Acceptation Dossier",
                    "option10"  => "B1: Mise en demeure (art 114 CC)",
                    "option11"  => "B2: Notification",
                    "option12"  => "B3: Procédure Curateur",
                    "option13"  => "B4: Saisine du juge",
                    "option14"  => "B5: Expertise Mobilière",
                    "option15"  => "B7: Vente (F.C)",
                    "option16"  => "C0: Acceptation Dossier",
                    "option17"  => "C1: Dépôt CI",
                    "option18"  => "C2: Notification et Exécution CI",
                    "option19"  => "C3: Procédure Curateur",
                    "option20"  => "C4: Publications CI",
                    "option21"  => "C5: Expertise Immobilière",
                    "option22"  => "C6: Rapport Expertise Immobilière",
                    "option23"  => "C7: Vente Immobilière",
                    ],

                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",                        ],
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'state');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'État',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "on" => "Fini",
                    "off" => "En-Cours",
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'observation');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Observation',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($stadeDataType, 'stade_belongsto_lawsuit_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Affaire',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    "model"         => "App\\Lawsuit",
                    "table"         => "lawsuits",
                    "type"          => "belongsTo",
                    "column"        => "lawsuit_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                ], 
                'order'        => 3,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Attachements
        |--------------------------------------------------------------------------
        */

        $attachementDataType = DataType::where('slug', 'pieces-jointes')->firstOrFail();

        $dataRow = $this->dataRow($attachementDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'stade_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Stade',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'lawsuit_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Affaire',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Titre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ]
                    ]
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'file',
                'display_name' => 'Documents',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "edit" => [
                            "rule" => "nullable"
                        ],
                        "add" => [
                            "rule" => "required"
                        ],
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire."
                        ]
                    ]
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'attachement_belongsto_lawsuit_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Affaire',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    "model"         => "App\\Lawsuit",
                    "table"         => "lawsuits",
                    "type"          => "belongsTo",
                    "column"        => "lawsuit_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                ], 
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($attachementDataType, 'attachement_belongsto_stade_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Stade',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    "model"         => "App\\Stade",
                    "table"         => "stades",
                    "type"          => "belongsTo",
                    "column"        => "stade_id",
                    "key"           => "id",
                    "label"         => "nom",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                ], 
                'order'        => 5,
            ])->save();
        }
        /*
        |--------------------------------------------------------------------------
        | Events
        |--------------------------------------------------------------------------
        */
        $eventDataType = DataType::where('slug', 'calendar')->firstOrFail();
        $dataRow = $this->dataRow($eventDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Utilisateur',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => [
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'lawsuit_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Affaire',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => [
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 11,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Titre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 12,
                    ],
                ],
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'start_date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Date Début',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "format" => "%d-%m-%Y",
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'end_date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Date Fin',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "format" => "%d-%m-%Y",
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'background_color');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'color',
                'display_name' => 'Couleur du Fond',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default"=>"#22A7F0",
                    "display" => [
                        'width' => 3,
                    ],
                
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'text_color');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'color',
                'display_name' => 'Couleur du text',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "#FFFFFF",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Notes',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "display" => [
                        'width' => 12,
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Crée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'event_belongstomany_user_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'relationship',
                'display_name' => 'Utilisateurs',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => [
                    "scope" => "access",
                    "model" => "App\\User",
                    "table" => "users",
                    "type" => "belongsToMany",
                    "column" => "id",
                    "key" => "id",
                    "label" => "name",
                    "pivot_table" => "event_user",
                    "pivot" => "1",
                    "taggable" => "0",
                    'details'      => [
                        "display" => [
                            'width' => 6,
                        ],
                    ],
                ],
                'order' => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'event_belongsto_lawsuit_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'relationship',
                'display_name' => 'Affaire',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => [
                    "scope" => "currentUser",
                    "model" => "App\\Lawsuit",
                    "table" => "lawsuits",
                    "type" => "belongsTo",
                    "column" => "lawsuit_id",
                    "key" => "id",
                    "label" => "name",
                    "pivot_table" => "attachements",
                    "pivot" => "0",
                    "taggable" => "0",
                    'details'      => [
                        "display" => [
                            'width' => 6,
                        ],
                    ],
                ],
                'order' => 12,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Billings
        |--------------------------------------------------------------------------
        */
        $facturesDataType = DataType::where('slug', 'factures')->firstOrFail();
        $dataRow = $this->dataRow($facturesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'lawsuit_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Affaire',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "display" => [
                        'width' => 12,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages"=>[
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Type',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Type de la facture",
                    "default"=> "option1",
                    "options"=> [
                        "option1"=> "FACTURE",
                        "option2"=> "NOTE D'HONORAIRES",
                        "option3"=> "NOTE DE FRAIS"
                    ],
                    "display" => [
                        'width' => 2,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages"=>[
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'tax');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'TVA%',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Taxe sur la Valeur Ajoutée. Vous pouvez laisser ce champs vide, si aucune TVA!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'days');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Jours',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Nombre de jours avant la date d'échéance de la facture. Vous pouvez laisser ce champs vide, la valeur par défault de 15 jours sera utilisée!",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date Facturation',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Date de facturation. Vous pouvez laisser ce champs vide, la date d'haujourd'hui sera utilisée!",
                    "format" => "%d-%m-%Y",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'paid_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Date Payement',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Date de payement de la facture",
                    "format" => "%d-%m-%Y",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'number');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Facture N°',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details' => [
                    "description" => "Numéro de la facture. Vous pouvez laisser ce champs vide, il sera auto-généré!",
                    "step"=> 1,
                    "min"=> 1,
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'serie');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Série',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details' => [
                    "description" => "Série de la facture. Vous pouvez laisser ce champs vide, l'année en cours sera utilisée!",
                    "display" => [
                        'width' => 6,
                    ],
                    "validation" => [
                        "rule" => "nullable|regex:~[0-9]{4}$~",
                        "messages"=>[
                            "regex" => ":attribute: Merci de saisir l'année de facturation en 4 chiffre! exemple: 2020",
                        ],
                    ],
                ],
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'item1');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Mission',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Titre et déscription de la mission",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'unit1');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Unité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Unité de la mission. Vous pouvez laisser ce champs vide, si aucune unité!",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'qty1');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Quantité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Quantité de la mission. Vous pouvez laisser ce champs vide, il prend la valeur 1 par défault!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 15,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'price1');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Honoraire',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Honoraire de la mission",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages"=>[
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                ],
                'order'        => 16,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'item2');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Mission',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Titre et déscription de la mission",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 17,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'unit2');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Unité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Unité de la mission. Vous pouvez laisser ce champs vide, si aucune unité!",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 18,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'qty2');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Quantité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Quantité de la mission. Vous pouvez laisser ce champs vide, il prend la valeur 1 par défault!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 19,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'price2');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Honoraire',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Honoraire de la mission",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 20,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'item3');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Mission',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Titre et déscription de la mission",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 21,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'unit3');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Unité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Unité de la mission. Vous pouvez laisser ce champs vide, si aucune unité!",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 22,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'qty3');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Quantité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Quantité de la mission. Vous pouvez laisser ce champs vide, il prend la valeur 1 par défault!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 23,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'price3');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Honoraire',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Honoraire de la mission",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],                 
                ],
                'order'        => 24,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'item4');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Mission',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Déscription de la mission",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 25,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'unit4');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Unité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Unité de la mission. Vous pouvez laisser ce champs vide, si aucune unité!",
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 26,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'qty4');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Quantité',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Quantité de la mission. Vous pouvez laisser ce champs vide, il prend la valeur 1 par défault!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 27,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'price4');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Honoraire',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Honoraire de la mission",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 28,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'note');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Note',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Vous pouvez ajouter une note à la facture",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 12,
                    ],
                ],
                'order'        => 29,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'total_amount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Montant Total',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 1,
                'details' => [
                    "description" => "Montant total de la facture",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 30,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'pdf');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'file',
                'display_name' => 'Pdf',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 1,
                'details' => [
                    "description" => "le pdf de la facture",
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 31,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 32,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifiée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 33,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 34,
            ])->save();
        }
        $dataRow = $this->dataRow($facturesDataType, 'billing_belongsto_lawsuit_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'relationship',
                'display_name' => 'Affaire',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => [
                    "display" => [
                        'width' => 12,
                    ],
                    "model" => "App\\Lawsuit",
                    "table" => "lawsuits",
                    "type" => "belongsTo",
                    "column" => "lawsuit_id",
                    "key" => "id",
                    "label" => "name",
                    "pivot_table" => "attachements",
                    "pivot" => "0",
                    "taggable" => "0",
                ],
                'order' => 3,
            ])->save();
        }
        /*
        |--------------------------------------------------------------------------
        | Conventions
        |--------------------------------------------------------------------------
        */
        $conventionsDataType = DataType::where('slug', 'conventions')->firstOrFail();
        $dataRow = $this->dataRow($conventionsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Titre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "validation"=> [
                        "rule"=>"required|unique:conventions,name,id",
                        "messages"=>[
                            "required"=>":attribute: Ce champ est obligatoire.",
                            "unique"=>":attribute: Cette convention existe déjà. Choisisez un autre nom!",
                        ],
                    ],
                    "display" => [
                        'width' => 6,
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'procedure');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Procédure',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "default" => "option1",
                    "options" => [
                        "option1" => "Assignation",
                        "option2" => "Commandement Immobilier",
                        "option3" => "Contestation",
                        "option4" => "Nantissement F.C",
                        "option5" => "Mesures Conservatoires",
                        "option6"  => "Mesures Exécutoires",
                        "option7"  => "Recouvrement",
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Montant Fixe ou Pourcentage',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description" => "Honoraire de l'affaire: Montant Fixe ou Pourcentage de la créance",
                    "on" => "Montant Fixe",
                    "off" => "Pourcentage",
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'amount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Montant Fixe',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                    "validation" => [
                        "rule" => "required_if:type,on",
                        "messages" => [
                            "required_if" => ":attribute: Ce champ est obligatoire, si le montant d'honoraire est fixe!",

                        ],
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifiée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 21,
            ])->save();
        }
        $dataRow = $this->dataRow($conventionsDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 23,
            ])->save();
        }
        /*
        |--------------------------------------------------------------------------
        | Honoraires
        |--------------------------------------------------------------------------
        */
        $honorairesDataType = DataType::where('slug', 'honoraires')->firstOrFail();
        $dataRow = $this->dataRow($honorairesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'convention_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Convention',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "display"       => [
                        'width' => 12,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'min_crc');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Min Créance',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire!",
                        ],
                    ],
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'max_crc');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Max Créance',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description"   => "Vous pouvez laisser ce champs vide, si aucune valeur",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 3,
                    ],
                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'percent');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Pourcentage',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire!",
                        ],
                    ],
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'min');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Min Honoraires',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'max');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Max Honoraires',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($honorairesDataType, 'honoraire_belongsto_convention_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Convention',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "scope" => "percent",
                    "model"         => "App\\Convention",
                    "table"         => "conventions",
                    "type"          => "belongsTo",
                    "column"        => "convention_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 12,
                    ],
                ], 
                'order'        => 3,
            ])->save();
        }
        /*
        |--------------------------------------------------------------------------
        | Modalites
        |--------------------------------------------------------------------------
        */
        $modalitesDataType = DataType::where('slug', 'modalites')->firstOrFail();
        $dataRow = $this->dataRow($modalitesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'convention_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Convention',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "display"       => [
                        'width' => 6,
                    ],
                ],
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'bill_type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Type de Facture',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Type de la facture",
                    "default"=> "option1",
                    "options"=> [
                        "option1"=> "FACTURE",
                        "option2"=> "NOTE D'HONORAIRES",
                        "option3"=> "NOTE DE FRAIS"
                    ],
                    "display" => [
                        'width' => 3,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages"=>[
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                ],
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'stade_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Stade',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description" => "Le stade à la fin du quel une facture sera automatiquement générée",
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire.",
                        ],
                    ],
                    "default" => "option1",
                    "options" => [
                    "option1"   => "A0: Acceptation Dossier (M.E.D)",
                    "option2"   => "A1: Audience",
                    "option3"   => "A2: Notification et Exécution CI",
                    "option4"   => "A3: Expertise Comptable",
                    "option5"   => "A4: Jugement A.D.D",
                    "option6"   => "A5: Jugement DEFINITIF",
                    "option7"   => "A6: Demande Notification et Execution (F.C)",
                    "option8"   => "A7: Adjudication",
                    "option9"   => "B0: Acceptation Dossier",
                    "option10"  => "B1: Mise en demeure (art 114 CC)",
                    "option11"  => "B2: Notification",
                    "option12"  => "B3: Procédure Curateur",
                    "option13"  => "B4: Saisine du juge",
                    "option14"  => "B5: Expertise Mobilière",
                    "option15"  => "B7: Vente (F.C)",
                    "option16"  => "C0: Acceptation Dossier",
                    "option17"  => "C1: Dépôt CI",
                    "option18"  => "C2: Notification et Exécution CI",
                    "option19"  => "C3: Procédure Curateur",
                    "option20"  => "C4: Publications CI",
                    "option21"  => "C5: Expertise Immobilière",
                    "option22"  => "C6: Rapport Expertise Immobilière",
                    "option23"  => "C7: Vente Immobilière",
                    ],
                    "display"   => [
                        'width' => 3,
                    ],

                ],
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Mission',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description" => "Déscription de la mission sur la facture",
                    "validation"=> [
                        "rule"=>"required|unique:modalites,name,id",
                        "messages"=>[
                            "required"=>":attribute: Ce champ est obligatoire.",
                            "unique"=>":attribute: Cette Mission existe déjà. Choisisez un autre nom!",
                        ],
                    ],
                    "display"      => [
                        'width' => 6,
                    ],
                ],
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Montant Fixe ou Pourcentage',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "description" => "Honoraire de la mission: Montant Fixe ou Pourcentage de la créance",
                    "on" => "Montant Fixe",
                    "off" => "Pourcentage",
                    "display" => [
                        'width' => 2,
                    ],
                ],
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'amount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Valeur',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Valeur d'honoraire de la mission: Montant Fixe ou Pourcentage",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 2,
                    ],
                    "validation" => [
                        "rule" => "required",
                        "messages" => [
                            "required" => ":attribute: Ce champ est obligatoire!",
                        ],
                    ],
                ],
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'days');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Jours',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Nombre de jours avant la date d'échéance de la facture. Vous pouvez laisser ce champs vide, la valeur par défault de 15 jours sera utilisée!",
                    "step"=> 1,
                    "min"=> 0,
                    "display" => [
                        'width' => 1,
                    ],
                ],
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'tax');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'TVA%',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details' => [
                    "description" => "Taxe sur la Valeur Ajoutée. Vous pouvez laisser ce champs vide, si aucune TVA!",
                    "step"=> 0.01,
                    "min"=> 0,
                    "display" => [
                        'width' => 1,
                    ],
                ],
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Créé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 21,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Supprimé le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 22,
            ])->save();
        }
        $dataRow = $this->dataRow($modalitesDataType, 'modalite_belongsto_convention_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Convention',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "model"         => "App\\Convention",
                    "table"         => "conventions",
                    "type"          => "belongsTo",
                    "column"        => "convention_id",
                    "key"           => "id",
                    "label"         => "name",
                    "pivot_table"   => "attachements",
                    "pivot"         => "0",
                    "taggable"      => "0",
                    "display" => [
                        'width' => 6,
                    ],
                ], 
                'order'        => 3,
            ])->save();
        }


        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $eventDataType = DataType::where('slug', 'permissions')->firstOrFail();
        $dataRow = $this->dataRow($eventDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'key');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Clé',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'table_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Table',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Crée le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($eventDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Modifié le',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}

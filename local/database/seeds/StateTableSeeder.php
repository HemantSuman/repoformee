<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('state')->delete();
        
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 14,
                'name' => 'Victoria',
                'code' => 'VIC',
                'adm1code' => 'AS07',
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 14,
                'name' => 'Tasmania',
                'code' => 'TAS',
                'adm1code' => 'AS06',
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 14,
                'name' => 'Queensland',
                'code' => 'QLD',
                'adm1code' => 'AS04',
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 14,
                'name' => 'New South Wales',
                'code' => 'NSW',
                'adm1code' => 'AS02',
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 14,
                'name' => 'South Australia',
                'code' => 'SA',
                'adm1code' => 'AS05',
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 14,
                'name' => 'Western Australia',
                'code' => 'WA',
                'adm1code' => 'AS08',
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 14,
                'name' => 'Northern Territory',
                'code' => 'NT',
                'adm1code' => 'AS03',
            ),
            7 => 
            array (
                'id' => 8,
                'country_id' => 33,
                'name' => 'Acre',
                'code' => 'AC',
                'adm1code' => 'BR01',
            ),
            8 => 
            array (
                'id' => 10,
                'country_id' => 33,
                'name' => 'AmapÃ¡',
                'code' => 'AP',
                'adm1code' => 'BR03',
            ),
            9 => 
            array (
                'id' => 11,
                'country_id' => 33,
                'name' => 'Bahia',
                'code' => 'BA',
                'adm1code' => 'BR05',
            ),
            10 => 
            array (
                'id' => 12,
                'country_id' => 33,
                'name' => 'GoiÃ¡s',
                'code' => 'GO',
                'adm1code' => 'BR10',
            ),
            11 => 
            array (
                'id' => 13,
                'country_id' => 33,
                'name' => 'PiauÃ­',
                'code' => 'PI',
                'adm1code' => 'BR20',
            ),
            12 => 
            array (
                'id' => 14,
                'country_id' => 33,
                'name' => 'CearÃ¡',
                'code' => 'CE',
                'adm1code' => 'BR06',
            ),
            13 => 
            array (
                'id' => 15,
                'country_id' => 33,
                'name' => 'ParanÃ¡',
                'code' => 'PR',
                'adm1code' => 'BR18',
            ),
            14 => 
            array (
                'id' => 16,
                'country_id' => 33,
                'name' => 'Alagoas',
                'code' => 'AL',
                'adm1code' => 'BR02',
            ),
            15 => 
            array (
                'id' => 17,
                'country_id' => 33,
                'name' => 'ParaÃ­ba',
                'code' => 'PB',
                'adm1code' => 'BR17',
            ),
            16 => 
            array (
                'id' => 18,
                'country_id' => 33,
                'name' => 'Roraima',
                'code' => 'RR',
                'adm1code' => 'BR25',
            ),
            17 => 
            array (
                'id' => 19,
                'country_id' => 33,
                'name' => 'Sergipe',
                'code' => 'SE',
                'adm1code' => 'BR28',
            ),
            18 => 
            array (
                'id' => 20,
                'country_id' => 33,
                'name' => 'Amazonas',
                'code' => 'AM',
                'adm1code' => 'BR04',
            ),
            19 => 
            array (
                'id' => 21,
                'country_id' => 33,
                'name' => 'MaranhÃ£o',
                'code' => 'MA',
                'adm1code' => 'BR13',
            ),
            20 => 
            array (
                'id' => 22,
                'country_id' => 33,
                'name' => 'RondÃ´nia',
                'code' => 'RO',
                'adm1code' => 'BR24',
            ),
            21 => 
            array (
                'id' => 24,
                'country_id' => 33,
                'name' => 'SÃ£o Paulo',
                'code' => 'SP',
                'adm1code' => 'BR27',
            ),
            22 => 
            array (
                'id' => 25,
                'country_id' => 33,
                'name' => 'Tocantins',
                'code' => 'TO',
                'adm1code' => 'BR31',
            ),
            23 => 
            array (
                'id' => 26,
                'country_id' => 33,
                'name' => 'Mato Grosso',
                'code' => 'MT',
                'adm1code' => 'BR14',
            ),
            24 => 
            array (
                'id' => 27,
                'country_id' => 33,
                'name' => 'Minas Gerais',
                'code' => 'MG',
                'adm1code' => 'BR15',
            ),
            25 => 
            array (
                'id' => 28,
                'country_id' => 33,
                'name' => 'EspÃ­rito Santo',
                'code' => 'ES',
                'adm1code' => 'BR08',
            ),
            26 => 
            array (
                'id' => 29,
                'country_id' => 33,
                'name' => 'Rio de Janeiro',
                'code' => 'RJ',
                'adm1code' => 'BR21',
            ),
            27 => 
            array (
                'id' => 30,
                'country_id' => 33,
                'name' => 'Santa Catarina',
                'code' => 'SC',
                'adm1code' => 'BR26',
            ),
            28 => 
            array (
                'id' => 32,
                'country_id' => 33,
                'name' => 'Rio Grande do Sul',
                'code' => 'RS',
                'adm1code' => 'BR23',
            ),
            29 => 
            array (
                'id' => 33,
                'country_id' => 33,
                'name' => 'Mato Grosso do Sul',
                'code' => 'MS',
                'adm1code' => 'BR11',
            ),
            30 => 
            array (
                'id' => 34,
                'country_id' => 33,
                'name' => 'Rio Grande do Norte',
                'code' => 'RN',
                'adm1code' => 'BR22',
            ),
            31 => 
            array (
                'id' => 35,
                'country_id' => 43,
                'name' => 'Quebec',
                'code' => 'QC',
                'adm1code' => 'CA10',
            ),
            32 => 
            array (
                'id' => 36,
                'country_id' => 43,
                'name' => 'Alberta',
                'code' => 'AB',
                'adm1code' => 'CA01',
            ),
            33 => 
            array (
                'id' => 37,
                'country_id' => 43,
                'name' => 'Ontario',
                'code' => 'ON',
                'adm1code' => 'CA08',
            ),
            34 => 
            array (
                'id' => 38,
                'country_id' => 43,
                'name' => 'Manitoba',
                'code' => 'MB',
                'adm1code' => 'CA03',
            ),
            35 => 
            array (
                'id' => 39,
                'country_id' => 43,
                'name' => 'Nova Scotia',
                'code' => 'NS',
                'adm1code' => 'CA07',
            ),
            36 => 
            array (
                'id' => 40,
                'country_id' => 43,
                'name' => 'Saskatchewan',
                'code' => 'SK',
                'adm1code' => 'CA11',
            ),
            37 => 
            array (
                'id' => 41,
                'country_id' => 43,
                'name' => 'Newfoundland and Labrador',
                'code' => 'NF',
                'adm1code' => 'CA05',
            ),
            38 => 
            array (
                'id' => 42,
                'country_id' => 43,
                'name' => 'New Brunswick',
                'code' => 'NB',
                'adm1code' => 'CA04',
            ),
            39 => 
            array (
                'id' => 43,
                'country_id' => 43,
                'name' => 'British Columbia',
                'code' => 'BC',
                'adm1code' => 'CA02',
            ),
            40 => 
            array (
                'id' => 45,
                'country_id' => 43,
                'name' => 'Prince Edward Island',
                'code' => 'PE',
                'adm1code' => 'CA09',
            ),
            41 => 
            array (
                'id' => 46,
                'country_id' => 43,
                'name' => 'Northwest Territories',
                'code' => 'NT',
                'adm1code' => 'CA13',
            ),
            42 => 
            array (
                'id' => 49,
                'country_id' => 114,
                'name' => 'Bali',
                'code' => 'BA',
                'adm1code' => 'ID02',
            ),
            43 => 
            array (
                'id' => 56,
                'country_id' => 159,
                'name' => 'Sonora',
                'code' => 'SO',
                'adm1code' => 'MX26',
            ),
            44 => 
            array (
                'id' => 59,
                'country_id' => 159,
                'name' => 'Jalisco',
                'code' => 'JA',
                'adm1code' => 'MX14',
            ),
            45 => 
            array (
                'id' => 60,
                'country_id' => 159,
                'name' => 'Hidalgo',
                'code' => 'HI',
                'adm1code' => 'MX13',
            ),
            46 => 
            array (
                'id' => 61,
                'country_id' => 159,
                'name' => 'Morelos',
                'code' => 'MR',
                'adm1code' => 'MX17',
            ),
            47 => 
            array (
                'id' => 62,
                'country_id' => 159,
                'name' => 'Chiapas',
                'code' => 'CP',
                'adm1code' => 'MX05',
            ),
            48 => 
            array (
                'id' => 63,
                'country_id' => 159,
                'name' => 'Tabasco',
                'code' => 'TB',
                'adm1code' => 'MX27',
            ),
            49 => 
            array (
                'id' => 66,
                'country_id' => 159,
                'name' => 'Guerrero',
                'code' => 'GR',
                'adm1code' => 'MX12',
            ),
            50 => 
            array (
                'id' => 69,
                'country_id' => 159,
                'name' => 'Nuevo Leon',
                'code' => 'NL',
                'adm1code' => 'MX19',
            ),
            51 => 
            array (
                'id' => 70,
                'country_id' => 159,
                'name' => 'Tamaulipas',
                'code' => 'TM',
                'adm1code' => 'MX28',
            ),
            52 => 
            array (
                'id' => 71,
                'country_id' => 159,
                'name' => 'Guanajuato',
                'code' => 'GJ',
                'adm1code' => 'MX11',
            ),
            53 => 
            array (
                'id' => 72,
                'country_id' => 159,
                'name' => 'Quintana Roo',
                'code' => 'QR',
                'adm1code' => 'MX23',
            ),
            54 => 
            array (
                'id' => 73,
                'country_id' => 159,
                'name' => 'Baja California',
                'code' => 'BN',
                'adm1code' => 'MX02',
            ),
            55 => 
            array (
                'id' => 74,
                'country_id' => 159,
                'name' => 'Baja California Sur',
                'code' => 'BS',
                'adm1code' => 'MX03',
            ),
            56 => 
            array (
                'id' => 75,
                'country_id' => 165,
                'name' => 'Tov',
                'code' => 'TO',
                'adm1code' => 'MG18',
            ),
            57 => 
            array (
                'id' => 76,
                'country_id' => 165,
                'name' => 'Uvs',
                'code' => 'UV',
                'adm1code' => 'MG19',
            ),
            58 => 
            array (
                'id' => 80,
                'country_id' => 165,
                'name' => 'Dornod',
                'code' => 'DD',
                'adm1code' => 'MG06',
            ),
            59 => 
            array (
                'id' => 81,
                'country_id' => 165,
                'name' => 'Hovsgol',
                'code' => 'HG',
                'adm1code' => 'MG13',
            ),
            60 => 
            array (
                'id' => 82,
                'country_id' => 165,
                'name' => 'Selenge',
                'code' => 'SL',
                'adm1code' => 'MG16',
            ),
            61 => 
            array (
                'id' => 86,
                'country_id' => 165,
                'name' => 'Suhbaatar',
                'code' => 'SB',
                'adm1code' => 'MG17',
            ),
            62 => 
            array (
                'id' => 91,
                'country_id' => 203,
                'name' => 'Komi',
                'code' => 'KO',
                'adm1code' => 'RS34',
            ),
            63 => 
            array (
                'id' => 105,
                'country_id' => 203,
                'name' => 'Dagestan',
                'code' => 'DA',
                'adm1code' => 'RS17',
            ),
            64 => 
            array (
                'id' => 106,
                'country_id' => 203,
                'name' => 'Mariy-El',
                'code' => 'ME',
                'adm1code' => 'RS45',
            ),
            65 => 
            array (
                'id' => 110,
                'country_id' => 203,
                'name' => 'Tatarstan',
                'code' => 'TT',
                'adm1code' => 'RS73',
            ),
            66 => 
            array (
                'id' => 122,
                'country_id' => 254,
                'name' => 'Alabama',
                'code' => 'AL',
                'adm1code' => '',
            ),
            67 => 
            array (
                'id' => 123,
                'country_id' => 254,
                'name' => 'Alaska',
                'code' => 'AK',
                'adm1code' => '',
            ),
            68 => 
            array (
                'id' => 124,
                'country_id' => 254,
                'name' => 'Arizona',
                'code' => 'AZ',
                'adm1code' => '',
            ),
            69 => 
            array (
                'id' => 125,
                'country_id' => 254,
                'name' => 'Arkansas',
                'code' => 'AR',
                'adm1code' => '',
            ),
            70 => 
            array (
                'id' => 126,
                'country_id' => 254,
                'name' => 'California',
                'code' => 'CA',
                'adm1code' => '',
            ),
            71 => 
            array (
                'id' => 127,
                'country_id' => 254,
                'name' => 'Colorado',
                'code' => 'CO',
                'adm1code' => '',
            ),
            72 => 
            array (
                'id' => 128,
                'country_id' => 254,
                'name' => 'Connecticut',
                'code' => 'CT',
                'adm1code' => '',
            ),
            73 => 
            array (
                'id' => 129,
                'country_id' => 254,
                'name' => 'Delaware',
                'code' => 'DE',
                'adm1code' => '',
            ),
            74 => 
            array (
                'id' => 130,
                'country_id' => 254,
                'name' => 'District of Columbia',
                'code' => 'DC',
                'adm1code' => '',
            ),
            75 => 
            array (
                'id' => 131,
                'country_id' => 254,
                'name' => 'Florida',
                'code' => 'FL',
                'adm1code' => '',
            ),
            76 => 
            array (
                'id' => 132,
                'country_id' => 254,
                'name' => 'Georgia',
                'code' => 'GA',
                'adm1code' => '',
            ),
            77 => 
            array (
                'id' => 133,
                'country_id' => 254,
                'name' => 'Hawaii',
                'code' => 'HI',
                'adm1code' => '',
            ),
            78 => 
            array (
                'id' => 134,
                'country_id' => 254,
                'name' => 'Idaho',
                'code' => 'ID',
                'adm1code' => '',
            ),
            79 => 
            array (
                'id' => 135,
                'country_id' => 254,
                'name' => 'Illinois',
                'code' => 'IL',
                'adm1code' => '',
            ),
            80 => 
            array (
                'id' => 136,
                'country_id' => 254,
                'name' => 'Indiana',
                'code' => 'IN',
                'adm1code' => '',
            ),
            81 => 
            array (
                'id' => 137,
                'country_id' => 254,
                'name' => 'Iowa',
                'code' => 'IA',
                'adm1code' => '',
            ),
            82 => 
            array (
                'id' => 138,
                'country_id' => 254,
                'name' => 'Kansas',
                'code' => 'KS',
                'adm1code' => '',
            ),
            83 => 
            array (
                'id' => 139,
                'country_id' => 254,
                'name' => 'Kentucky',
                'code' => 'KY',
                'adm1code' => '',
            ),
            84 => 
            array (
                'id' => 140,
                'country_id' => 254,
                'name' => 'Louisiana',
                'code' => 'LA',
                'adm1code' => '',
            ),
            85 => 
            array (
                'id' => 141,
                'country_id' => 254,
                'name' => 'Maine',
                'code' => 'ME',
                'adm1code' => '',
            ),
            86 => 
            array (
                'id' => 142,
                'country_id' => 254,
                'name' => 'Maryland',
                'code' => 'MD',
                'adm1code' => '',
            ),
            87 => 
            array (
                'id' => 143,
                'country_id' => 254,
                'name' => 'Massachusetts',
                'code' => 'MA',
                'adm1code' => '',
            ),
            88 => 
            array (
                'id' => 144,
                'country_id' => 254,
                'name' => 'Michigan',
                'code' => 'MI',
                'adm1code' => '',
            ),
            89 => 
            array (
                'id' => 145,
                'country_id' => 254,
                'name' => 'Minnesota',
                'code' => 'MN',
                'adm1code' => '',
            ),
            90 => 
            array (
                'id' => 146,
                'country_id' => 254,
                'name' => 'Mississippi',
                'code' => 'MS',
                'adm1code' => '',
            ),
            91 => 
            array (
                'id' => 147,
                'country_id' => 254,
                'name' => 'Missouri',
                'code' => 'MO',
                'adm1code' => '',
            ),
            92 => 
            array (
                'id' => 148,
                'country_id' => 254,
                'name' => 'Montana',
                'code' => 'MT',
                'adm1code' => '',
            ),
            93 => 
            array (
                'id' => 149,
                'country_id' => 254,
                'name' => 'Nebraska',
                'code' => 'NE',
                'adm1code' => '',
            ),
            94 => 
            array (
                'id' => 150,
                'country_id' => 254,
                'name' => 'Nevada',
                'code' => 'NV',
                'adm1code' => '',
            ),
            95 => 
            array (
                'id' => 151,
                'country_id' => 254,
                'name' => 'New Hampshire',
                'code' => 'NH',
                'adm1code' => '',
            ),
            96 => 
            array (
                'id' => 152,
                'country_id' => 254,
                'name' => 'New Jersey',
                'code' => 'NJ',
                'adm1code' => '',
            ),
            97 => 
            array (
                'id' => 153,
                'country_id' => 254,
                'name' => 'New Mexico',
                'code' => 'NM',
                'adm1code' => '',
            ),
            98 => 
            array (
                'id' => 154,
                'country_id' => 254,
                'name' => 'New York',
                'code' => 'NY',
                'adm1code' => '',
            ),
            99 => 
            array (
                'id' => 155,
                'country_id' => 254,
                'name' => 'North Carolina',
                'code' => 'NC',
                'adm1code' => '',
            ),
            100 => 
            array (
                'id' => 156,
                'country_id' => 254,
                'name' => 'North Dakota',
                'code' => 'ND',
                'adm1code' => '',
            ),
            101 => 
            array (
                'id' => 157,
                'country_id' => 254,
                'name' => 'Ohio',
                'code' => 'OH',
                'adm1code' => '',
            ),
            102 => 
            array (
                'id' => 158,
                'country_id' => 254,
                'name' => 'Oklahoma',
                'code' => 'OK',
                'adm1code' => '',
            ),
            103 => 
            array (
                'id' => 159,
                'country_id' => 254,
                'name' => 'Oregon',
                'code' => 'OR',
                'adm1code' => '',
            ),
            104 => 
            array (
                'id' => 160,
                'country_id' => 254,
                'name' => 'Pennsylvania',
                'code' => 'PA',
                'adm1code' => '',
            ),
            105 => 
            array (
                'id' => 161,
                'country_id' => 254,
                'name' => 'Rhode Island',
                'code' => 'RI',
                'adm1code' => '',
            ),
            106 => 
            array (
                'id' => 162,
                'country_id' => 254,
                'name' => 'South Carolina',
                'code' => 'SC',
                'adm1code' => '',
            ),
            107 => 
            array (
                'id' => 163,
                'country_id' => 254,
                'name' => 'South Dakota',
                'code' => 'SD',
                'adm1code' => '',
            ),
            108 => 
            array (
                'id' => 164,
                'country_id' => 254,
                'name' => 'Tennessee',
                'code' => 'TN',
                'adm1code' => '',
            ),
            109 => 
            array (
                'id' => 165,
                'country_id' => 254,
                'name' => 'Texas',
                'code' => 'TX',
                'adm1code' => '',
            ),
            110 => 
            array (
                'id' => 166,
                'country_id' => 254,
                'name' => 'Utah',
                'code' => 'UT',
                'adm1code' => '',
            ),
            111 => 
            array (
                'id' => 167,
                'country_id' => 254,
                'name' => 'Virginia',
                'code' => 'VA',
                'adm1code' => '',
            ),
            112 => 
            array (
                'id' => 168,
                'country_id' => 254,
                'name' => 'Washington',
                'code' => 'WA',
                'adm1code' => '',
            ),
            113 => 
            array (
                'id' => 169,
                'country_id' => 254,
                'name' => 'West Virginia',
                'code' => 'WV',
                'adm1code' => '',
            ),
            114 => 
            array (
                'id' => 170,
                'country_id' => 254,
                'name' => 'Wisconsin',
                'code' => 'WI',
                'adm1code' => '',
            ),
            115 => 
            array (
                'id' => 171,
                'country_id' => 254,
                'name' => 'Wyoming',
                'code' => 'WY',
                'adm1code' => '',
            ),
            116 => 
            array (
                'id' => 172,
                'country_id' => 254,
                'name' => 'Vermont',
                'code' => 'VT',
                'adm1code' => '',
            ),
            117 => 
            array (
                'id' => 174,
                'country_id' => 14,
                'name' => 'Australian Capital Territory',
                'code' => 'ACT',
                'adm1code' => 'AS01',
            ),
            118 => 
            array (
                'id' => 189,
                'country_id' => 114,
                'name' => 'Papua',
                'code' => 'IJ',
                'adm1code' => 'ID09',
            ),
            119 => 
            array (
                'id' => 193,
                'country_id' => 165,
                'name' => 'Bulgan',
                'code' => 'BU',
                'adm1code' => 'MG21',
            ),
            120 => 
            array (
                'id' => 194,
                'country_id' => 165,
                'name' => 'Hovd',
                'code' => 'HD',
                'adm1code' => 'MG12',
            ),
            121 => 
            array (
                'id' => 196,
                'country_id' => 159,
                'name' => 'Chihuahua',
                'code' => 'CH',
                'adm1code' => 'MX06',
            ),
            122 => 
            array (
                'id' => 197,
                'country_id' => 159,
                'name' => 'Colima',
                'code' => 'CL',
                'adm1code' => 'MX08',
            ),
            123 => 
            array (
                'id' => 198,
                'country_id' => 159,
                'name' => 'Durango',
                'code' => 'DU',
                'adm1code' => 'MX10',
            ),
            124 => 
            array (
                'id' => 201,
                'country_id' => 159,
                'name' => 'Oaxaca',
                'code' => 'OA',
                'adm1code' => 'MX20',
            ),
            125 => 
            array (
                'id' => 203,
                'country_id' => 159,
                'name' => 'San Luis Potosi',
                'code' => 'SL',
                'adm1code' => 'MX24',
            ),
            126 => 
            array (
                'id' => 204,
                'country_id' => 159,
                'name' => 'Tlaxcala',
                'code' => 'TL',
                'adm1code' => 'MX29',
            ),
            127 => 
            array (
                'id' => 206,
                'country_id' => 159,
                'name' => 'Zacatecas',
                'code' => 'ZA',
                'adm1code' => 'MX32',
            ),
            128 => 
            array (
                'id' => 268,
                'country_id' => 269,
                'name' => 'World',
                'code' => '--',
                'adm1code' => '',
            ),
            129 => 
            array (
                'id' => 539,
                'country_id' => 2,
                'name' => 'Albania',
                'code' => 'AL',
                'adm1code' => '',
            ),
            130 => 
            array (
                'id' => 540,
                'country_id' => 3,
                'name' => 'Algeria',
                'code' => 'DZ',
                'adm1code' => '',
            ),
            131 => 
            array (
                'id' => 541,
                'country_id' => 4,
                'name' => 'American Samoa',
                'code' => 'AS',
                'adm1code' => '',
            ),
            132 => 
            array (
                'id' => 542,
                'country_id' => 5,
                'name' => 'Andorra',
                'code' => 'AD',
                'adm1code' => '',
            ),
            133 => 
            array (
                'id' => 543,
                'country_id' => 6,
                'name' => 'Angola',
                'code' => 'AO',
                'adm1code' => '',
            ),
            134 => 
            array (
                'id' => 544,
                'country_id' => 7,
                'name' => 'Anguilla',
                'code' => 'AI',
                'adm1code' => '',
            ),
            135 => 
            array (
                'id' => 545,
                'country_id' => 8,
                'name' => 'Antarctica',
                'code' => 'AQ',
                'adm1code' => '',
            ),
            136 => 
            array (
                'id' => 546,
                'country_id' => 9,
                'name' => 'Antigua and Barbuda',
                'code' => 'AG',
                'adm1code' => '',
            ),
            137 => 
            array (
                'id' => 547,
                'country_id' => 10,
                'name' => 'Argentina',
                'code' => 'AR',
                'adm1code' => '',
            ),
            138 => 
            array (
                'id' => 548,
                'country_id' => 11,
                'name' => 'Armenia',
                'code' => 'AM',
                'adm1code' => '',
            ),
            139 => 
            array (
                'id' => 549,
                'country_id' => 12,
                'name' => 'Aruba',
                'code' => 'AW',
                'adm1code' => '',
            ),
            140 => 
            array (
                'id' => 550,
                'country_id' => 13,
                'name' => 'Ashmore and Cartier',
                'code' => '--',
                'adm1code' => '',
            ),
            141 => 
            array (
                'id' => 552,
                'country_id' => 15,
                'name' => 'Austria',
                'code' => 'AT',
                'adm1code' => '',
            ),
            142 => 
            array (
                'id' => 553,
                'country_id' => 16,
                'name' => 'Azerbaijan',
                'code' => 'AZ',
                'adm1code' => '',
            ),
            143 => 
            array (
                'id' => 554,
                'country_id' => 17,
                'name' => 'The Bahamas',
                'code' => 'BS',
                'adm1code' => '',
            ),
            144 => 
            array (
                'id' => 555,
                'country_id' => 18,
                'name' => 'Bahrain',
                'code' => 'BH',
                'adm1code' => '',
            ),
            145 => 
            array (
                'id' => 556,
                'country_id' => 19,
                'name' => 'Baker Island',
                'code' => '--',
                'adm1code' => '',
            ),
            146 => 
            array (
                'id' => 557,
                'country_id' => 20,
                'name' => 'Bangladesh',
                'code' => 'BD',
                'adm1code' => '',
            ),
            147 => 
            array (
                'id' => 558,
                'country_id' => 21,
                'name' => 'Barbados',
                'code' => 'BB',
                'adm1code' => '',
            ),
            148 => 
            array (
                'id' => 559,
                'country_id' => 22,
                'name' => 'Bassas da India',
                'code' => '--',
                'adm1code' => '',
            ),
            149 => 
            array (
                'id' => 560,
                'country_id' => 23,
                'name' => 'Belarus',
                'code' => 'BY',
                'adm1code' => '',
            ),
            150 => 
            array (
                'id' => 561,
                'country_id' => 24,
                'name' => 'Belgium',
                'code' => 'BE',
                'adm1code' => '',
            ),
            151 => 
            array (
                'id' => 563,
                'country_id' => 26,
                'name' => 'Benin',
                'code' => 'BJ',
                'adm1code' => '',
            ),
            152 => 
            array (
                'id' => 564,
                'country_id' => 27,
                'name' => 'Bermuda',
                'code' => 'BM',
                'adm1code' => '',
            ),
            153 => 
            array (
                'id' => 565,
                'country_id' => 28,
                'name' => 'Bhutan',
                'code' => 'BT',
                'adm1code' => '',
            ),
            154 => 
            array (
                'id' => 566,
                'country_id' => 29,
                'name' => 'Bolivia',
                'code' => 'BO',
                'adm1code' => '',
            ),
            155 => 
            array (
                'id' => 567,
                'country_id' => 30,
                'name' => 'Bosnia and Herzegovina',
                'code' => 'BA',
                'adm1code' => '',
            ),
            156 => 
            array (
                'id' => 568,
                'country_id' => 31,
                'name' => 'Botswana',
                'code' => 'BW',
                'adm1code' => '',
            ),
            157 => 
            array (
                'id' => 569,
                'country_id' => 32,
                'name' => 'Bouvet Island',
                'code' => 'BV',
                'adm1code' => '',
            ),
            158 => 
            array (
                'id' => 570,
                'country_id' => 33,
                'name' => 'Brazil',
                'code' => 'BR',
                'adm1code' => '',
            ),
            159 => 
            array (
                'id' => 571,
                'country_id' => 34,
                'name' => 'British Indian Ocean Territory',
                'code' => 'IO',
                'adm1code' => '',
            ),
            160 => 
            array (
                'id' => 572,
                'country_id' => 35,
                'name' => 'British Virgin Islands',
                'code' => 'VG',
                'adm1code' => '',
            ),
            161 => 
            array (
                'id' => 573,
                'country_id' => 36,
                'name' => 'Brunei Darussalam',
                'code' => 'BN',
                'adm1code' => '',
            ),
            162 => 
            array (
                'id' => 574,
                'country_id' => 37,
                'name' => 'Bulgaria',
                'code' => 'BG',
                'adm1code' => '',
            ),
            163 => 
            array (
                'id' => 575,
                'country_id' => 38,
                'name' => 'Burkina Faso',
                'code' => 'BF',
                'adm1code' => '',
            ),
            164 => 
            array (
                'id' => 576,
                'country_id' => 39,
                'name' => 'Burma',
                'code' => 'MM',
                'adm1code' => '',
            ),
            165 => 
            array (
                'id' => 577,
                'country_id' => 40,
                'name' => 'Burundi',
                'code' => 'BI',
                'adm1code' => '',
            ),
            166 => 
            array (
                'id' => 578,
                'country_id' => 41,
                'name' => 'Cambodia',
                'code' => 'KH',
                'adm1code' => '',
            ),
            167 => 
            array (
                'id' => 579,
                'country_id' => 42,
                'name' => 'Cameroon',
                'code' => 'CM',
                'adm1code' => '',
            ),
            168 => 
            array (
                'id' => 580,
                'country_id' => 43,
                'name' => 'Canada',
                'code' => 'CA',
                'adm1code' => '',
            ),
            169 => 
            array (
                'id' => 581,
                'country_id' => 44,
                'name' => 'Cape Verde',
                'code' => 'CV',
                'adm1code' => '',
            ),
            170 => 
            array (
                'id' => 582,
                'country_id' => 45,
                'name' => 'Cayman Islands',
                'code' => 'KY',
                'adm1code' => '',
            ),
            171 => 
            array (
                'id' => 583,
                'country_id' => 46,
                'name' => 'Central African Republic',
                'code' => 'CF',
                'adm1code' => '',
            ),
            172 => 
            array (
                'id' => 584,
                'country_id' => 47,
                'name' => 'Chad',
                'code' => 'TD',
                'adm1code' => '',
            ),
            173 => 
            array (
                'id' => 585,
                'country_id' => 48,
                'name' => 'Chile',
                'code' => 'CL',
                'adm1code' => '',
            ),
            174 => 
            array (
                'id' => 586,
                'country_id' => 49,
                'name' => 'China',
                'code' => 'CN',
                'adm1code' => '',
            ),
            175 => 
            array (
                'id' => 587,
                'country_id' => 50,
                'name' => 'Christmas Island',
                'code' => 'CX',
                'adm1code' => '',
            ),
            176 => 
            array (
                'id' => 588,
                'country_id' => 51,
                'name' => 'Clipperton Island',
                'code' => '--',
                'adm1code' => '',
            ),
            177 => 
            array (
                'id' => 589,
                'country_id' => 52,
            'name' => 'Cocos (Keeling) Islands',
                'code' => 'CC',
                'adm1code' => '',
            ),
            178 => 
            array (
                'id' => 590,
                'country_id' => 53,
                'name' => 'Colombia',
                'code' => 'CO',
                'adm1code' => '',
            ),
            179 => 
            array (
                'id' => 591,
                'country_id' => 54,
                'name' => 'Comoros',
                'code' => 'KM',
                'adm1code' => '',
            ),
            180 => 
            array (
                'id' => 592,
                'country_id' => 55,
                'name' => 'Democratic Republic of the Congo',
                'code' => 'CD',
                'adm1code' => '',
            ),
            181 => 
            array (
                'id' => 593,
                'country_id' => 56,
                'name' => 'Republic of the Congo',
                'code' => 'CG',
                'adm1code' => '',
            ),
            182 => 
            array (
                'id' => 594,
                'country_id' => 57,
                'name' => 'Cook Islands',
                'code' => 'CK',
                'adm1code' => '',
            ),
            183 => 
            array (
                'id' => 595,
                'country_id' => 58,
                'name' => 'Coral Sea Islands',
                'code' => '--',
                'adm1code' => '',
            ),
            184 => 
            array (
                'id' => 596,
                'country_id' => 59,
                'name' => 'Costa Rica',
                'code' => 'CR',
                'adm1code' => '',
            ),
            185 => 
            array (
                'id' => 597,
                'country_id' => 60,
                'name' => 'Cote d\'Ivoire',
                'code' => 'CI',
                'adm1code' => '',
            ),
            186 => 
            array (
                'id' => 598,
                'country_id' => 61,
                'name' => 'Croatia',
                'code' => 'HR',
                'adm1code' => '',
            ),
            187 => 
            array (
                'id' => 599,
                'country_id' => 62,
                'name' => 'Cuba',
                'code' => 'CU',
                'adm1code' => '',
            ),
            188 => 
            array (
                'id' => 600,
                'country_id' => 63,
                'name' => 'Cyprus',
                'code' => 'CY',
                'adm1code' => '',
            ),
            189 => 
            array (
                'id' => 601,
                'country_id' => 64,
                'name' => 'Czech Republic',
                'code' => 'CZ',
                'adm1code' => '',
            ),
            190 => 
            array (
                'id' => 602,
                'country_id' => 65,
                'name' => 'Denmark',
                'code' => 'DK',
                'adm1code' => '',
            ),
            191 => 
            array (
                'id' => 604,
                'country_id' => 67,
                'name' => 'Dominica',
                'code' => 'DM',
                'adm1code' => '',
            ),
            192 => 
            array (
                'id' => 605,
                'country_id' => 68,
                'name' => 'Dominican Republic',
                'code' => 'DO',
                'adm1code' => '',
            ),
            193 => 
            array (
                'id' => 606,
                'country_id' => 69,
                'name' => 'East Timor',
                'code' => 'TP',
                'adm1code' => '',
            ),
            194 => 
            array (
                'id' => 607,
                'country_id' => 70,
                'name' => 'Ecuador',
                'code' => 'EC',
                'adm1code' => '',
            ),
            195 => 
            array (
                'id' => 608,
                'country_id' => 71,
                'name' => 'Egypt',
                'code' => 'EG',
                'adm1code' => '',
            ),
            196 => 
            array (
                'id' => 609,
                'country_id' => 72,
                'name' => 'El Salvador',
                'code' => 'SV',
                'adm1code' => '',
            ),
            197 => 
            array (
                'id' => 610,
                'country_id' => 73,
                'name' => 'Equatorial Guinea',
                'code' => 'GQ',
                'adm1code' => '',
            ),
            198 => 
            array (
                'id' => 611,
                'country_id' => 74,
                'name' => 'Eritrea',
                'code' => 'ER',
                'adm1code' => '',
            ),
            199 => 
            array (
                'id' => 612,
                'country_id' => 75,
                'name' => 'Estonia',
                'code' => 'EE',
                'adm1code' => '',
            ),
            200 => 
            array (
                'id' => 613,
                'country_id' => 76,
                'name' => 'Ethiopia',
                'code' => 'ET',
                'adm1code' => '',
            ),
            201 => 
            array (
                'id' => 614,
                'country_id' => 77,
                'name' => 'Europa Island',
                'code' => '--',
                'adm1code' => '',
            ),
            202 => 
            array (
                'id' => 615,
                'country_id' => 78,
            'name' => 'Falkland Islands (Islas Malvinas)',
                'code' => 'FK',
                'adm1code' => '',
            ),
            203 => 
            array (
                'id' => 616,
                'country_id' => 79,
                'name' => 'Faroe Islands',
                'code' => 'FO',
                'adm1code' => '',
            ),
            204 => 
            array (
                'id' => 617,
                'country_id' => 80,
                'name' => 'Fiji',
                'code' => 'FJ',
                'adm1code' => '',
            ),
            205 => 
            array (
                'id' => 618,
                'country_id' => 81,
                'name' => 'Finland',
                'code' => 'FI',
                'adm1code' => '',
            ),
            206 => 
            array (
                'id' => 619,
                'country_id' => 82,
                'name' => 'France',
                'code' => 'FR',
                'adm1code' => '',
            ),
            207 => 
            array (
                'id' => 620,
                'country_id' => 83,
                'name' => 'Metropolitan France',
                'code' => 'FX',
                'adm1code' => '',
            ),
            208 => 
            array (
                'id' => 621,
                'country_id' => 84,
                'name' => 'French Guiana',
                'code' => 'GF',
                'adm1code' => '',
            ),
            209 => 
            array (
                'id' => 622,
                'country_id' => 85,
                'name' => 'French Polynesia',
                'code' => 'PF',
                'adm1code' => '',
            ),
            210 => 
            array (
                'id' => 623,
                'country_id' => 86,
                'name' => 'French Southern and Antarctic Lands',
                'code' => 'TF',
                'adm1code' => '',
            ),
            211 => 
            array (
                'id' => 624,
                'country_id' => 87,
                'name' => 'Gabon',
                'code' => 'GA',
                'adm1code' => '',
            ),
            212 => 
            array (
                'id' => 625,
                'country_id' => 88,
                'name' => 'The Gambia',
                'code' => 'GM',
                'adm1code' => '',
            ),
            213 => 
            array (
                'id' => 626,
                'country_id' => 89,
                'name' => 'Gaza Strip',
                'code' => '--',
                'adm1code' => '',
            ),
            214 => 
            array (
                'id' => 627,
                'country_id' => 90,
                'name' => 'Georgia',
                'code' => 'GE',
                'adm1code' => '',
            ),
            215 => 
            array (
                'id' => 628,
                'country_id' => 91,
                'name' => 'Germany',
                'code' => 'DE',
                'adm1code' => '',
            ),
            216 => 
            array (
                'id' => 629,
                'country_id' => 92,
                'name' => 'Ghana',
                'code' => 'GH',
                'adm1code' => '',
            ),
            217 => 
            array (
                'id' => 630,
                'country_id' => 93,
                'name' => 'Gibraltar',
                'code' => 'GI',
                'adm1code' => '',
            ),
            218 => 
            array (
                'id' => 631,
                'country_id' => 94,
                'name' => 'Glorioso Islands',
                'code' => '--',
                'adm1code' => '',
            ),
            219 => 
            array (
                'id' => 632,
                'country_id' => 95,
                'name' => 'Greece',
                'code' => 'GR',
                'adm1code' => '',
            ),
            220 => 
            array (
                'id' => 633,
                'country_id' => 96,
                'name' => 'Greenland',
                'code' => 'GL',
                'adm1code' => '',
            ),
            221 => 
            array (
                'id' => 634,
                'country_id' => 97,
                'name' => 'Grenada',
                'code' => 'GD',
                'adm1code' => '',
            ),
            222 => 
            array (
                'id' => 635,
                'country_id' => 98,
                'name' => 'Guadeloupe',
                'code' => 'GP',
                'adm1code' => '',
            ),
            223 => 
            array (
                'id' => 636,
                'country_id' => 99,
                'name' => 'Guam',
                'code' => 'GU',
                'adm1code' => '',
            ),
            224 => 
            array (
                'id' => 638,
                'country_id' => 101,
                'name' => 'Guernsey',
                'code' => 'GG',
                'adm1code' => '',
            ),
            225 => 
            array (
                'id' => 639,
                'country_id' => 102,
                'name' => 'Guinea',
                'code' => 'GN',
                'adm1code' => '',
            ),
            226 => 
            array (
                'id' => 640,
                'country_id' => 103,
                'name' => 'Guinea-Bissau',
                'code' => 'GW',
                'adm1code' => '',
            ),
            227 => 
            array (
                'id' => 641,
                'country_id' => 104,
                'name' => 'Guyana',
                'code' => 'GY',
                'adm1code' => '',
            ),
            228 => 
            array (
                'id' => 642,
                'country_id' => 105,
                'name' => 'Haiti',
                'code' => 'HT',
                'adm1code' => '',
            ),
            229 => 
            array (
                'id' => 643,
                'country_id' => 106,
                'name' => 'Heard Island and McDonald Islands',
                'code' => 'HM',
                'adm1code' => '',
            ),
            230 => 
            array (
                'id' => 644,
                'country_id' => 107,
            'name' => 'Holy See (Vatican City)',
                'code' => 'VA',
                'adm1code' => '',
            ),
            231 => 
            array (
                'id' => 645,
                'country_id' => 108,
                'name' => 'Honduras',
                'code' => 'HN',
                'adm1code' => '',
            ),
            232 => 
            array (
                'id' => 646,
                'country_id' => 109,
            'name' => 'Hong Kong (SAR)',
                'code' => 'HK',
                'adm1code' => '',
            ),
            233 => 
            array (
                'id' => 647,
                'country_id' => 110,
                'name' => 'Howland Island',
                'code' => '--',
                'adm1code' => '',
            ),
            234 => 
            array (
                'id' => 648,
                'country_id' => 111,
                'name' => 'Hungary',
                'code' => 'HU',
                'adm1code' => '',
            ),
            235 => 
            array (
                'id' => 649,
                'country_id' => 112,
                'name' => 'Iceland',
                'code' => 'IS',
                'adm1code' => '',
            ),
            236 => 
            array (
                'id' => 650,
                'country_id' => 113,
                'name' => 'India',
                'code' => 'IN',
                'adm1code' => '',
            ),
            237 => 
            array (
                'id' => 651,
                'country_id' => 114,
                'name' => 'Indonesia',
                'code' => 'ID',
                'adm1code' => '',
            ),
            238 => 
            array (
                'id' => 652,
                'country_id' => 115,
                'name' => 'Iran',
                'code' => 'IR',
                'adm1code' => '',
            ),
            239 => 
            array (
                'id' => 653,
                'country_id' => 116,
                'name' => 'Iraq',
                'code' => 'IQ',
                'adm1code' => '',
            ),
            240 => 
            array (
                'id' => 654,
                'country_id' => 117,
                'name' => 'Ireland',
                'code' => 'IE',
                'adm1code' => '',
            ),
            241 => 
            array (
                'id' => 655,
                'country_id' => 118,
                'name' => 'Israel',
                'code' => 'IL',
                'adm1code' => '',
            ),
            242 => 
            array (
                'id' => 656,
                'country_id' => 119,
                'name' => 'Italy',
                'code' => 'IT',
                'adm1code' => '',
            ),
            243 => 
            array (
                'id' => 657,
                'country_id' => 120,
                'name' => 'Jamaica',
                'code' => 'JM',
                'adm1code' => '',
            ),
            244 => 
            array (
                'id' => 658,
                'country_id' => 121,
                'name' => 'Jan Mayen',
                'code' => '--',
                'adm1code' => '',
            ),
            245 => 
            array (
                'id' => 659,
                'country_id' => 122,
                'name' => 'Japan',
                'code' => 'JP',
                'adm1code' => '',
            ),
            246 => 
            array (
                'id' => 660,
                'country_id' => 123,
                'name' => 'Jarvis Island',
                'code' => '--',
                'adm1code' => '',
            ),
            247 => 
            array (
                'id' => 661,
                'country_id' => 124,
                'name' => 'Jersey',
                'code' => 'JE',
                'adm1code' => '',
            ),
            248 => 
            array (
                'id' => 662,
                'country_id' => 125,
                'name' => 'Johnston Atoll',
                'code' => '--',
                'adm1code' => '',
            ),
            249 => 
            array (
                'id' => 663,
                'country_id' => 126,
                'name' => 'Jordan',
                'code' => 'JO',
                'adm1code' => '',
            ),
            250 => 
            array (
                'id' => 664,
                'country_id' => 127,
                'name' => 'Juan de Nova Island',
                'code' => '--',
                'adm1code' => '',
            ),
            251 => 
            array (
                'id' => 665,
                'country_id' => 128,
                'name' => 'Kazakhstan',
                'code' => 'KZ',
                'adm1code' => '',
            ),
            252 => 
            array (
                'id' => 666,
                'country_id' => 129,
                'name' => 'Kenya',
                'code' => 'KE',
                'adm1code' => '',
            ),
            253 => 
            array (
                'id' => 667,
                'country_id' => 130,
                'name' => 'Kingman Reef',
                'code' => '--',
                'adm1code' => '',
            ),
            254 => 
            array (
                'id' => 668,
                'country_id' => 131,
                'name' => 'Kiribati',
                'code' => 'KI',
                'adm1code' => '',
            ),
            255 => 
            array (
                'id' => 669,
                'country_id' => 132,
                'name' => 'North Korea',
                'code' => 'KP',
                'adm1code' => '',
            ),
            256 => 
            array (
                'id' => 670,
                'country_id' => 133,
                'name' => 'South Korea',
                'code' => 'KR',
                'adm1code' => '',
            ),
            257 => 
            array (
                'id' => 671,
                'country_id' => 134,
                'name' => 'Kuwait',
                'code' => 'KW',
                'adm1code' => '',
            ),
            258 => 
            array (
                'id' => 672,
                'country_id' => 135,
                'name' => 'Kyrgyzstan',
                'code' => 'KG',
                'adm1code' => '',
            ),
            259 => 
            array (
                'id' => 673,
                'country_id' => 136,
                'name' => 'Laos',
                'code' => 'LA',
                'adm1code' => '',
            ),
            260 => 
            array (
                'id' => 674,
                'country_id' => 137,
                'name' => 'Latvia',
                'code' => 'LV',
                'adm1code' => '',
            ),
            261 => 
            array (
                'id' => 675,
                'country_id' => 138,
                'name' => 'Lebanon',
                'code' => 'LB',
                'adm1code' => '',
            ),
            262 => 
            array (
                'id' => 676,
                'country_id' => 139,
                'name' => 'Lesotho',
                'code' => 'LS',
                'adm1code' => '',
            ),
            263 => 
            array (
                'id' => 677,
                'country_id' => 140,
                'name' => 'Liberia',
                'code' => 'LR',
                'adm1code' => '',
            ),
            264 => 
            array (
                'id' => 678,
                'country_id' => 141,
                'name' => 'Libya',
                'code' => 'LY',
                'adm1code' => '',
            ),
            265 => 
            array (
                'id' => 679,
                'country_id' => 142,
                'name' => 'Liechtenstein',
                'code' => 'LI',
                'adm1code' => '',
            ),
            266 => 
            array (
                'id' => 680,
                'country_id' => 143,
                'name' => 'Lithuania',
                'code' => 'LT',
                'adm1code' => '',
            ),
            267 => 
            array (
                'id' => 682,
                'country_id' => 145,
                'name' => 'Macao',
                'code' => 'MO',
                'adm1code' => '',
            ),
            268 => 
            array (
                'id' => 683,
                'country_id' => 146,
                'name' => 'The Former Yugoslav Republic of Macedonia',
                'code' => 'MK',
                'adm1code' => '',
            ),
            269 => 
            array (
                'id' => 684,
                'country_id' => 147,
                'name' => 'Madagascar',
                'code' => 'MG',
                'adm1code' => '',
            ),
            270 => 
            array (
                'id' => 685,
                'country_id' => 148,
                'name' => 'Malawi',
                'code' => 'MW',
                'adm1code' => '',
            ),
            271 => 
            array (
                'id' => 686,
                'country_id' => 149,
                'name' => 'Malaysia',
                'code' => 'MY',
                'adm1code' => '',
            ),
            272 => 
            array (
                'id' => 687,
                'country_id' => 150,
                'name' => 'Maldives',
                'code' => 'MV',
                'adm1code' => '',
            ),
            273 => 
            array (
                'id' => 688,
                'country_id' => 151,
                'name' => 'Mali',
                'code' => 'ML',
                'adm1code' => '',
            ),
            274 => 
            array (
                'id' => 689,
                'country_id' => 152,
                'name' => 'Malta',
                'code' => 'MA',
                'adm1code' => '',
            ),
            275 => 
            array (
                'id' => 690,
                'country_id' => 153,
                'name' => 'Isle of Man',
                'code' => 'IM',
                'adm1code' => '',
            ),
            276 => 
            array (
                'id' => 691,
                'country_id' => 154,
                'name' => 'Marshall Islands',
                'code' => 'MH',
                'adm1code' => '',
            ),
            277 => 
            array (
                'id' => 692,
                'country_id' => 155,
                'name' => 'Martinique',
                'code' => 'MQ',
                'adm1code' => '',
            ),
            278 => 
            array (
                'id' => 693,
                'country_id' => 156,
                'name' => 'Mauritania',
                'code' => 'MR',
                'adm1code' => '',
            ),
            279 => 
            array (
                'id' => 694,
                'country_id' => 157,
                'name' => 'Mauritius',
                'code' => 'MU',
                'adm1code' => '',
            ),
            280 => 
            array (
                'id' => 695,
                'country_id' => 158,
                'name' => 'Mayotte',
                'code' => 'YT',
                'adm1code' => '',
            ),
            281 => 
            array (
                'id' => 697,
                'country_id' => 160,
                'name' => 'Federated States of Micronesia',
                'code' => 'FM',
                'adm1code' => '',
            ),
            282 => 
            array (
                'id' => 698,
                'country_id' => 161,
                'name' => 'Midway Islands',
                'code' => '--',
                'adm1code' => '',
            ),
            283 => 
            array (
                'id' => 699,
                'country_id' => 162,
            'name' => 'Miscellaneous (French)',
                'code' => '--',
                'adm1code' => '',
            ),
            284 => 
            array (
                'id' => 700,
                'country_id' => 163,
                'name' => 'Moldova',
                'code' => 'MD',
                'adm1code' => '',
            ),
            285 => 
            array (
                'id' => 701,
                'country_id' => 164,
                'name' => 'Monaco',
                'code' => 'MC',
                'adm1code' => '',
            ),
            286 => 
            array (
                'id' => 702,
                'country_id' => 165,
                'name' => 'Mongolia',
                'code' => 'MN',
                'adm1code' => '',
            ),
            287 => 
            array (
                'id' => 703,
                'country_id' => 166,
                'name' => 'Montenegro',
                'code' => '--',
                'adm1code' => '',
            ),
            288 => 
            array (
                'id' => 704,
                'country_id' => 167,
                'name' => 'Montserrat',
                'code' => 'MS',
                'adm1code' => '',
            ),
            289 => 
            array (
                'id' => 705,
                'country_id' => 168,
                'name' => 'Morocco',
                'code' => 'MA',
                'adm1code' => '',
            ),
            290 => 
            array (
                'id' => 706,
                'country_id' => 169,
                'name' => 'Mozambique',
                'code' => 'MZ',
                'adm1code' => '',
            ),
            291 => 
            array (
                'id' => 707,
                'country_id' => 170,
                'name' => 'Myanmar',
                'code' => '--',
                'adm1code' => '',
            ),
            292 => 
            array (
                'id' => 708,
                'country_id' => 171,
                'name' => 'Namibia',
                'code' => 'NA',
                'adm1code' => '',
            ),
            293 => 
            array (
                'id' => 709,
                'country_id' => 172,
                'name' => 'Nauru',
                'code' => 'NR',
                'adm1code' => '',
            ),
            294 => 
            array (
                'id' => 710,
                'country_id' => 173,
                'name' => 'Navassa Island',
                'code' => '--',
                'adm1code' => '',
            ),
            295 => 
            array (
                'id' => 711,
                'country_id' => 174,
                'name' => 'Nepal',
                'code' => 'NP',
                'adm1code' => '',
            ),
            296 => 
            array (
                'id' => 712,
                'country_id' => 175,
                'name' => 'The Netherlands',
                'code' => 'NL',
                'adm1code' => '',
            ),
            297 => 
            array (
                'id' => 713,
                'country_id' => 176,
                'name' => 'Netherlands Antilles',
                'code' => 'AN',
                'adm1code' => '',
            ),
            298 => 
            array (
                'id' => 714,
                'country_id' => 177,
                'name' => 'New Caledonia',
                'code' => 'NC',
                'adm1code' => '',
            ),
            299 => 
            array (
                'id' => 715,
                'country_id' => 178,
                'name' => 'New Zealand',
                'code' => 'NZ',
                'adm1code' => '',
            ),
            300 => 
            array (
                'id' => 716,
                'country_id' => 179,
                'name' => 'Nicaragua',
                'code' => 'NI',
                'adm1code' => '',
            ),
            301 => 
            array (
                'id' => 717,
                'country_id' => 180,
                'name' => 'Niger',
                'code' => 'NE',
                'adm1code' => '',
            ),
            302 => 
            array (
                'id' => 718,
                'country_id' => 181,
                'name' => 'Nigeria',
                'code' => 'NG',
                'adm1code' => '',
            ),
            303 => 
            array (
                'id' => 719,
                'country_id' => 182,
                'name' => 'Niue',
                'code' => 'NU',
                'adm1code' => '',
            ),
            304 => 
            array (
                'id' => 720,
                'country_id' => 183,
                'name' => 'Norfolk Island',
                'code' => 'NF',
                'adm1code' => '',
            ),
            305 => 
            array (
                'id' => 721,
                'country_id' => 184,
                'name' => 'Northern Mariana Islands',
                'code' => 'MP',
                'adm1code' => '',
            ),
            306 => 
            array (
                'id' => 722,
                'country_id' => 185,
                'name' => 'Norway',
                'code' => 'NO',
                'adm1code' => '',
            ),
            307 => 
            array (
                'id' => 723,
                'country_id' => 186,
                'name' => 'Oman',
                'code' => 'OM',
                'adm1code' => '',
            ),
            308 => 
            array (
                'id' => 724,
                'country_id' => 187,
                'name' => 'Pakistan',
                'code' => 'PK',
                'adm1code' => '',
            ),
            309 => 
            array (
                'id' => 725,
                'country_id' => 188,
                'name' => 'Palau',
                'code' => 'PW',
                'adm1code' => '',
            ),
            310 => 
            array (
                'id' => 726,
                'country_id' => 189,
                'name' => 'Palmyra Atoll',
                'code' => '--',
                'adm1code' => '',
            ),
            311 => 
            array (
                'id' => 728,
                'country_id' => 191,
                'name' => 'Papua New Guinea',
                'code' => 'PG',
                'adm1code' => '',
            ),
            312 => 
            array (
                'id' => 729,
                'country_id' => 192,
                'name' => 'Paracel Islands',
                'code' => '--',
                'adm1code' => '',
            ),
            313 => 
            array (
                'id' => 730,
                'country_id' => 193,
                'name' => 'Paraguay',
                'code' => 'PY',
                'adm1code' => '',
            ),
            314 => 
            array (
                'id' => 731,
                'country_id' => 194,
                'name' => 'Peru',
                'code' => 'PE',
                'adm1code' => '',
            ),
            315 => 
            array (
                'id' => 732,
                'country_id' => 195,
                'name' => 'Philippines',
                'code' => 'PH',
                'adm1code' => '',
            ),
            316 => 
            array (
                'id' => 733,
                'country_id' => 196,
                'name' => 'Pitcairn Islands',
                'code' => 'PN',
                'adm1code' => '',
            ),
            317 => 
            array (
                'id' => 734,
                'country_id' => 197,
                'name' => 'Poland',
                'code' => 'PL',
                'adm1code' => '',
            ),
            318 => 
            array (
                'id' => 735,
                'country_id' => 198,
                'name' => 'Portugal',
                'code' => 'PT',
                'adm1code' => '',
            ),
            319 => 
            array (
                'id' => 736,
                'country_id' => 199,
                'name' => 'Puerto Rico',
                'code' => 'PR',
                'adm1code' => '',
            ),
            320 => 
            array (
                'id' => 737,
                'country_id' => 200,
                'name' => 'Qatar',
                'code' => 'QA',
                'adm1code' => '',
            ),
            321 => 
            array (
                'id' => 738,
                'country_id' => 201,
                'name' => 'RÃ©union',
                'code' => 'RE',
                'adm1code' => '',
            ),
            322 => 
            array (
                'id' => 739,
                'country_id' => 202,
                'name' => 'Romania',
                'code' => 'RO',
                'adm1code' => '',
            ),
            323 => 
            array (
                'id' => 740,
                'country_id' => 203,
                'name' => 'Russia',
                'code' => 'RU',
                'adm1code' => '',
            ),
            324 => 
            array (
                'id' => 741,
                'country_id' => 204,
                'name' => 'Rwanda',
                'code' => 'RW',
                'adm1code' => '',
            ),
            325 => 
            array (
                'id' => 743,
                'country_id' => 206,
                'name' => 'Saint Kitts and Nevis',
                'code' => 'KN',
                'adm1code' => '',
            ),
            326 => 
            array (
                'id' => 744,
                'country_id' => 207,
                'name' => 'Saint Lucia',
                'code' => 'LC',
                'adm1code' => '',
            ),
            327 => 
            array (
                'id' => 745,
                'country_id' => 208,
                'name' => 'Saint Pierre and Miquelon',
                'code' => 'PM',
                'adm1code' => '',
            ),
            328 => 
            array (
                'id' => 746,
                'country_id' => 209,
                'name' => 'Saint Vincent and the Grenadines',
                'code' => 'VC',
                'adm1code' => '',
            ),
            329 => 
            array (
                'id' => 747,
                'country_id' => 210,
                'name' => 'Samoa',
                'code' => 'WS',
                'adm1code' => '',
            ),
            330 => 
            array (
                'id' => 750,
                'country_id' => 213,
                'name' => 'Saudi Arabia',
                'code' => 'SA',
                'adm1code' => '',
            ),
            331 => 
            array (
                'id' => 751,
                'country_id' => 214,
                'name' => 'Senegal',
                'code' => 'SN',
                'adm1code' => '',
            ),
            332 => 
            array (
                'id' => 752,
                'country_id' => 215,
                'name' => 'Serbia',
                'code' => '--',
                'adm1code' => '',
            ),
            333 => 
            array (
                'id' => 753,
                'country_id' => 216,
                'name' => 'Serbia and Montenegro',
                'code' => '--',
                'adm1code' => '',
            ),
            334 => 
            array (
                'id' => 754,
                'country_id' => 217,
                'name' => 'Seychelles',
                'code' => 'SC',
                'adm1code' => '',
            ),
            335 => 
            array (
                'id' => 755,
                'country_id' => 218,
                'name' => 'Sierra Leone',
                'code' => 'SL',
                'adm1code' => '',
            ),
            336 => 
            array (
                'id' => 756,
                'country_id' => 219,
                'name' => 'Singapore',
                'code' => 'SG',
                'adm1code' => '',
            ),
            337 => 
            array (
                'id' => 757,
                'country_id' => 220,
                'name' => 'Slovakia',
                'code' => 'SK',
                'adm1code' => '',
            ),
            338 => 
            array (
                'id' => 758,
                'country_id' => 221,
                'name' => 'Slovenia',
                'code' => 'SI',
                'adm1code' => '',
            ),
            339 => 
            array (
                'id' => 759,
                'country_id' => 222,
                'name' => 'Solomon Islands',
                'code' => 'SB',
                'adm1code' => '',
            ),
            340 => 
            array (
                'id' => 760,
                'country_id' => 223,
                'name' => 'Somalia',
                'code' => 'SO',
                'adm1code' => '',
            ),
            341 => 
            array (
                'id' => 761,
                'country_id' => 224,
                'name' => 'South Africa',
                'code' => 'ZA',
                'adm1code' => '',
            ),
            342 => 
            array (
                'id' => 762,
                'country_id' => 225,
                'name' => 'South Georgia and the South Sandwich Islands',
                'code' => 'GS',
                'adm1code' => '',
            ),
            343 => 
            array (
                'id' => 763,
                'country_id' => 226,
                'name' => 'Spain',
                'code' => 'ES',
                'adm1code' => '',
            ),
            344 => 
            array (
                'id' => 764,
                'country_id' => 227,
                'name' => 'Spratly Islands',
                'code' => '--',
                'adm1code' => '',
            ),
            345 => 
            array (
                'id' => 765,
                'country_id' => 228,
                'name' => 'Sri Lanka',
                'code' => 'LK',
                'adm1code' => '',
            ),
            346 => 
            array (
                'id' => 766,
                'country_id' => 229,
                'name' => 'Sudan',
                'code' => 'SD',
                'adm1code' => '',
            ),
            347 => 
            array (
                'id' => 767,
                'country_id' => 230,
                'name' => 'Suriname',
                'code' => 'SR',
                'adm1code' => '',
            ),
            348 => 
            array (
                'id' => 768,
                'country_id' => 231,
                'name' => 'Svalbard',
                'code' => 'SJ',
                'adm1code' => '',
            ),
            349 => 
            array (
                'id' => 769,
                'country_id' => 232,
                'name' => 'Swaziland',
                'code' => 'SZ',
                'adm1code' => '',
            ),
            350 => 
            array (
                'id' => 770,
                'country_id' => 233,
                'name' => 'Sweden',
                'code' => 'SE',
                'adm1code' => '',
            ),
            351 => 
            array (
                'id' => 771,
                'country_id' => 234,
                'name' => 'Switzerland',
                'code' => 'CH',
                'adm1code' => '',
            ),
            352 => 
            array (
                'id' => 772,
                'country_id' => 235,
                'name' => 'Syria',
                'code' => 'SY',
                'adm1code' => '',
            ),
            353 => 
            array (
                'id' => 773,
                'country_id' => 236,
                'name' => 'Taiwan',
                'code' => 'TW',
                'adm1code' => '',
            ),
            354 => 
            array (
                'id' => 774,
                'country_id' => 237,
                'name' => 'Tajikistan',
                'code' => 'TJ',
                'adm1code' => '',
            ),
            355 => 
            array (
                'id' => 775,
                'country_id' => 238,
                'name' => 'Tanzania',
                'code' => 'TZ',
                'adm1code' => '',
            ),
            356 => 
            array (
                'id' => 776,
                'country_id' => 239,
                'name' => 'Thailand',
                'code' => 'TH',
                'adm1code' => '',
            ),
            357 => 
            array (
                'id' => 777,
                'country_id' => 240,
                'name' => 'Togo',
                'code' => 'TG',
                'adm1code' => '',
            ),
            358 => 
            array (
                'id' => 778,
                'country_id' => 241,
                'name' => 'Tokelau',
                'code' => 'TK',
                'adm1code' => '',
            ),
            359 => 
            array (
                'id' => 779,
                'country_id' => 242,
                'name' => 'Tonga',
                'code' => 'TO',
                'adm1code' => '',
            ),
            360 => 
            array (
                'id' => 780,
                'country_id' => 243,
                'name' => 'Trinidad and Tobago',
                'code' => 'TT',
                'adm1code' => '',
            ),
            361 => 
            array (
                'id' => 781,
                'country_id' => 244,
                'name' => 'Tromelin Island',
                'code' => '--',
                'adm1code' => '',
            ),
            362 => 
            array (
                'id' => 782,
                'country_id' => 245,
                'name' => 'Tunisia',
                'code' => 'TN',
                'adm1code' => '',
            ),
            363 => 
            array (
                'id' => 783,
                'country_id' => 246,
                'name' => 'Turkey',
                'code' => 'TR',
                'adm1code' => '',
            ),
            364 => 
            array (
                'id' => 784,
                'country_id' => 247,
                'name' => 'Turkmenistan',
                'code' => 'TM',
                'adm1code' => '',
            ),
            365 => 
            array (
                'id' => 785,
                'country_id' => 248,
                'name' => 'Turks and Caicos Islands',
                'code' => 'TC',
                'adm1code' => '',
            ),
            366 => 
            array (
                'id' => 786,
                'country_id' => 249,
                'name' => 'Tuvalu',
                'code' => 'TV',
                'adm1code' => '',
            ),
            367 => 
            array (
                'id' => 787,
                'country_id' => 250,
                'name' => 'Uganda',
                'code' => 'UG',
                'adm1code' => '',
            ),
            368 => 
            array (
                'id' => 788,
                'country_id' => 251,
                'name' => 'Ukraine',
                'code' => 'UA',
                'adm1code' => '',
            ),
            369 => 
            array (
                'id' => 789,
                'country_id' => 252,
                'name' => 'United Arab Emirates',
                'code' => 'AE',
                'adm1code' => '',
            ),
            370 => 
            array (
                'id' => 790,
                'country_id' => 253,
                'name' => 'United Kingdom',
                'code' => 'UK',
                'adm1code' => '',
            ),
            371 => 
            array (
                'id' => 791,
                'country_id' => 254,
                'name' => 'United States',
                'code' => 'US',
                'adm1code' => '',
            ),
            372 => 
            array (
                'id' => 792,
                'country_id' => 255,
                'name' => 'United States Minor Outlying Islands',
                'code' => 'UM',
                'adm1code' => '',
            ),
            373 => 
            array (
                'id' => 793,
                'country_id' => 256,
                'name' => 'Uruguay',
                'code' => 'UY',
                'adm1code' => '',
            ),
            374 => 
            array (
                'id' => 794,
                'country_id' => 257,
                'name' => 'Uzbekistan',
                'code' => 'UZ',
                'adm1code' => '',
            ),
            375 => 
            array (
                'id' => 795,
                'country_id' => 258,
                'name' => 'Vanuatu',
                'code' => 'VU',
                'adm1code' => '',
            ),
            376 => 
            array (
                'id' => 796,
                'country_id' => 259,
                'name' => 'Venezuela',
                'code' => 'VE',
                'adm1code' => '',
            ),
            377 => 
            array (
                'id' => 797,
                'country_id' => 260,
                'name' => 'Vietnam',
                'code' => 'VN',
                'adm1code' => '',
            ),
            378 => 
            array (
                'id' => 798,
                'country_id' => 261,
                'name' => 'Virgin Islands',
                'code' => 'VI',
                'adm1code' => '',
            ),
            379 => 
            array (
                'id' => 799,
                'country_id' => 262,
            'name' => 'Virgin Islands (UK)',
                'code' => '--',
                'adm1code' => '',
            ),
            380 => 
            array (
                'id' => 800,
                'country_id' => 263,
            'name' => 'Virgin Islands (US)',
                'code' => '--',
                'adm1code' => '',
            ),
            381 => 
            array (
                'id' => 801,
                'country_id' => 264,
                'name' => 'Wake Island',
                'code' => '--',
                'adm1code' => '',
            ),
            382 => 
            array (
                'id' => 802,
                'country_id' => 265,
                'name' => 'Wallis and Futuna',
                'code' => 'WF',
                'adm1code' => '',
            ),
            383 => 
            array (
                'id' => 803,
                'country_id' => 266,
                'name' => 'West Bank',
                'code' => '--',
                'adm1code' => '',
            ),
            384 => 
            array (
                'id' => 804,
                'country_id' => 267,
                'name' => 'Western Sahara',
                'code' => 'EH',
                'adm1code' => '',
            ),
            385 => 
            array (
                'id' => 805,
                'country_id' => 268,
                'name' => 'Western Samoa',
                'code' => '--',
                'adm1code' => '',
            ),
            386 => 
            array (
                'id' => 806,
                'country_id' => 270,
                'name' => 'Yemen',
                'code' => 'YE',
                'adm1code' => '',
            ),
            387 => 
            array (
                'id' => 808,
                'country_id' => 272,
                'name' => 'Zaire',
                'code' => '--',
                'adm1code' => '',
            ),
            388 => 
            array (
                'id' => 809,
                'country_id' => 273,
                'name' => 'Zambia',
                'code' => 'ZM',
                'adm1code' => '',
            ),
            389 => 
            array (
                'id' => 810,
                'country_id' => 274,
                'name' => 'Zimbabwe',
                'code' => 'ZW',
                'adm1code' => '',
            ),
            390 => 
            array (
                'id' => 815,
                'country_id' => 43,
                'name' => 'Yukon Territory',
                'code' => 'YT',
                'adm1code' => 'CA12',
            ),
            391 => 
            array (
                'id' => 816,
                'country_id' => 9,
                'name' => 'Barbuda',
                'code' => 'BB',
                'adm1code' => 'AC01',
            ),
            392 => 
            array (
                'id' => 817,
                'country_id' => 9,
                'name' => 'Saint George',
                'code' => 'GE',
                'adm1code' => 'AC03',
            ),
            393 => 
            array (
                'id' => 818,
                'country_id' => 9,
                'name' => 'Saint John',
                'code' => 'JO',
                'adm1code' => 'AC04',
            ),
            394 => 
            array (
                'id' => 819,
                'country_id' => 9,
                'name' => 'Saint Mary',
                'code' => 'MA',
                'adm1code' => 'AC05',
            ),
            395 => 
            array (
                'id' => 820,
                'country_id' => 9,
                'name' => 'Saint Paul',
                'code' => 'PA',
                'adm1code' => 'AC06',
            ),
            396 => 
            array (
                'id' => 821,
                'country_id' => 9,
                'name' => 'Saint Peter',
                'code' => 'PE',
                'adm1code' => 'AC07',
            ),
            397 => 
            array (
                'id' => 822,
                'country_id' => 9,
                'name' => 'Saint Philip',
                'code' => 'PH',
                'adm1code' => 'AC08',
            ),
            398 => 
            array (
                'id' => 823,
                'country_id' => 1,
                'name' => 'Badakhshan',
                'code' => 'BD',
                'adm1code' => 'AF01',
            ),
            399 => 
            array (
                'id' => 824,
                'country_id' => 1,
                'name' => 'Badghis',
                'code' => 'BG',
                'adm1code' => 'AF02',
            ),
            400 => 
            array (
                'id' => 825,
                'country_id' => 1,
                'name' => 'Baghlan',
                'code' => 'BL',
                'adm1code' => 'AF03',
            ),
            401 => 
            array (
                'id' => 827,
                'country_id' => 1,
                'name' => 'Bamian',
                'code' => 'BM',
                'adm1code' => 'AF05',
            ),
            402 => 
            array (
                'id' => 828,
                'country_id' => 1,
                'name' => 'Farah',
                'code' => 'FH',
                'adm1code' => 'AF06',
            ),
            403 => 
            array (
                'id' => 829,
                'country_id' => 1,
                'name' => 'Faryab',
                'code' => 'FB',
                'adm1code' => 'AF07',
            ),
            404 => 
            array (
                'id' => 830,
                'country_id' => 1,
                'name' => 'Ghazni',
                'code' => 'GZ',
                'adm1code' => 'AF08',
            ),
            405 => 
            array (
                'id' => 831,
                'country_id' => 1,
                'name' => 'Ghowr',
                'code' => 'GR',
                'adm1code' => 'AF09',
            ),
            406 => 
            array (
                'id' => 832,
                'country_id' => 1,
                'name' => 'Helmand',
                'code' => 'HM',
                'adm1code' => 'AF10',
            ),
            407 => 
            array (
                'id' => 833,
                'country_id' => 1,
                'name' => 'Herat',
                'code' => 'HR',
                'adm1code' => 'AF11',
            ),
            408 => 
            array (
                'id' => 835,
                'country_id' => 1,
                'name' => 'Kabol',
                'code' => 'KB',
                'adm1code' => 'AF13',
            ),
            409 => 
            array (
                'id' => 836,
                'country_id' => 1,
                'name' => 'Kapisa',
                'code' => 'KP',
                'adm1code' => 'AF14',
            ),
            410 => 
            array (
                'id' => 837,
                'country_id' => 1,
                'name' => 'Konar',
                'code' => 'KR',
                'adm1code' => 'AF15',
            ),
            411 => 
            array (
                'id' => 838,
                'country_id' => 1,
                'name' => 'Laghman',
                'code' => 'LA',
                'adm1code' => 'AF16',
            ),
            412 => 
            array (
                'id' => 839,
                'country_id' => 1,
                'name' => 'Lowgar',
                'code' => 'LW',
                'adm1code' => 'AF17',
            ),
            413 => 
            array (
                'id' => 840,
                'country_id' => 1,
                'name' => 'Nangarhar',
                'code' => 'NG',
                'adm1code' => 'AF18',
            ),
            414 => 
            array (
                'id' => 841,
                'country_id' => 1,
                'name' => 'Nimruz',
                'code' => 'NM',
                'adm1code' => 'AF19',
            ),
            415 => 
            array (
                'id' => 842,
                'country_id' => 1,
                'name' => 'Oruzgan',
                'code' => 'OR',
                'adm1code' => 'AF20',
            ),
            416 => 
            array (
                'id' => 843,
                'country_id' => 1,
                'name' => 'Paktia',
                'code' => 'PT',
                'adm1code' => 'AF21',
            ),
            417 => 
            array (
                'id' => 844,
                'country_id' => 1,
                'name' => 'Parvan',
                'code' => 'PR',
                'adm1code' => 'AF22',
            ),
            418 => 
            array (
                'id' => 845,
                'country_id' => 1,
                'name' => 'Kandahar',
                'code' => 'KD',
                'adm1code' => 'AF23',
            ),
            419 => 
            array (
                'id' => 846,
                'country_id' => 1,
                'name' => 'Kondoz',
                'code' => 'KZ',
                'adm1code' => 'AF24',
            ),
            420 => 
            array (
                'id' => 848,
                'country_id' => 1,
                'name' => 'Takhar',
                'code' => 'TK',
                'adm1code' => 'AF26',
            ),
            421 => 
            array (
                'id' => 849,
                'country_id' => 1,
                'name' => 'Vardak',
                'code' => 'VR',
                'adm1code' => 'AF27',
            ),
            422 => 
            array (
                'id' => 850,
                'country_id' => 1,
                'name' => 'Zabol',
                'code' => 'ZB',
                'adm1code' => 'AF28',
            ),
            423 => 
            array (
                'id' => 851,
                'country_id' => 1,
                'name' => 'Paktika',
                'code' => 'PK',
                'adm1code' => 'AF29',
            ),
            424 => 
            array (
                'id' => 852,
                'country_id' => 1,
                'name' => 'Balkh',
                'code' => 'BK',
                'adm1code' => 'AF30',
            ),
            425 => 
            array (
                'id' => 853,
                'country_id' => 1,
                'name' => 'Jowzjan',
                'code' => 'JW',
                'adm1code' => 'AF31',
            ),
            426 => 
            array (
                'id' => 854,
                'country_id' => 1,
                'name' => 'Samangan',
                'code' => 'SM',
                'adm1code' => 'AF32',
            ),
            427 => 
            array (
                'id' => 855,
                'country_id' => 1,
                'name' => 'Sare Pol',
                'code' => 'SP',
                'adm1code' => 'AF33',
            ),
            428 => 
            array (
                'id' => 856,
                'country_id' => 3,
                'name' => 'Alger',
                'code' => 'AL',
                'adm1code' => 'AG01',
            ),
            429 => 
            array (
                'id' => 857,
                'country_id' => 3,
                'name' => 'Batna',
                'code' => 'BT',
                'adm1code' => 'AG03',
            ),
            430 => 
            array (
                'id' => 858,
                'country_id' => 3,
                'name' => 'Constantine',
                'code' => 'CO',
                'adm1code' => 'AG04',
            ),
            431 => 
            array (
                'id' => 859,
                'country_id' => 3,
                'name' => 'Medea',
                'code' => 'MD',
                'adm1code' => 'AG06',
            ),
            432 => 
            array (
                'id' => 860,
                'country_id' => 3,
                'name' => 'Mostaganem',
                'code' => 'MG',
                'adm1code' => 'AG07',
            ),
            433 => 
            array (
                'id' => 861,
                'country_id' => 3,
                'name' => 'Oran',
                'code' => 'OR',
                'adm1code' => 'AG09',
            ),
            434 => 
            array (
                'id' => 862,
                'country_id' => 3,
                'name' => 'Saida',
                'code' => 'SD',
                'adm1code' => 'AG10',
            ),
            435 => 
            array (
                'id' => 863,
                'country_id' => 3,
                'name' => 'Setif',
                'code' => 'SF',
                'adm1code' => 'AG12',
            ),
            436 => 
            array (
                'id' => 864,
                'country_id' => 3,
                'name' => 'Tiaret',
                'code' => 'TR',
                'adm1code' => 'AG13',
            ),
            437 => 
            array (
                'id' => 865,
                'country_id' => 3,
                'name' => 'Tizi Ouzou',
                'code' => 'TO',
                'adm1code' => 'AG14',
            ),
            438 => 
            array (
                'id' => 866,
                'country_id' => 3,
                'name' => 'Tlemcen',
                'code' => 'TL',
                'adm1code' => 'AG15',
            ),
            439 => 
            array (
                'id' => 867,
                'country_id' => 3,
                'name' => 'Bejaia',
                'code' => 'BJ',
                'adm1code' => 'AG18',
            ),
            440 => 
            array (
                'id' => 868,
                'country_id' => 3,
                'name' => 'Biskra',
                'code' => 'BS',
                'adm1code' => 'AG19',
            ),
            441 => 
            array (
                'id' => 869,
                'country_id' => 3,
                'name' => 'Blida',
                'code' => 'BL',
                'adm1code' => 'AG20',
            ),
            442 => 
            array (
                'id' => 870,
                'country_id' => 3,
                'name' => 'Bouira',
                'code' => 'BU',
                'adm1code' => 'AG21',
            ),
            443 => 
            array (
                'id' => 871,
                'country_id' => 3,
                'name' => 'Djelfa',
                'code' => 'DJ',
                'adm1code' => 'AG22',
            ),
            444 => 
            array (
                'id' => 872,
                'country_id' => 3,
                'name' => 'Guelma',
                'code' => 'GL',
                'adm1code' => 'AG23',
            ),
            445 => 
            array (
                'id' => 873,
                'country_id' => 3,
                'name' => 'Jijel',
                'code' => 'JJ',
                'adm1code' => 'AG24',
            ),
            446 => 
            array (
                'id' => 874,
                'country_id' => 3,
                'name' => 'Laghouat',
                'code' => 'LG',
                'adm1code' => 'AG25',
            ),
            447 => 
            array (
                'id' => 875,
                'country_id' => 3,
                'name' => 'Mascara',
                'code' => 'MC',
                'adm1code' => 'AG26',
            ),
            448 => 
            array (
                'id' => 876,
                'country_id' => 3,
                'name' => 'M\'Sila',
                'code' => 'MS',
                'adm1code' => 'AG27',
            ),
            449 => 
            array (
                'id' => 877,
                'country_id' => 3,
                'name' => 'Oum el Bouaghi',
                'code' => 'OB',
                'adm1code' => 'AG29',
            ),
            450 => 
            array (
                'id' => 878,
                'country_id' => 3,
                'name' => 'Sidi Bel Abbes',
                'code' => 'SB',
                'adm1code' => 'AG30',
            ),
            451 => 
            array (
                'id' => 879,
                'country_id' => 3,
                'name' => 'Skikda',
                'code' => 'SK',
                'adm1code' => 'AG31',
            ),
            452 => 
            array (
                'id' => 880,
                'country_id' => 3,
                'name' => 'Tebessa',
                'code' => 'TB',
                'adm1code' => 'AG33',
            ),
            453 => 
            array (
                'id' => 881,
                'country_id' => 3,
                'name' => 'Adrar',
                'code' => 'AR',
                'adm1code' => 'AG34',
            ),
            454 => 
            array (
                'id' => 882,
                'country_id' => 3,
                'name' => 'Ain Defla',
                'code' => 'AD',
                'adm1code' => 'AG35',
            ),
            455 => 
            array (
                'id' => 883,
                'country_id' => 3,
                'name' => 'Ain Temouchent',
                'code' => 'AT',
                'adm1code' => 'AG36',
            ),
            456 => 
            array (
                'id' => 884,
                'country_id' => 3,
                'name' => 'Annaba',
                'code' => 'AN',
                'adm1code' => 'AG37',
            ),
            457 => 
            array (
                'id' => 885,
                'country_id' => 3,
                'name' => 'Bechar',
                'code' => 'BC',
                'adm1code' => 'AG38',
            ),
            458 => 
            array (
                'id' => 886,
                'country_id' => 3,
                'name' => 'Bordj Bou Arreridj',
                'code' => 'BB',
                'adm1code' => 'AG39',
            ),
            459 => 
            array (
                'id' => 887,
                'country_id' => 3,
                'name' => 'Boumerdes',
                'code' => 'BM',
                'adm1code' => 'AG40',
            ),
            460 => 
            array (
                'id' => 888,
                'country_id' => 3,
                'name' => 'Chlef',
                'code' => 'CH',
                'adm1code' => 'AG41',
            ),
            461 => 
            array (
                'id' => 889,
                'country_id' => 3,
                'name' => 'El Bayadh',
                'code' => 'EB',
                'adm1code' => 'AG42',
            ),
            462 => 
            array (
                'id' => 890,
                'country_id' => 3,
                'name' => 'El Oued',
                'code' => 'EO',
                'adm1code' => 'AG43',
            ),
            463 => 
            array (
                'id' => 891,
                'country_id' => 3,
                'name' => 'El Tarf',
                'code' => 'ET',
                'adm1code' => 'AG44',
            ),
            464 => 
            array (
                'id' => 892,
                'country_id' => 3,
                'name' => 'Ghardaia',
                'code' => 'GR',
                'adm1code' => 'AG45',
            ),
            465 => 
            array (
                'id' => 893,
                'country_id' => 3,
                'name' => 'Illizi',
                'code' => 'IL',
                'adm1code' => 'AG46',
            ),
            466 => 
            array (
                'id' => 894,
                'country_id' => 3,
                'name' => 'Khenchela',
                'code' => 'KH',
                'adm1code' => 'AG47',
            ),
            467 => 
            array (
                'id' => 895,
                'country_id' => 3,
                'name' => 'Mila',
                'code' => 'ML',
                'adm1code' => 'AG48',
            ),
            468 => 
            array (
                'id' => 896,
                'country_id' => 3,
                'name' => 'Naama',
                'code' => 'NA',
                'adm1code' => 'AG49',
            ),
            469 => 
            array (
                'id' => 897,
                'country_id' => 3,
                'name' => 'Ouargla',
                'code' => 'OG',
                'adm1code' => 'AG50',
            ),
            470 => 
            array (
                'id' => 898,
                'country_id' => 3,
                'name' => 'Relizane',
                'code' => 'RE',
                'adm1code' => 'AG51',
            ),
            471 => 
            array (
                'id' => 899,
                'country_id' => 3,
                'name' => 'Souk Ahras',
                'code' => 'SA',
                'adm1code' => 'AG52',
            ),
            472 => 
            array (
                'id' => 900,
                'country_id' => 3,
                'name' => 'Tamanghasset',
                'code' => 'TM',
                'adm1code' => 'AG53',
            ),
            473 => 
            array (
                'id' => 901,
                'country_id' => 3,
                'name' => 'Tindouf',
                'code' => 'TN',
                'adm1code' => 'AG54',
            ),
            474 => 
            array (
                'id' => 902,
                'country_id' => 3,
                'name' => 'Tipaza',
                'code' => 'TP',
                'adm1code' => 'AG55',
            ),
            475 => 
            array (
                'id' => 903,
                'country_id' => 3,
                'name' => 'Tissemsilt',
                'code' => 'TS',
                'adm1code' => 'AG56',
            ),
            476 => 
            array (
                'id' => 904,
                'country_id' => 16,
                'name' => 'Abseron',
                'code' => 'AR',
                'adm1code' => 'AJ01',
            ),
            477 => 
            array (
                'id' => 905,
                'country_id' => 16,
                'name' => 'Agcabadi',
                'code' => 'AC',
                'adm1code' => 'AJ02',
            ),
            478 => 
            array (
                'id' => 906,
                'country_id' => 16,
                'name' => 'Agdam',
                'code' => 'AM',
                'adm1code' => 'AJ03',
            ),
            479 => 
            array (
                'id' => 907,
                'country_id' => 16,
                'name' => 'Agdas',
                'code' => 'AS',
                'adm1code' => 'AJ04',
            ),
            480 => 
            array (
                'id' => 908,
                'country_id' => 16,
                'name' => 'Agstafa',
                'code' => 'AF',
                'adm1code' => 'AJ05',
            ),
            481 => 
            array (
                'id' => 909,
                'country_id' => 16,
                'name' => 'Agsu',
                'code' => 'AU',
                'adm1code' => 'AJ06',
            ),
            482 => 
            array (
                'id' => 910,
                'country_id' => 16,
                'name' => 'Ali Bayramli',
                'code' => 'AB',
                'adm1code' => 'AJ07',
            ),
            483 => 
            array (
                'id' => 911,
                'country_id' => 16,
                'name' => 'Astara',
                'code' => 'AA',
                'adm1code' => 'AJ08',
            ),
            484 => 
            array (
                'id' => 912,
                'country_id' => 16,
                'name' => 'Baki',
                'code' => 'BA',
                'adm1code' => 'AJ09',
            ),
            485 => 
            array (
                'id' => 913,
                'country_id' => 16,
                'name' => 'Balakan',
                'code' => 'BL',
                'adm1code' => 'AJ10',
            ),
            486 => 
            array (
                'id' => 914,
                'country_id' => 16,
                'name' => 'Barda',
                'code' => 'BR',
                'adm1code' => 'AJ11',
            ),
            487 => 
            array (
                'id' => 915,
                'country_id' => 16,
                'name' => 'Beylaqan',
                'code' => 'BQ',
                'adm1code' => 'AJ12',
            ),
            488 => 
            array (
                'id' => 916,
                'country_id' => 16,
                'name' => 'Bilasuvar',
                'code' => 'BS',
                'adm1code' => 'AJ13',
            ),
            489 => 
            array (
                'id' => 917,
                'country_id' => 16,
                'name' => 'Cabrayil',
                'code' => 'CB',
                'adm1code' => 'AJ14',
            ),
            490 => 
            array (
                'id' => 918,
                'country_id' => 16,
                'name' => 'Calilabad',
                'code' => 'CL',
                'adm1code' => 'AJ15',
            ),
            491 => 
            array (
                'id' => 919,
                'country_id' => 16,
                'name' => 'Daskasan',
                'code' => 'DS',
                'adm1code' => 'AJ16',
            ),
            492 => 
            array (
                'id' => 920,
                'country_id' => 16,
                'name' => 'Davaci',
                'code' => 'DV',
                'adm1code' => 'AJ17',
            ),
            493 => 
            array (
                'id' => 921,
                'country_id' => 16,
                'name' => 'Fuzuli',
                'code' => 'FU',
                'adm1code' => 'AJ18',
            ),
            494 => 
            array (
                'id' => 922,
                'country_id' => 16,
                'name' => 'Gadabay',
                'code' => 'GD',
                'adm1code' => 'AJ19',
            ),
            495 => 
            array (
                'id' => 923,
                'country_id' => 16,
                'name' => 'Ganca',
                'code' => 'GA',
                'adm1code' => 'AJ20',
            ),
            496 => 
            array (
                'id' => 924,
                'country_id' => 16,
                'name' => 'Goranboy',
                'code' => 'GR',
                'adm1code' => 'AJ21',
            ),
            497 => 
            array (
                'id' => 925,
                'country_id' => 16,
                'name' => 'Goycay',
                'code' => 'GY',
                'adm1code' => 'AJ22',
            ),
            498 => 
            array (
                'id' => 926,
                'country_id' => 16,
                'name' => 'Haciqabul',
                'code' => 'HA',
                'adm1code' => 'AJ23',
            ),
            499 => 
            array (
                'id' => 927,
                'country_id' => 16,
                'name' => 'Imisli',
                'code' => 'IM',
                'adm1code' => 'AJ24',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 928,
                'country_id' => 16,
                'name' => 'Ismayilli',
                'code' => 'IS',
                'adm1code' => 'AJ25',
            ),
            1 => 
            array (
                'id' => 929,
                'country_id' => 16,
                'name' => 'Kalbacar',
                'code' => 'KA',
                'adm1code' => 'AJ26',
            ),
            2 => 
            array (
                'id' => 930,
                'country_id' => 16,
                'name' => 'Kurdamir',
                'code' => 'KU',
                'adm1code' => 'AJ27',
            ),
            3 => 
            array (
                'id' => 931,
                'country_id' => 16,
                'name' => 'Lacin',
                'code' => 'LC',
                'adm1code' => 'AJ28',
            ),
            4 => 
            array (
                'id' => 932,
                'country_id' => 16,
                'name' => 'Lankaran',
                'code' => 'LA',
                'adm1code' => 'AJ30',
            ),
            5 => 
            array (
                'id' => 934,
                'country_id' => 16,
                'name' => 'Lerik',
                'code' => 'LE',
                'adm1code' => 'AJ31',
            ),
            6 => 
            array (
                'id' => 935,
                'country_id' => 16,
                'name' => 'Masalli',
                'code' => 'MA',
                'adm1code' => 'AJ32',
            ),
            7 => 
            array (
                'id' => 936,
                'country_id' => 16,
                'name' => 'Mingacevir',
                'code' => 'MI',
                'adm1code' => 'AJ33',
            ),
            8 => 
            array (
                'id' => 937,
                'country_id' => 16,
                'name' => 'Naftalan',
                'code' => 'NA',
                'adm1code' => 'AJ34',
            ),
            9 => 
            array (
                'id' => 938,
                'country_id' => 16,
                'name' => 'Naxcivan',
                'code' => 'NX',
                'adm1code' => 'AJ35',
            ),
            10 => 
            array (
                'id' => 939,
                'country_id' => 16,
                'name' => 'Neftcala',
                'code' => 'NE',
                'adm1code' => 'AJ36',
            ),
            11 => 
            array (
                'id' => 940,
                'country_id' => 16,
                'name' => 'Oguz',
                'code' => 'OG',
                'adm1code' => 'AJ37',
            ),
            12 => 
            array (
                'id' => 941,
                'country_id' => 16,
                'name' => 'Qabala',
                'code' => 'QA',
                'adm1code' => 'AJ38',
            ),
            13 => 
            array (
                'id' => 942,
                'country_id' => 16,
                'name' => 'Qax',
                'code' => 'QX',
                'adm1code' => 'AJ39',
            ),
            14 => 
            array (
                'id' => 943,
                'country_id' => 16,
                'name' => 'Qazax',
                'code' => 'QZ',
                'adm1code' => 'AJ40',
            ),
            15 => 
            array (
                'id' => 944,
                'country_id' => 16,
                'name' => 'Qobustan',
                'code' => 'QO',
                'adm1code' => 'AJ41',
            ),
            16 => 
            array (
                'id' => 945,
                'country_id' => 16,
                'name' => 'Quba',
                'code' => 'QB',
                'adm1code' => 'AJ42',
            ),
            17 => 
            array (
                'id' => 946,
                'country_id' => 16,
                'name' => 'Qubadli',
                'code' => 'QD',
                'adm1code' => 'AJ43',
            ),
            18 => 
            array (
                'id' => 947,
                'country_id' => 16,
                'name' => 'Qusar',
                'code' => 'QR',
                'adm1code' => 'AJ44',
            ),
            19 => 
            array (
                'id' => 948,
                'country_id' => 16,
                'name' => 'Saatli',
                'code' => 'ST',
                'adm1code' => 'AJ45',
            ),
            20 => 
            array (
                'id' => 949,
                'country_id' => 16,
                'name' => 'Sabirabad',
                'code' => 'SB',
                'adm1code' => 'AJ46',
            ),
            21 => 
            array (
                'id' => 950,
                'country_id' => 16,
                'name' => 'Saki',
                'code' => 'SA',
                'adm1code' => 'AJ48',
            ),
            22 => 
            array (
                'id' => 952,
                'country_id' => 16,
                'name' => 'Salyan',
                'code' => 'SL',
                'adm1code' => 'AJ49',
            ),
            23 => 
            array (
                'id' => 953,
                'country_id' => 16,
                'name' => 'Samaxi',
                'code' => 'SI',
                'adm1code' => 'AJ50',
            ),
            24 => 
            array (
                'id' => 954,
                'country_id' => 16,
                'name' => 'Samkir',
                'code' => 'SM',
                'adm1code' => 'AJ51',
            ),
            25 => 
            array (
                'id' => 955,
                'country_id' => 16,
                'name' => 'Samux',
                'code' => 'SX',
                'adm1code' => 'AJ52',
            ),
            26 => 
            array (
                'id' => 956,
                'country_id' => 16,
                'name' => 'Siyazan',
                'code' => 'SY',
                'adm1code' => 'AJ53',
            ),
            27 => 
            array (
                'id' => 957,
                'country_id' => 16,
                'name' => 'Sumqayit',
                'code' => 'SQ',
                'adm1code' => 'AJ54',
            ),
            28 => 
            array (
                'id' => 958,
                'country_id' => 16,
                'name' => 'Susa',
                'code' => 'SS',
                'adm1code' => 'AJ56',
            ),
            29 => 
            array (
                'id' => 960,
                'country_id' => 16,
                'name' => 'Tartar',
                'code' => 'TA',
                'adm1code' => 'AJ57',
            ),
            30 => 
            array (
                'id' => 961,
                'country_id' => 16,
                'name' => 'Tovuz',
                'code' => 'TO',
                'adm1code' => 'AJ58',
            ),
            31 => 
            array (
                'id' => 962,
                'country_id' => 16,
                'name' => 'Ucar',
                'code' => 'UC',
                'adm1code' => 'AJ59',
            ),
            32 => 
            array (
                'id' => 963,
                'country_id' => 16,
                'name' => 'Xacmaz',
                'code' => 'XZ',
                'adm1code' => 'AJ60',
            ),
            33 => 
            array (
                'id' => 964,
                'country_id' => 16,
                'name' => 'Xankandi',
                'code' => 'XA',
                'adm1code' => 'AJ61',
            ),
            34 => 
            array (
                'id' => 965,
                'country_id' => 16,
                'name' => 'Xanlar',
                'code' => 'XR',
                'adm1code' => 'AJ62',
            ),
            35 => 
            array (
                'id' => 966,
                'country_id' => 16,
                'name' => 'Xizi',
                'code' => 'XI',
                'adm1code' => 'AJ63',
            ),
            36 => 
            array (
                'id' => 967,
                'country_id' => 16,
                'name' => 'Xocali',
                'code' => 'XC',
                'adm1code' => 'AJ64',
            ),
            37 => 
            array (
                'id' => 968,
                'country_id' => 16,
                'name' => 'Xocavand',
                'code' => 'XD',
                'adm1code' => 'AJ65',
            ),
            38 => 
            array (
                'id' => 969,
                'country_id' => 16,
                'name' => 'Yardimli',
                'code' => 'YR',
                'adm1code' => 'AJ66',
            ),
            39 => 
            array (
                'id' => 970,
                'country_id' => 16,
                'name' => 'Yevlax',
                'code' => 'YE',
                'adm1code' => 'AJ68',
            ),
            40 => 
            array (
                'id' => 972,
                'country_id' => 16,
                'name' => 'Zangilan',
                'code' => 'ZG',
                'adm1code' => 'AJ69',
            ),
            41 => 
            array (
                'id' => 973,
                'country_id' => 16,
                'name' => 'Zaqatala',
                'code' => 'ZQ',
                'adm1code' => 'AJ70',
            ),
            42 => 
            array (
                'id' => 974,
                'country_id' => 16,
                'name' => 'Zardab',
                'code' => 'ZR',
                'adm1code' => 'AJ71',
            ),
            43 => 
            array (
                'id' => 975,
                'country_id' => 2,
                'name' => 'Berat',
                'code' => 'BR',
                'adm1code' => 'AL01',
            ),
            44 => 
            array (
                'id' => 976,
                'country_id' => 2,
                'name' => 'Diber',
                'code' => 'DI',
                'adm1code' => 'AL02',
            ),
            45 => 
            array (
                'id' => 977,
                'country_id' => 2,
                'name' => 'Durres',
                'code' => 'DR',
                'adm1code' => 'AL03',
            ),
            46 => 
            array (
                'id' => 978,
                'country_id' => 2,
                'name' => 'Elbasan',
                'code' => 'EL',
                'adm1code' => 'AL04',
            ),
            47 => 
            array (
                'id' => 979,
                'country_id' => 2,
                'name' => 'Fier',
                'code' => 'FR',
                'adm1code' => 'AL05',
            ),
            48 => 
            array (
                'id' => 980,
                'country_id' => 2,
                'name' => 'Gjirokaster',
                'code' => 'GJ',
                'adm1code' => 'AL06',
            ),
            49 => 
            array (
                'id' => 981,
                'country_id' => 2,
                'name' => 'Gramsh',
                'code' => 'GR',
                'adm1code' => 'AL07',
            ),
            50 => 
            array (
                'id' => 982,
                'country_id' => 2,
                'name' => 'Kolonje',
                'code' => 'ER',
                'adm1code' => 'AL08',
            ),
            51 => 
            array (
                'id' => 983,
                'country_id' => 2,
                'name' => 'Korce',
                'code' => 'KO',
                'adm1code' => 'AL09',
            ),
            52 => 
            array (
                'id' => 984,
                'country_id' => 2,
                'name' => 'Kruje',
                'code' => 'KR',
                'adm1code' => 'AL10',
            ),
            53 => 
            array (
                'id' => 985,
                'country_id' => 2,
                'name' => 'Kukes',
                'code' => 'KU',
                'adm1code' => 'AL11',
            ),
            54 => 
            array (
                'id' => 986,
                'country_id' => 2,
                'name' => 'Lezhe',
                'code' => 'LE',
                'adm1code' => 'AL12',
            ),
            55 => 
            array (
                'id' => 987,
                'country_id' => 2,
                'name' => 'Librazhd',
                'code' => 'LB',
                'adm1code' => 'AL13',
            ),
            56 => 
            array (
                'id' => 988,
                'country_id' => 2,
                'name' => 'Lushnje',
                'code' => 'LU',
                'adm1code' => 'AL14',
            ),
            57 => 
            array (
                'id' => 989,
                'country_id' => 2,
                'name' => 'Mat',
                'code' => 'MT',
                'adm1code' => 'AL15',
            ),
            58 => 
            array (
                'id' => 990,
                'country_id' => 2,
                'name' => 'Mirdite',
                'code' => 'MR',
                'adm1code' => 'AL16',
            ),
            59 => 
            array (
                'id' => 991,
                'country_id' => 2,
                'name' => 'Permet',
                'code' => 'PR',
                'adm1code' => 'AL17',
            ),
            60 => 
            array (
                'id' => 992,
                'country_id' => 2,
                'name' => 'Pogradec',
                'code' => 'PG',
                'adm1code' => 'AL18',
            ),
            61 => 
            array (
                'id' => 993,
                'country_id' => 2,
                'name' => 'Puke',
                'code' => 'PU',
                'adm1code' => 'AL19',
            ),
            62 => 
            array (
                'id' => 994,
                'country_id' => 2,
                'name' => 'Sarande',
                'code' => 'SR',
                'adm1code' => 'AL20',
            ),
            63 => 
            array (
                'id' => 995,
                'country_id' => 2,
                'name' => 'Shkoder',
                'code' => 'SH',
                'adm1code' => 'AL21',
            ),
            64 => 
            array (
                'id' => 996,
                'country_id' => 2,
                'name' => 'Skrapar',
                'code' => 'SK',
                'adm1code' => 'AL22',
            ),
            65 => 
            array (
                'id' => 997,
                'country_id' => 2,
                'name' => 'Tepelene',
                'code' => 'TE',
                'adm1code' => 'AL23',
            ),
            66 => 
            array (
                'id' => 998,
                'country_id' => 2,
                'name' => 'Tropoje',
                'code' => 'TP',
                'adm1code' => 'AL26',
            ),
            67 => 
            array (
                'id' => 999,
                'country_id' => 2,
                'name' => 'Vlore',
                'code' => 'VL',
                'adm1code' => 'AL27',
            ),
            68 => 
            array (
                'id' => 1000,
                'country_id' => 2,
                'name' => 'Tiran',
                'code' => 'TI',
                'adm1code' => 'AL28',
            ),
            69 => 
            array (
                'id' => 1001,
                'country_id' => 2,
                'name' => 'Bulqize',
                'code' => 'BU',
                'adm1code' => 'AL29',
            ),
            70 => 
            array (
                'id' => 1002,
                'country_id' => 2,
                'name' => 'Delvine',
                'code' => 'DL',
                'adm1code' => 'AL30',
            ),
            71 => 
            array (
                'id' => 1003,
                'country_id' => 2,
                'name' => 'Devoll',
                'code' => 'DV',
                'adm1code' => 'AL31',
            ),
            72 => 
            array (
                'id' => 1004,
                'country_id' => 2,
                'name' => 'Has',
                'code' => 'HA',
                'adm1code' => 'AL32',
            ),
            73 => 
            array (
                'id' => 1005,
                'country_id' => 2,
                'name' => 'Kavaje',
                'code' => 'KA',
                'adm1code' => 'AL33',
            ),
            74 => 
            array (
                'id' => 1006,
                'country_id' => 2,
                'name' => 'Kucove',
                'code' => 'KC',
                'adm1code' => 'AL34',
            ),
            75 => 
            array (
                'id' => 1007,
                'country_id' => 2,
                'name' => 'Kurbin',
                'code' => 'KB',
                'adm1code' => 'AL35',
            ),
            76 => 
            array (
                'id' => 1008,
                'country_id' => 2,
                'name' => 'Malesi e Madhe',
                'code' => 'MM',
                'adm1code' => 'AL36',
            ),
            77 => 
            array (
                'id' => 1009,
                'country_id' => 2,
                'name' => 'Mallakaster',
                'code' => 'MK',
                'adm1code' => 'AL37',
            ),
            78 => 
            array (
                'id' => 1010,
                'country_id' => 2,
                'name' => 'Peqin',
                'code' => 'PQ',
                'adm1code' => 'AL38',
            ),
            79 => 
            array (
                'id' => 1011,
                'country_id' => 2,
                'name' => 'Tirane',
                'code' => 'TR',
                'adm1code' => 'AL39',
            ),
            80 => 
            array (
                'id' => 1012,
                'country_id' => 11,
                'name' => 'Aragatsotn',
                'code' => 'AG',
                'adm1code' => 'AM01',
            ),
            81 => 
            array (
                'id' => 1013,
                'country_id' => 11,
                'name' => 'Ararat',
                'code' => 'AR',
                'adm1code' => 'AM02',
            ),
            82 => 
            array (
                'id' => 1014,
                'country_id' => 11,
                'name' => 'Armavir',
                'code' => 'AV',
                'adm1code' => 'AM03',
            ),
            83 => 
            array (
                'id' => 1015,
                'country_id' => 11,
                'name' => 'Geghark\'unik\'',
                'code' => 'GR',
                'adm1code' => 'AM04',
            ),
            84 => 
            array (
                'id' => 1016,
                'country_id' => 11,
                'name' => 'Kotayk\'',
                'code' => 'KT',
                'adm1code' => 'AM05',
            ),
            85 => 
            array (
                'id' => 1017,
                'country_id' => 11,
                'name' => 'Lorri',
                'code' => 'LO',
                'adm1code' => 'AM06',
            ),
            86 => 
            array (
                'id' => 1018,
                'country_id' => 11,
                'name' => 'Shirak',
                'code' => 'SH',
                'adm1code' => 'AM07',
            ),
            87 => 
            array (
                'id' => 1019,
                'country_id' => 11,
                'name' => 'Syunik\'',
                'code' => 'SU',
                'adm1code' => 'AM08',
            ),
            88 => 
            array (
                'id' => 1020,
                'country_id' => 11,
                'name' => 'Tavush',
                'code' => 'TV',
                'adm1code' => 'AM09',
            ),
            89 => 
            array (
                'id' => 1021,
                'country_id' => 11,
                'name' => 'Vayots\' Dzor',
                'code' => 'VD',
                'adm1code' => 'AM10',
            ),
            90 => 
            array (
                'id' => 1022,
                'country_id' => 11,
                'name' => 'Yerevan',
                'code' => 'ER',
                'adm1code' => 'AM11',
            ),
            91 => 
            array (
                'id' => 1023,
                'country_id' => 5,
                'name' => 'Andorra la Vella',
                'code' => 'AN',
                'adm1code' => 'AN07',
            ),
            92 => 
            array (
                'id' => 1024,
                'country_id' => 5,
                'name' => 'Canillo',
                'code' => 'CA',
                'adm1code' => 'AN02',
            ),
            93 => 
            array (
                'id' => 1025,
                'country_id' => 5,
                'name' => 'Encamp',
                'code' => 'EN',
                'adm1code' => 'AN03',
            ),
            94 => 
            array (
                'id' => 1026,
                'country_id' => 5,
                'name' => 'La Massana',
                'code' => 'MA',
                'adm1code' => 'AN04',
            ),
            95 => 
            array (
                'id' => 1027,
                'country_id' => 5,
                'name' => 'Ordino',
                'code' => 'OR',
                'adm1code' => 'AN05',
            ),
            96 => 
            array (
                'id' => 1028,
                'country_id' => 5,
                'name' => 'Sant Julia de Loria',
                'code' => 'JL',
                'adm1code' => 'AN06',
            ),
            97 => 
            array (
                'id' => 1029,
                'country_id' => 6,
                'name' => 'Benguela',
                'code' => 'BG',
                'adm1code' => 'AO01',
            ),
            98 => 
            array (
                'id' => 1030,
                'country_id' => 6,
                'name' => 'Bie',
                'code' => 'BI',
                'adm1code' => 'AO02',
            ),
            99 => 
            array (
                'id' => 1031,
                'country_id' => 6,
                'name' => 'Cabinda',
                'code' => 'CB',
                'adm1code' => 'AO03',
            ),
            100 => 
            array (
                'id' => 1032,
                'country_id' => 6,
                'name' => 'Cuando Cubango',
                'code' => 'CC',
                'adm1code' => 'AO04',
            ),
            101 => 
            array (
                'id' => 1033,
                'country_id' => 6,
                'name' => 'Cuanza Norte',
                'code' => 'CN',
                'adm1code' => 'AO05',
            ),
            102 => 
            array (
                'id' => 1034,
                'country_id' => 6,
                'name' => 'Cuanza Sul',
                'code' => 'CS',
                'adm1code' => 'AO06',
            ),
            103 => 
            array (
                'id' => 1035,
                'country_id' => 6,
                'name' => 'Cunene',
                'code' => 'CU',
                'adm1code' => 'AO07',
            ),
            104 => 
            array (
                'id' => 1036,
                'country_id' => 6,
                'name' => 'Huambo',
                'code' => 'HM',
                'adm1code' => 'AO08',
            ),
            105 => 
            array (
                'id' => 1037,
                'country_id' => 6,
                'name' => 'Huila',
                'code' => 'HL',
                'adm1code' => 'AO09',
            ),
            106 => 
            array (
                'id' => 1038,
                'country_id' => 6,
                'name' => 'Luanda',
                'code' => 'LU',
                'adm1code' => 'AO10',
            ),
            107 => 
            array (
                'id' => 1039,
                'country_id' => 6,
                'name' => 'Malanje',
                'code' => 'ML',
                'adm1code' => 'AO12',
            ),
            108 => 
            array (
                'id' => 1040,
                'country_id' => 6,
                'name' => 'Namibe',
                'code' => 'NA',
                'adm1code' => 'AO13',
            ),
            109 => 
            array (
                'id' => 1041,
                'country_id' => 6,
                'name' => 'Moxico',
                'code' => 'MX',
                'adm1code' => 'AO14',
            ),
            110 => 
            array (
                'id' => 1046,
                'country_id' => 6,
                'name' => 'Uige',
                'code' => 'UI',
                'adm1code' => 'AO15',
            ),
            111 => 
            array (
                'id' => 1047,
                'country_id' => 6,
                'name' => 'Zaire',
                'code' => 'ZA',
                'adm1code' => 'AO16',
            ),
            112 => 
            array (
                'id' => 1048,
                'country_id' => 6,
                'name' => 'Lunda Norte',
                'code' => 'LN',
                'adm1code' => 'AO17',
            ),
            113 => 
            array (
                'id' => 1049,
                'country_id' => 6,
                'name' => 'Lunda Sul',
                'code' => 'LS',
                'adm1code' => 'AO18',
            ),
            114 => 
            array (
                'id' => 1050,
                'country_id' => 6,
                'name' => 'Bengo',
                'code' => 'BO',
                'adm1code' => 'AO19',
            ),
            115 => 
            array (
                'id' => 1051,
                'country_id' => 10,
                'name' => 'Buenos Aires',
                'code' => 'BA',
                'adm1code' => 'AR01',
            ),
            116 => 
            array (
                'id' => 1052,
                'country_id' => 10,
                'name' => 'Catamarca',
                'code' => 'CT',
                'adm1code' => 'AR02',
            ),
            117 => 
            array (
                'id' => 1053,
                'country_id' => 10,
                'name' => 'Chaco',
                'code' => 'CC',
                'adm1code' => 'AR03',
            ),
            118 => 
            array (
                'id' => 1054,
                'country_id' => 10,
                'name' => 'Chubut',
                'code' => 'CH',
                'adm1code' => 'AR04',
            ),
            119 => 
            array (
                'id' => 1055,
                'country_id' => 10,
                'name' => 'Cordoba',
                'code' => 'CB',
                'adm1code' => 'AR05',
            ),
            120 => 
            array (
                'id' => 1056,
                'country_id' => 10,
                'name' => 'Corrientes',
                'code' => 'CN',
                'adm1code' => 'AR06',
            ),
            121 => 
            array (
                'id' => 1057,
                'country_id' => 10,
                'name' => 'Distrito Federal',
                'code' => 'DF',
                'adm1code' => 'AR07',
            ),
            122 => 
            array (
                'id' => 1058,
                'country_id' => 10,
                'name' => 'Entre Rios',
                'code' => 'ER',
                'adm1code' => 'AR08',
            ),
            123 => 
            array (
                'id' => 1059,
                'country_id' => 10,
                'name' => 'Formosa',
                'code' => 'FM',
                'adm1code' => 'AR09',
            ),
            124 => 
            array (
                'id' => 1060,
                'country_id' => 10,
                'name' => 'Jujuy',
                'code' => 'JY',
                'adm1code' => 'AR10',
            ),
            125 => 
            array (
                'id' => 1061,
                'country_id' => 10,
                'name' => 'La Pampa',
                'code' => 'LP',
                'adm1code' => 'AR11',
            ),
            126 => 
            array (
                'id' => 1062,
                'country_id' => 10,
                'name' => 'La Rioja',
                'code' => 'LR',
                'adm1code' => 'AR12',
            ),
            127 => 
            array (
                'id' => 1063,
                'country_id' => 10,
                'name' => 'Mendoza',
                'code' => 'MZ',
                'adm1code' => 'AR13',
            ),
            128 => 
            array (
                'id' => 1064,
                'country_id' => 10,
                'name' => 'Misiones',
                'code' => 'MN',
                'adm1code' => 'AR14',
            ),
            129 => 
            array (
                'id' => 1065,
                'country_id' => 10,
                'name' => 'Neuquen',
                'code' => 'NQ',
                'adm1code' => 'AR15',
            ),
            130 => 
            array (
                'id' => 1066,
                'country_id' => 10,
                'name' => 'Rio Negro',
                'code' => 'RN',
                'adm1code' => 'AR16',
            ),
            131 => 
            array (
                'id' => 1067,
                'country_id' => 10,
                'name' => 'Salta',
                'code' => 'SA',
                'adm1code' => 'AR17',
            ),
            132 => 
            array (
                'id' => 1068,
                'country_id' => 10,
                'name' => 'San Juan',
                'code' => 'SJ',
                'adm1code' => 'AR18',
            ),
            133 => 
            array (
                'id' => 1069,
                'country_id' => 10,
                'name' => 'San Luis',
                'code' => 'SL',
                'adm1code' => 'AR19',
            ),
            134 => 
            array (
                'id' => 1070,
                'country_id' => 10,
                'name' => 'Santa Cruz',
                'code' => 'SC',
                'adm1code' => 'AR20',
            ),
            135 => 
            array (
                'id' => 1071,
                'country_id' => 10,
                'name' => 'Santa Fe',
                'code' => 'SF',
                'adm1code' => 'AR21',
            ),
            136 => 
            array (
                'id' => 1072,
                'country_id' => 10,
                'name' => 'Santiago del Estero',
                'code' => 'SE',
                'adm1code' => 'AR22',
            ),
            137 => 
            array (
                'id' => 1073,
                'country_id' => 10,
                'name' => 'Antartida e Islas del Atlan Tierra del Fuego',
                'code' => 'TF',
                'adm1code' => 'AR23',
            ),
            138 => 
            array (
                'id' => 1074,
                'country_id' => 10,
                'name' => 'Tucuman',
                'code' => 'TM',
                'adm1code' => 'AR24',
            ),
            139 => 
            array (
                'id' => 1075,
                'country_id' => 15,
                'name' => 'Burgenland',
                'code' => 'BU',
                'adm1code' => 'AU01',
            ),
            140 => 
            array (
                'id' => 1076,
                'country_id' => 15,
                'name' => 'Karnten',
                'code' => 'KA',
                'adm1code' => 'AU02',
            ),
            141 => 
            array (
                'id' => 1077,
                'country_id' => 15,
                'name' => 'Niederosterreich',
                'code' => 'NO',
                'adm1code' => 'AU03',
            ),
            142 => 
            array (
                'id' => 1078,
                'country_id' => 15,
                'name' => 'Oberosterreich',
                'code' => 'OO',
                'adm1code' => 'AU04',
            ),
            143 => 
            array (
                'id' => 1079,
                'country_id' => 15,
                'name' => 'Salzburg',
                'code' => 'SZ',
                'adm1code' => 'AU05',
            ),
            144 => 
            array (
                'id' => 1080,
                'country_id' => 15,
                'name' => 'Steiermark',
                'code' => 'ST',
                'adm1code' => 'AU06',
            ),
            145 => 
            array (
                'id' => 1081,
                'country_id' => 15,
                'name' => 'Tirol',
                'code' => 'TR',
                'adm1code' => 'AU07',
            ),
            146 => 
            array (
                'id' => 1082,
                'country_id' => 15,
                'name' => 'Vorarlberg',
                'code' => 'VO',
                'adm1code' => 'AU08',
            ),
            147 => 
            array (
                'id' => 1083,
                'country_id' => 15,
                'name' => 'Wien',
                'code' => 'WI',
                'adm1code' => 'AU09',
            ),
            148 => 
            array (
                'id' => 1084,
                'country_id' => 18,
                'name' => 'Al Hadd',
                'code' => 'HD',
                'adm1code' => 'BA01',
            ),
            149 => 
            array (
                'id' => 1085,
                'country_id' => 18,
                'name' => 'Al Manamah',
                'code' => 'MN',
                'adm1code' => 'BA02',
            ),
            150 => 
            array (
                'id' => 1086,
                'country_id' => 18,
                'name' => 'Al Muharraq',
                'code' => 'MQ',
                'adm1code' => 'BA03',
            ),
            151 => 
            array (
                'id' => 1087,
                'country_id' => 18,
                'name' => 'Jidd Hafs',
                'code' => 'JH',
                'adm1code' => 'BA05',
            ),
            152 => 
            array (
                'id' => 1088,
                'country_id' => 18,
                'name' => 'Sitrah',
                'code' => 'ST',
                'adm1code' => 'BA06',
            ),
            153 => 
            array (
                'id' => 1090,
                'country_id' => 18,
                'name' => 'Al Mintaqah al Gharbiyah',
                'code' => 'MG',
                'adm1code' => 'BA08',
            ),
            154 => 
            array (
                'id' => 1091,
                'country_id' => 18,
                'name' => 'Mintaqat Juzur Hawar',
                'code' => 'MJ',
                'adm1code' => 'BA09',
            ),
            155 => 
            array (
                'id' => 1092,
                'country_id' => 18,
                'name' => 'Al Mintaqah ash Shamaliyah',
                'code' => 'MS',
                'adm1code' => 'BA10',
            ),
            156 => 
            array (
                'id' => 1093,
                'country_id' => 18,
                'name' => 'Al Mintaqah al Wusta',
                'code' => 'MW',
                'adm1code' => 'BA11',
            ),
            157 => 
            array (
                'id' => 1094,
                'country_id' => 18,
                'name' => 'Madinat Isa',
                'code' => 'MI',
                'adm1code' => 'BA12',
            ),
            158 => 
            array (
                'id' => 1096,
                'country_id' => 18,
                'name' => 'Madinat Hamad',
                'code' => 'MH',
                'adm1code' => 'BA14',
            ),
            159 => 
            array (
                'id' => 1097,
                'country_id' => 21,
                'name' => 'Christ Church',
                'code' => 'CC',
                'adm1code' => 'BB01',
            ),
            160 => 
            array (
                'id' => 1098,
                'country_id' => 21,
                'name' => 'Saint Andrew',
                'code' => 'AN',
                'adm1code' => 'BB02',
            ),
            161 => 
            array (
                'id' => 1099,
                'country_id' => 21,
                'name' => 'Saint George',
                'code' => 'GE',
                'adm1code' => 'BB03',
            ),
            162 => 
            array (
                'id' => 1100,
                'country_id' => 21,
                'name' => 'Saint James',
                'code' => 'JM',
                'adm1code' => 'BB04',
            ),
            163 => 
            array (
                'id' => 1101,
                'country_id' => 21,
                'name' => 'Saint John',
                'code' => 'JN',
                'adm1code' => 'BB05',
            ),
            164 => 
            array (
                'id' => 1102,
                'country_id' => 21,
                'name' => 'Saint Joseph',
                'code' => 'JS',
                'adm1code' => 'BB06',
            ),
            165 => 
            array (
                'id' => 1103,
                'country_id' => 21,
                'name' => 'Saint Lucy',
                'code' => 'LU',
                'adm1code' => 'BB07',
            ),
            166 => 
            array (
                'id' => 1104,
                'country_id' => 21,
                'name' => 'Saint Michael',
                'code' => 'MI',
                'adm1code' => 'BB08',
            ),
            167 => 
            array (
                'id' => 1105,
                'country_id' => 21,
                'name' => 'Saint Peter',
                'code' => 'PE',
                'adm1code' => 'BB09',
            ),
            168 => 
            array (
                'id' => 1106,
                'country_id' => 21,
                'name' => 'Saint Philip',
                'code' => 'PH',
                'adm1code' => 'BB10',
            ),
            169 => 
            array (
                'id' => 1107,
                'country_id' => 21,
                'name' => 'Saint Thomas',
                'code' => 'TH',
                'adm1code' => 'BB11',
            ),
            170 => 
            array (
                'id' => 1108,
                'country_id' => 31,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'BC01',
            ),
            171 => 
            array (
                'id' => 1109,
                'country_id' => 31,
                'name' => 'Chobe',
                'code' => 'CH',
                'adm1code' => 'BC02',
            ),
            172 => 
            array (
                'id' => 1110,
                'country_id' => 31,
                'name' => 'Ghanzi',
                'code' => 'GH',
                'adm1code' => 'BC03',
            ),
            173 => 
            array (
                'id' => 1111,
                'country_id' => 31,
                'name' => 'Kgalagadi',
                'code' => 'KG',
                'adm1code' => 'BC04',
            ),
            174 => 
            array (
                'id' => 1112,
                'country_id' => 31,
                'name' => 'Kgatleng',
                'code' => 'KL',
                'adm1code' => 'BC05',
            ),
            175 => 
            array (
                'id' => 1113,
                'country_id' => 31,
                'name' => 'Kweneng',
                'code' => 'KW',
                'adm1code' => 'BC06',
            ),
            176 => 
            array (
                'id' => 1114,
                'country_id' => 31,
                'name' => 'Ngamiland',
                'code' => 'NG',
                'adm1code' => 'BC07',
            ),
            177 => 
            array (
                'id' => 1115,
                'country_id' => 31,
                'name' => 'NorthEast',
                'code' => 'NE',
                'adm1code' => 'BC08',
            ),
            178 => 
            array (
                'id' => 1116,
                'country_id' => 31,
                'name' => 'SouthEast',
                'code' => 'SE',
                'adm1code' => 'BC09',
            ),
            179 => 
            array (
                'id' => 1117,
                'country_id' => 31,
                'name' => 'Southern',
                'code' => 'SO',
                'adm1code' => 'BC10',
            ),
            180 => 
            array (
                'id' => 1118,
                'country_id' => 27,
                'name' => 'Devonshire',
                'code' => 'DE',
                'adm1code' => 'BD01',
            ),
            181 => 
            array (
                'id' => 1119,
                'country_id' => 27,
                'name' => 'Hamilton Municipality',
                'code' => 'HC',
                'adm1code' => 'BD03',
            ),
            182 => 
            array (
                'id' => 1121,
                'country_id' => 27,
                'name' => 'Paget',
                'code' => 'PA',
                'adm1code' => 'BD04',
            ),
            183 => 
            array (
                'id' => 1122,
                'country_id' => 27,
                'name' => 'Pembroke',
                'code' => 'PE',
                'adm1code' => 'BD05',
            ),
            184 => 
            array (
                'id' => 1123,
                'country_id' => 27,
                'name' => 'Saint George',
                'code' => 'SG',
                'adm1code' => 'BD06',
            ),
            185 => 
            array (
                'id' => 1124,
                'country_id' => 27,
                'name' => 'Saint George\'s',
                'code' => 'SC',
                'adm1code' => 'BD07',
            ),
            186 => 
            array (
                'id' => 1125,
                'country_id' => 27,
                'name' => 'Sandys',
                'code' => 'SA',
                'adm1code' => 'BD08',
            ),
            187 => 
            array (
                'id' => 1126,
                'country_id' => 27,
                'name' => 'Smiths',
                'code' => 'SM',
                'adm1code' => 'BD09',
            ),
            188 => 
            array (
                'id' => 1127,
                'country_id' => 27,
                'name' => 'Southampton',
                'code' => 'SO',
                'adm1code' => 'BD10',
            ),
            189 => 
            array (
                'id' => 1128,
                'country_id' => 27,
                'name' => 'Warwick',
                'code' => 'WA',
                'adm1code' => 'BD11',
            ),
            190 => 
            array (
                'id' => 1129,
                'country_id' => 24,
                'name' => 'Antwerpen',
                'code' => 'AN',
                'adm1code' => 'BE01',
            ),
            191 => 
            array (
                'id' => 1131,
                'country_id' => 24,
                'name' => 'Hainaut',
                'code' => 'HT',
                'adm1code' => 'BE03',
            ),
            192 => 
            array (
                'id' => 1132,
                'country_id' => 24,
                'name' => 'Liege',
                'code' => 'LG',
                'adm1code' => 'BE04',
            ),
            193 => 
            array (
                'id' => 1133,
                'country_id' => 24,
                'name' => 'Limburg',
                'code' => 'LI',
                'adm1code' => 'BE05',
            ),
            194 => 
            array (
                'id' => 1134,
                'country_id' => 24,
                'name' => 'Luxembourg',
                'code' => 'LX',
                'adm1code' => 'BE06',
            ),
            195 => 
            array (
                'id' => 1135,
                'country_id' => 24,
                'name' => 'Namur',
                'code' => 'NA',
                'adm1code' => 'BE07',
            ),
            196 => 
            array (
                'id' => 1136,
                'country_id' => 24,
                'name' => 'Oost-Vlaanderen',
                'code' => 'OV',
                'adm1code' => 'BE08',
            ),
            197 => 
            array (
                'id' => 1137,
                'country_id' => 24,
                'name' => 'West-Vlaanderen',
                'code' => 'WV',
                'adm1code' => 'BE09',
            ),
            198 => 
            array (
                'id' => 1138,
                'country_id' => 17,
                'name' => 'Bimini',
                'code' => 'BI',
                'adm1code' => 'BF05',
            ),
            199 => 
            array (
                'id' => 1139,
                'country_id' => 17,
                'name' => 'Cat Island',
                'code' => 'CI',
                'adm1code' => 'BF06',
            ),
            200 => 
            array (
                'id' => 1140,
                'country_id' => 17,
                'name' => 'Exuma',
                'code' => 'EX',
                'adm1code' => 'BF10',
            ),
            201 => 
            array (
                'id' => 1143,
                'country_id' => 17,
                'name' => 'Inagua',
                'code' => 'IN',
                'adm1code' => 'BF13',
            ),
            202 => 
            array (
                'id' => 1144,
                'country_id' => 17,
                'name' => 'Long Island',
                'code' => 'LI',
                'adm1code' => 'BF15',
            ),
            203 => 
            array (
                'id' => 1145,
                'country_id' => 17,
                'name' => 'Mayaguana',
                'code' => 'MG',
                'adm1code' => 'BF16',
            ),
            204 => 
            array (
                'id' => 1146,
                'country_id' => 17,
                'name' => 'Ragged Island',
                'code' => 'RI',
                'adm1code' => 'BF18',
            ),
            205 => 
            array (
                'id' => 1147,
                'country_id' => 17,
                'name' => 'Harbour Island',
                'code' => 'HI',
                'adm1code' => 'BF22',
            ),
            206 => 
            array (
                'id' => 1148,
                'country_id' => 17,
                'name' => 'New Providence',
                'code' => 'NP',
                'adm1code' => 'BF23',
            ),
            207 => 
            array (
                'id' => 1149,
                'country_id' => 17,
                'name' => 'Acklins and Crooked Islands',
                'code' => 'AC',
                'adm1code' => 'BF24',
            ),
            208 => 
            array (
                'id' => 1150,
                'country_id' => 17,
                'name' => 'Freeport',
                'code' => 'FP',
                'adm1code' => 'BF25',
            ),
            209 => 
            array (
                'id' => 1151,
                'country_id' => 17,
                'name' => 'Fresh Creek',
                'code' => 'FC',
                'adm1code' => 'BF26',
            ),
            210 => 
            array (
                'id' => 1152,
                'country_id' => 17,
                'name' => 'Governor\'s Harbour',
                'code' => 'GH',
                'adm1code' => 'BF27',
            ),
            211 => 
            array (
                'id' => 1153,
                'country_id' => 17,
                'name' => 'Green Turtle Cay',
                'code' => 'GT',
                'adm1code' => 'BF28',
            ),
            212 => 
            array (
                'id' => 1154,
                'country_id' => 17,
                'name' => 'High Rock',
                'code' => 'HR',
                'adm1code' => 'BF29',
            ),
            213 => 
            array (
                'id' => 1155,
                'country_id' => 17,
                'name' => 'Kemps Bay',
                'code' => 'KB',
                'adm1code' => 'BF30',
            ),
            214 => 
            array (
                'id' => 1156,
                'country_id' => 17,
                'name' => 'Marsh Harbour',
                'code' => 'MH',
                'adm1code' => 'BF31',
            ),
            215 => 
            array (
                'id' => 1157,
                'country_id' => 17,
                'name' => 'Nichollstown and Berry Islands',
                'code' => 'NB',
                'adm1code' => 'BF32',
            ),
            216 => 
            array (
                'id' => 1158,
                'country_id' => 17,
                'name' => 'Rock Sound',
                'code' => 'RS',
                'adm1code' => 'BF33',
            ),
            217 => 
            array (
                'id' => 1159,
                'country_id' => 17,
                'name' => 'Sandy Point',
                'code' => 'SP',
                'adm1code' => 'BF34',
            ),
            218 => 
            array (
                'id' => 1160,
                'country_id' => 17,
                'name' => 'San Salvador and Rum Cay',
                'code' => 'SR',
                'adm1code' => 'BF35',
            ),
            219 => 
            array (
                'id' => 1161,
                'country_id' => 20,
                'name' => 'Chittagong',
                'code' => 'CG',
                'adm1code' => 'BG80',
            ),
            220 => 
            array (
                'id' => 1162,
                'country_id' => 20,
                'name' => 'Dhaka',
                'code' => 'DA',
                'adm1code' => 'BG81',
            ),
            221 => 
            array (
                'id' => 1163,
                'country_id' => 20,
                'name' => 'Khulna',
                'code' => 'KH',
                'adm1code' => 'BG82',
            ),
            222 => 
            array (
                'id' => 1164,
                'country_id' => 20,
                'name' => 'Rajshahi',
                'code' => 'RJ',
                'adm1code' => 'BG83',
            ),
            223 => 
            array (
                'id' => 1165,
                'country_id' => 25,
                'name' => 'Belize',
                'code' => 'BZ',
                'adm1code' => 'BH01',
            ),
            224 => 
            array (
                'id' => 1166,
                'country_id' => 25,
                'name' => 'Cayo',
                'code' => 'CY',
                'adm1code' => 'BH02',
            ),
            225 => 
            array (
                'id' => 1167,
                'country_id' => 25,
                'name' => 'Corozal',
                'code' => 'CZ',
                'adm1code' => 'BH03',
            ),
            226 => 
            array (
                'id' => 1168,
                'country_id' => 25,
                'name' => 'Orange Walk',
                'code' => 'OW',
                'adm1code' => 'BH04',
            ),
            227 => 
            array (
                'id' => 1169,
                'country_id' => 25,
                'name' => 'Stann Creek',
                'code' => 'SC',
                'adm1code' => 'BH05',
            ),
            228 => 
            array (
                'id' => 1170,
                'country_id' => 25,
                'name' => 'Toledo',
                'code' => 'TO',
                'adm1code' => 'BH06',
            ),
            229 => 
            array (
                'id' => 1171,
                'country_id' => 29,
                'name' => 'Chuquisaca',
                'code' => 'CQ',
                'adm1code' => 'BL01',
            ),
            230 => 
            array (
                'id' => 1172,
                'country_id' => 29,
                'name' => 'Cochabamba',
                'code' => 'CB',
                'adm1code' => 'BL02',
            ),
            231 => 
            array (
                'id' => 1173,
                'country_id' => 29,
                'name' => 'El Beni',
                'code' => 'EB',
                'adm1code' => 'BL03',
            ),
            232 => 
            array (
                'id' => 1174,
                'country_id' => 29,
                'name' => 'La Paz',
                'code' => 'LP',
                'adm1code' => 'BL04',
            ),
            233 => 
            array (
                'id' => 1175,
                'country_id' => 29,
                'name' => 'Oruro',
                'code' => 'OR',
                'adm1code' => 'BL05',
            ),
            234 => 
            array (
                'id' => 1176,
                'country_id' => 29,
                'name' => 'Pando',
                'code' => 'PA',
                'adm1code' => 'BL06',
            ),
            235 => 
            array (
                'id' => 1177,
                'country_id' => 29,
                'name' => 'Potosi',
                'code' => 'PO',
                'adm1code' => 'BL07',
            ),
            236 => 
            array (
                'id' => 1178,
                'country_id' => 29,
                'name' => 'Santa Cruz',
                'code' => 'SC',
                'adm1code' => 'BL08',
            ),
            237 => 
            array (
                'id' => 1179,
                'country_id' => 29,
                'name' => 'Tarija',
                'code' => 'TR',
                'adm1code' => 'BL09',
            ),
            238 => 
            array (
                'id' => 1180,
                'country_id' => 39,
                'name' => 'Rakhine State',
                'code' => 'RA',
                'adm1code' => 'BM01',
            ),
            239 => 
            array (
                'id' => 1181,
                'country_id' => 39,
                'name' => 'Chin State',
                'code' => 'CH',
                'adm1code' => 'BM02',
            ),
            240 => 
            array (
                'id' => 1182,
                'country_id' => 39,
                'name' => 'Ayeyarwady',
                'code' => 'AY',
                'adm1code' => 'BM03',
            ),
            241 => 
            array (
                'id' => 1183,
                'country_id' => 39,
                'name' => 'Kachin State',
                'code' => 'KC',
                'adm1code' => 'BM04',
            ),
            242 => 
            array (
                'id' => 1184,
                'country_id' => 39,
                'name' => 'Kayin State',
                'code' => 'KN',
                'adm1code' => 'BM05',
            ),
            243 => 
            array (
                'id' => 1185,
                'country_id' => 39,
                'name' => 'Kayah State',
                'code' => 'KH',
                'adm1code' => 'BM06',
            ),
            244 => 
            array (
                'id' => 1187,
                'country_id' => 39,
                'name' => 'Mandalay',
                'code' => 'MD',
                'adm1code' => 'BM08',
            ),
            245 => 
            array (
                'id' => 1189,
                'country_id' => 39,
                'name' => 'Sagaing',
                'code' => 'SA',
                'adm1code' => 'BM10',
            ),
            246 => 
            array (
                'id' => 1190,
                'country_id' => 39,
                'name' => 'Shan State',
                'code' => 'SH',
                'adm1code' => 'BM11',
            ),
            247 => 
            array (
                'id' => 1191,
                'country_id' => 39,
                'name' => 'Tanintharyi',
                'code' => 'TN',
                'adm1code' => 'BM12',
            ),
            248 => 
            array (
                'id' => 1192,
                'country_id' => 39,
                'name' => 'Mon State',
                'code' => 'MO',
                'adm1code' => 'BM13',
            ),
            249 => 
            array (
                'id' => 1194,
                'country_id' => 39,
                'name' => 'Magway',
                'code' => 'MG',
                'adm1code' => 'BM15',
            ),
            250 => 
            array (
                'id' => 1195,
                'country_id' => 39,
                'name' => 'Bago',
                'code' => 'BA',
                'adm1code' => 'BM16',
            ),
            251 => 
            array (
                'id' => 1196,
                'country_id' => 39,
                'name' => 'Yangon',
                'code' => 'YA',
                'adm1code' => 'BM17',
            ),
            252 => 
            array (
                'id' => 1197,
                'country_id' => 26,
                'name' => 'Atakora',
                'code' => 'AK',
                'adm1code' => 'BN01',
            ),
            253 => 
            array (
                'id' => 1198,
                'country_id' => 26,
                'name' => 'Atlantique',
                'code' => 'AQ',
                'adm1code' => 'BN02',
            ),
            254 => 
            array (
                'id' => 1199,
                'country_id' => 26,
                'name' => 'Borgou',
                'code' => 'BO',
                'adm1code' => 'BN03',
            ),
            255 => 
            array (
                'id' => 1200,
                'country_id' => 26,
                'name' => 'Mono',
                'code' => 'MO',
                'adm1code' => 'BN04',
            ),
            256 => 
            array (
                'id' => 1201,
                'country_id' => 26,
                'name' => 'Oueme',
                'code' => 'OU',
                'adm1code' => 'BN05',
            ),
            257 => 
            array (
                'id' => 1202,
                'country_id' => 26,
                'name' => 'Zou',
                'code' => 'ZO',
                'adm1code' => 'BN06',
            ),
            258 => 
            array (
                'id' => 1203,
                'country_id' => 23,
                'name' => 'Brestskaya Voblasts\'',
                'code' => 'BR',
                'adm1code' => 'BO01',
            ),
            259 => 
            array (
                'id' => 1204,
                'country_id' => 23,
                'name' => 'Homyel\'skaya Voblasts\'',
                'code' => 'HO',
                'adm1code' => 'BO02',
            ),
            260 => 
            array (
                'id' => 1205,
                'country_id' => 23,
                'name' => 'Hrodzyenskaya Voblasts\'',
                'code' => 'HR',
                'adm1code' => 'BO03',
            ),
            261 => 
            array (
                'id' => 1206,
                'country_id' => 23,
                'name' => 'Minsk',
                'code' => 'HM',
                'adm1code' => 'BO04',
            ),
            262 => 
            array (
                'id' => 1207,
                'country_id' => 23,
                'name' => 'Minskaya Voblasts\'',
                'code' => 'MI',
                'adm1code' => 'BO05',
            ),
            263 => 
            array (
                'id' => 1208,
                'country_id' => 23,
                'name' => 'Mahilyowskaya Voblasts\'',
                'code' => 'MA',
                'adm1code' => 'BO06',
            ),
            264 => 
            array (
                'id' => 1209,
                'country_id' => 23,
                'name' => 'Vitsyebskaya Voblasts\'',
                'code' => 'VI',
                'adm1code' => 'BO07',
            ),
            265 => 
            array (
                'id' => 1210,
                'country_id' => 222,
                'name' => 'Malaita',
                'code' => 'ML',
                'adm1code' => 'BP03',
            ),
            266 => 
            array (
                'id' => 1211,
                'country_id' => 222,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'BP04',
            ),
            267 => 
            array (
                'id' => 1212,
                'country_id' => 222,
                'name' => 'Central',
                'code' => 'CN',
                'adm1code' => 'BP05',
            ),
            268 => 
            array (
                'id' => 1213,
                'country_id' => 222,
                'name' => 'Guadalcanal',
                'code' => 'GC',
                'adm1code' => 'BP06',
            ),
            269 => 
            array (
                'id' => 1214,
                'country_id' => 222,
                'name' => 'Isabel',
                'code' => 'IS',
                'adm1code' => 'BP07',
            ),
            270 => 
            array (
                'id' => 1215,
                'country_id' => 222,
                'name' => 'Makira',
                'code' => 'MK',
                'adm1code' => 'BP08',
            ),
            271 => 
            array (
                'id' => 1216,
                'country_id' => 222,
                'name' => 'Temotu',
                'code' => 'TE',
                'adm1code' => 'BP09',
            ),
            272 => 
            array (
                'id' => 1217,
                'country_id' => 33,
                'name' => 'Distrito Federal',
                'code' => 'DF',
                'adm1code' => 'BR07',
            ),
            273 => 
            array (
                'id' => 1219,
                'country_id' => 33,
                'name' => 'Paro',
                'code' => 'PA',
                'adm1code' => 'BR16',
            ),
            274 => 
            array (
                'id' => 1220,
                'country_id' => 33,
                'name' => 'Pernambuco',
                'code' => 'PE',
                'adm1code' => 'BR19',
            ),
            275 => 
            array (
                'id' => 1221,
                'country_id' => 28,
                'name' => 'Bumthang',
                'code' => 'BU',
                'adm1code' => 'BT05',
            ),
            276 => 
            array (
                'id' => 1222,
                'country_id' => 28,
                'name' => 'Chhukha',
                'code' => 'CK',
                'adm1code' => 'BT06',
            ),
            277 => 
            array (
                'id' => 1223,
                'country_id' => 28,
                'name' => 'Chirang',
                'code' => 'CR',
                'adm1code' => 'BT07',
            ),
            278 => 
            array (
                'id' => 1224,
                'country_id' => 28,
                'name' => 'Daga',
                'code' => 'DA',
                'adm1code' => 'BT08',
            ),
            279 => 
            array (
                'id' => 1225,
                'country_id' => 28,
                'name' => 'Geylegphug',
                'code' => 'GE',
                'adm1code' => 'BT09',
            ),
            280 => 
            array (
                'id' => 1226,
                'country_id' => 28,
                'name' => 'Ha',
                'code' => 'HA',
                'adm1code' => 'BT10',
            ),
            281 => 
            array (
                'id' => 1227,
                'country_id' => 28,
                'name' => 'Lhuntshi',
                'code' => 'LH',
                'adm1code' => 'BT11',
            ),
            282 => 
            array (
                'id' => 1228,
                'country_id' => 28,
                'name' => 'Mongar',
                'code' => 'MO',
                'adm1code' => 'BT12',
            ),
            283 => 
            array (
                'id' => 1229,
                'country_id' => 28,
                'name' => 'Paro',
                'code' => 'PR',
                'adm1code' => 'BT13',
            ),
            284 => 
            array (
                'id' => 1230,
                'country_id' => 28,
                'name' => 'Pemagatsel',
                'code' => 'PM',
                'adm1code' => 'BT14',
            ),
            285 => 
            array (
                'id' => 1231,
                'country_id' => 28,
                'name' => 'Punakha',
                'code' => 'PN',
                'adm1code' => 'BT15',
            ),
            286 => 
            array (
                'id' => 1232,
                'country_id' => 28,
                'name' => 'Samchi',
                'code' => 'SM',
                'adm1code' => 'BT16',
            ),
            287 => 
            array (
                'id' => 1233,
                'country_id' => 28,
                'name' => 'Samdrup',
                'code' => 'SJ',
                'adm1code' => 'BT17',
            ),
            288 => 
            array (
                'id' => 1234,
                'country_id' => 28,
                'name' => 'Shemgang',
                'code' => 'SG',
                'adm1code' => 'BT18',
            ),
            289 => 
            array (
                'id' => 1235,
                'country_id' => 28,
                'name' => 'Tashigang',
                'code' => 'TA',
                'adm1code' => 'BT19',
            ),
            290 => 
            array (
                'id' => 1236,
                'country_id' => 28,
                'name' => 'Thimphu',
                'code' => 'TM',
                'adm1code' => 'BT20',
            ),
            291 => 
            array (
                'id' => 1237,
                'country_id' => 28,
                'name' => 'Tongsa',
                'code' => 'TO',
                'adm1code' => 'BT21',
            ),
            292 => 
            array (
                'id' => 1238,
                'country_id' => 28,
                'name' => 'Wangdi Phodrang',
                'code' => 'WP',
                'adm1code' => 'BT22',
            ),
            293 => 
            array (
                'id' => 1239,
                'country_id' => 37,
                'name' => 'Burgas',
                'code' => 'BR',
                'adm1code' => 'BU39',
            ),
            294 => 
            array (
                'id' => 1240,
                'country_id' => 37,
                'name' => 'Sofiya-Grad',
                'code' => 'SG',
                'adm1code' => 'BU42',
            ),
            295 => 
            array (
                'id' => 1241,
                'country_id' => 37,
                'name' => 'Khaskovo',
                'code' => 'KK',
                'adm1code' => 'BU43',
            ),
            296 => 
            array (
                'id' => 1242,
                'country_id' => 37,
                'name' => 'Lovech',
                'code' => 'LV',
                'adm1code' => 'BU46',
            ),
            297 => 
            array (
                'id' => 1243,
                'country_id' => 37,
                'name' => 'Montana',
                'code' => 'MT',
                'adm1code' => 'BU47',
            ),
            298 => 
            array (
                'id' => 1244,
                'country_id' => 37,
                'name' => 'Plovdiv',
                'code' => 'PD',
                'adm1code' => 'BU51',
            ),
            299 => 
            array (
                'id' => 1245,
                'country_id' => 37,
                'name' => 'Razgrad',
                'code' => 'RG',
                'adm1code' => 'BU52',
            ),
            300 => 
            array (
                'id' => 1246,
                'country_id' => 37,
                'name' => 'Sofiya',
                'code' => 'SF',
                'adm1code' => 'BU58',
            ),
            301 => 
            array (
                'id' => 1247,
                'country_id' => 37,
                'name' => 'Varna',
                'code' => 'VN',
                'adm1code' => 'BU61',
            ),
            302 => 
            array (
                'id' => 1248,
                'country_id' => 36,
                'name' => 'Belait',
                'code' => 'BE',
                'adm1code' => 'BX01',
            ),
            303 => 
            array (
                'id' => 1249,
                'country_id' => 36,
                'name' => 'Brunei and Muara',
                'code' => 'BM',
                'adm1code' => 'BX02',
            ),
            304 => 
            array (
                'id' => 1250,
                'country_id' => 36,
                'name' => 'Temburong',
                'code' => 'TE',
                'adm1code' => 'BX03',
            ),
            305 => 
            array (
                'id' => 1251,
                'country_id' => 36,
                'name' => 'Tutong',
                'code' => 'TU',
                'adm1code' => 'BX04',
            ),
            306 => 
            array (
                'id' => 1252,
                'country_id' => 40,
                'name' => 'Bujumbura',
                'code' => 'BU',
                'adm1code' => 'BY02',
            ),
            307 => 
            array (
                'id' => 1253,
                'country_id' => 40,
                'name' => 'Muramvya',
                'code' => 'MV',
                'adm1code' => 'BY22',
            ),
            308 => 
            array (
                'id' => 1254,
                'country_id' => 40,
                'name' => 'Bubanza',
                'code' => 'BB',
                'adm1code' => 'BY09',
            ),
            309 => 
            array (
                'id' => 1255,
                'country_id' => 40,
                'name' => 'Bururi',
                'code' => 'BR',
                'adm1code' => 'BY10',
            ),
            310 => 
            array (
                'id' => 1256,
                'country_id' => 40,
                'name' => 'Cankuzo',
                'code' => 'CA',
                'adm1code' => 'BY11',
            ),
            311 => 
            array (
                'id' => 1257,
                'country_id' => 40,
                'name' => 'Cibitoke',
                'code' => 'CI',
                'adm1code' => 'BY12',
            ),
            312 => 
            array (
                'id' => 1258,
                'country_id' => 40,
                'name' => 'Gitega',
                'code' => 'GI',
                'adm1code' => 'BY13',
            ),
            313 => 
            array (
                'id' => 1259,
                'country_id' => 40,
                'name' => 'Karuzi',
                'code' => 'KR',
                'adm1code' => 'BY14',
            ),
            314 => 
            array (
                'id' => 1260,
                'country_id' => 40,
                'name' => 'Kayanza',
                'code' => 'KY',
                'adm1code' => 'BY15',
            ),
            315 => 
            array (
                'id' => 1261,
                'country_id' => 40,
                'name' => 'Kirundo',
                'code' => 'KI',
                'adm1code' => 'BY16',
            ),
            316 => 
            array (
                'id' => 1262,
                'country_id' => 40,
                'name' => 'Makamba',
                'code' => 'MA',
                'adm1code' => 'BY17',
            ),
            317 => 
            array (
                'id' => 1263,
                'country_id' => 40,
                'name' => 'Muyinga',
                'code' => 'MY',
                'adm1code' => 'BY18',
            ),
            318 => 
            array (
                'id' => 1264,
                'country_id' => 40,
                'name' => 'Ngozi',
                'code' => 'NG',
                'adm1code' => 'BY19',
            ),
            319 => 
            array (
                'id' => 1265,
                'country_id' => 40,
                'name' => 'Rutana',
                'code' => 'RT',
                'adm1code' => 'BY20',
            ),
            320 => 
            array (
                'id' => 1266,
                'country_id' => 40,
                'name' => 'Ruyigi',
                'code' => 'RY',
                'adm1code' => 'BY21',
            ),
            321 => 
            array (
                'id' => 1267,
                'country_id' => 41,
                'name' => 'Batdambang',
                'code' => 'BA',
                'adm1code' => 'CB29',
            ),
            322 => 
            array (
                'id' => 1268,
                'country_id' => 41,
                'name' => 'Kampong Cham',
                'code' => 'KM',
                'adm1code' => 'CB02',
            ),
            323 => 
            array (
                'id' => 1269,
                'country_id' => 41,
                'name' => 'Kampong Chhnang',
                'code' => 'KG',
                'adm1code' => 'CB03',
            ),
            324 => 
            array (
                'id' => 1270,
                'country_id' => 41,
                'name' => 'Kampong Spoe',
                'code' => 'KS',
                'adm1code' => 'CB04',
            ),
            325 => 
            array (
                'id' => 1271,
                'country_id' => 41,
                'name' => 'Kampong Thum',
                'code' => 'KT',
                'adm1code' => 'CB05',
            ),
            326 => 
            array (
                'id' => 1272,
                'country_id' => 41,
                'name' => 'Kampot',
                'code' => 'KP',
                'adm1code' => 'CB21',
            ),
            327 => 
            array (
                'id' => 1273,
                'country_id' => 41,
                'name' => 'Kandal',
                'code' => 'KN',
                'adm1code' => 'CB07',
            ),
            328 => 
            array (
                'id' => 1274,
                'country_id' => 41,
                'name' => 'Kaoh Kong',
                'code' => 'KK',
                'adm1code' => 'CB08',
            ),
            329 => 
            array (
                'id' => 1275,
                'country_id' => 41,
                'name' => 'Krachen',
                'code' => 'KR',
                'adm1code' => 'CB09',
            ),
            330 => 
            array (
                'id' => 1276,
                'country_id' => 41,
                'name' => 'Mondol Kiri',
                'code' => 'MK',
                'adm1code' => 'CB10',
            ),
            331 => 
            array (
                'id' => 1277,
                'country_id' => 41,
                'name' => 'Phnum Penh',
                'code' => 'PP',
                'adm1code' => 'CB22',
            ),
            332 => 
            array (
                'id' => 1278,
                'country_id' => 41,
                'name' => 'Pouthisat',
                'code' => 'PO',
                'adm1code' => 'CB12',
            ),
            333 => 
            array (
                'id' => 1279,
                'country_id' => 41,
                'name' => 'Preah Vihear',
                'code' => 'PH',
                'adm1code' => 'CB13',
            ),
            334 => 
            array (
                'id' => 1280,
                'country_id' => 41,
                'name' => 'Prey Veng',
                'code' => 'PY',
                'adm1code' => 'CB14',
            ),
            335 => 
            array (
                'id' => 1283,
                'country_id' => 41,
                'name' => 'Stoeng Treng',
                'code' => 'ST',
                'adm1code' => 'CB17',
            ),
            336 => 
            array (
                'id' => 1284,
                'country_id' => 41,
                'name' => 'Svay Rieng',
                'code' => 'SR',
                'adm1code' => 'CB18',
            ),
            337 => 
            array (
                'id' => 1285,
                'country_id' => 41,
                'name' => 'Takev',
                'code' => 'TA',
                'adm1code' => 'CB19',
            ),
            338 => 
            array (
                'id' => 1286,
                'country_id' => 41,
                'name' => 'Rotanah Kiri',
                'code' => 'RO',
                'adm1code' => 'CB23',
            ),
            339 => 
            array (
                'id' => 1287,
                'country_id' => 41,
                'name' => 'Siem Reab',
                'code' => 'SI',
                'adm1code' => 'CB24',
            ),
            340 => 
            array (
                'id' => 1288,
                'country_id' => 41,
                'name' => 'Banteay Mean Cheay',
                'code' => 'OM',
                'adm1code' => 'CB25',
            ),
            341 => 
            array (
                'id' => 1289,
                'country_id' => 41,
                'name' => 'Keb',
                'code' => 'KB',
                'adm1code' => 'CB26',
            ),
            342 => 
            array (
                'id' => 1290,
                'country_id' => 41,
                'name' => 'Otdar Mean Cheay',
                'code' => 'OC',
                'adm1code' => 'CB27',
            ),
            343 => 
            array (
                'id' => 1291,
                'country_id' => 41,
                'name' => 'Preah Seihanu',
                'code' => 'KA',
                'adm1code' => 'CB28',
            ),
            344 => 
            array (
                'id' => 1292,
                'country_id' => 47,
                'name' => 'Batha',
                'code' => 'BA',
                'adm1code' => 'CD01',
            ),
            345 => 
            array (
                'id' => 1293,
                'country_id' => 47,
                'name' => 'Biltine',
                'code' => 'BI',
                'adm1code' => 'CD02',
            ),
            346 => 
            array (
                'id' => 1294,
                'country_id' => 47,
                'name' => 'Borkou-Ennedi-Tibesti',
                'code' => 'BT',
                'adm1code' => 'CD03',
            ),
            347 => 
            array (
                'id' => 1295,
                'country_id' => 47,
                'name' => 'ChariBaguirmi',
                'code' => 'CB',
                'adm1code' => 'CD04',
            ),
            348 => 
            array (
                'id' => 1296,
                'country_id' => 47,
                'name' => 'Guera',
                'code' => 'GR',
                'adm1code' => 'CD05',
            ),
            349 => 
            array (
                'id' => 1297,
                'country_id' => 47,
                'name' => 'Kanem',
                'code' => 'KA',
                'adm1code' => 'CD06',
            ),
            350 => 
            array (
                'id' => 1298,
                'country_id' => 47,
                'name' => 'Lac',
                'code' => 'LC',
                'adm1code' => 'CD07',
            ),
            351 => 
            array (
                'id' => 1299,
                'country_id' => 47,
                'name' => 'Logone Occidental',
                'code' => 'LO',
                'adm1code' => 'CD08',
            ),
            352 => 
            array (
                'id' => 1300,
                'country_id' => 47,
                'name' => 'Logone Oriental',
                'code' => 'LR',
                'adm1code' => 'CD09',
            ),
            353 => 
            array (
                'id' => 1301,
                'country_id' => 47,
                'name' => 'Mayo-Kebbi',
                'code' => 'MK',
                'adm1code' => 'CD10',
            ),
            354 => 
            array (
                'id' => 1302,
                'country_id' => 47,
                'name' => 'Moyen-Chari',
                'code' => 'MC',
                'adm1code' => 'CD11',
            ),
            355 => 
            array (
                'id' => 1303,
                'country_id' => 47,
                'name' => 'Ouaddai',
                'code' => 'OD',
                'adm1code' => 'CD12',
            ),
            356 => 
            array (
                'id' => 1304,
                'country_id' => 47,
                'name' => 'Salamat',
                'code' => 'SA',
                'adm1code' => 'CD13',
            ),
            357 => 
            array (
                'id' => 1305,
                'country_id' => 47,
                'name' => 'Tandjile',
                'code' => 'TA',
                'adm1code' => 'CD14',
            ),
            358 => 
            array (
                'id' => 1306,
                'country_id' => 228,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'CE29',
            ),
            359 => 
            array (
                'id' => 1307,
                'country_id' => 228,
                'name' => 'North Central',
                'code' => 'NC',
                'adm1code' => 'CE30',
            ),
            360 => 
            array (
                'id' => 1308,
                'country_id' => 228,
                'name' => 'North Eastern',
                'code' => 'NE',
                'adm1code' => 'CE31',
            ),
            361 => 
            array (
                'id' => 1309,
                'country_id' => 228,
                'name' => 'North Western',
                'code' => 'NW',
                'adm1code' => 'CE32',
            ),
            362 => 
            array (
                'id' => 1310,
                'country_id' => 228,
                'name' => 'Sabaragamuwa',
                'code' => 'SA',
                'adm1code' => 'CE33',
            ),
            363 => 
            array (
                'id' => 1311,
                'country_id' => 228,
                'name' => 'Southern',
                'code' => 'SO',
                'adm1code' => 'CE34',
            ),
            364 => 
            array (
                'id' => 1312,
                'country_id' => 228,
                'name' => 'Uva',
                'code' => 'UV',
                'adm1code' => 'CE35',
            ),
            365 => 
            array (
                'id' => 1313,
                'country_id' => 228,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'CE36',
            ),
            366 => 
            array (
                'id' => 1314,
                'country_id' => 56,
                'name' => 'Bouenza',
                'code' => 'BO',
                'adm1code' => 'CF01',
            ),
            367 => 
            array (
                'id' => 1315,
                'country_id' => 56,
                'name' => 'Cuvette',
                'code' => 'CU',
                'adm1code' => 'CF03',
            ),
            368 => 
            array (
                'id' => 1316,
                'country_id' => 56,
                'name' => 'Kouilou',
                'code' => 'KO',
                'adm1code' => 'CF04',
            ),
            369 => 
            array (
                'id' => 1317,
                'country_id' => 56,
                'name' => 'Lekoumou',
                'code' => 'LE',
                'adm1code' => 'CF05',
            ),
            370 => 
            array (
                'id' => 1318,
                'country_id' => 56,
                'name' => 'Likouala',
                'code' => 'LI',
                'adm1code' => 'CF06',
            ),
            371 => 
            array (
                'id' => 1319,
                'country_id' => 56,
                'name' => 'Niari',
                'code' => 'NI',
                'adm1code' => 'CF07',
            ),
            372 => 
            array (
                'id' => 1320,
                'country_id' => 56,
                'name' => 'Plateaux',
                'code' => 'PL',
                'adm1code' => 'CF08',
            ),
            373 => 
            array (
                'id' => 1321,
                'country_id' => 56,
                'name' => 'Sangha',
                'code' => 'SA',
                'adm1code' => 'CF10',
            ),
            374 => 
            array (
                'id' => 1322,
                'country_id' => 56,
                'name' => 'Pool',
                'code' => 'PO',
                'adm1code' => 'CF11',
            ),
            375 => 
            array (
                'id' => 1323,
                'country_id' => 56,
                'name' => 'Brazzaville',
                'code' => 'BR',
                'adm1code' => 'CF12',
            ),
            376 => 
            array (
                'id' => 1324,
                'country_id' => 55,
                'name' => 'Bandundu',
                'code' => 'BN',
                'adm1code' => 'CG01',
            ),
            377 => 
            array (
                'id' => 1325,
                'country_id' => 55,
                'name' => 'Equateur',
                'code' => 'EQ',
                'adm1code' => 'CG02',
            ),
            378 => 
            array (
                'id' => 1326,
                'country_id' => 55,
                'name' => 'Kasai-Occidental',
                'code' => 'KC',
                'adm1code' => 'CG03',
            ),
            379 => 
            array (
                'id' => 1327,
                'country_id' => 55,
                'name' => 'Kasai-Oriental',
                'code' => 'KR',
                'adm1code' => 'CG04',
            ),
            380 => 
            array (
                'id' => 1328,
                'country_id' => 55,
                'name' => 'Katanga',
                'code' => 'KT',
                'adm1code' => 'CG05',
            ),
            381 => 
            array (
                'id' => 1329,
                'country_id' => 55,
                'name' => 'Kinshasa',
                'code' => 'KN',
                'adm1code' => 'CG06',
            ),
            382 => 
            array (
                'id' => 1331,
                'country_id' => 55,
                'name' => 'Bas-Congo',
                'code' => 'BC',
                'adm1code' => 'CG08',
            ),
            383 => 
            array (
                'id' => 1332,
                'country_id' => 55,
                'name' => 'Orientale',
                'code' => 'HC',
                'adm1code' => 'CG09',
            ),
            384 => 
            array (
                'id' => 1333,
                'country_id' => 49,
                'name' => 'Anhui',
                'code' => 'AH',
                'adm1code' => 'CH01',
            ),
            385 => 
            array (
                'id' => 1334,
                'country_id' => 49,
                'name' => 'Zhejiang',
                'code' => 'ZJ',
                'adm1code' => 'CH02',
            ),
            386 => 
            array (
                'id' => 1335,
                'country_id' => 49,
                'name' => 'Jiangxi',
                'code' => 'JX',
                'adm1code' => 'CH03',
            ),
            387 => 
            array (
                'id' => 1336,
                'country_id' => 49,
                'name' => 'Jiangsu',
                'code' => 'JS',
                'adm1code' => 'CH04',
            ),
            388 => 
            array (
                'id' => 1337,
                'country_id' => 49,
                'name' => 'Jilin',
                'code' => 'JL',
                'adm1code' => 'CH05',
            ),
            389 => 
            array (
                'id' => 1338,
                'country_id' => 49,
                'name' => 'Qinghai',
                'code' => 'QH',
                'adm1code' => 'CH06',
            ),
            390 => 
            array (
                'id' => 1339,
                'country_id' => 49,
                'name' => 'Fujian',
                'code' => 'FJ',
                'adm1code' => 'CH07',
            ),
            391 => 
            array (
                'id' => 1340,
                'country_id' => 49,
                'name' => 'Heilongjiang',
                'code' => 'HL',
                'adm1code' => 'CH08',
            ),
            392 => 
            array (
                'id' => 1341,
                'country_id' => 49,
                'name' => 'Henan',
                'code' => 'HE',
                'adm1code' => 'CH09',
            ),
            393 => 
            array (
                'id' => 1342,
                'country_id' => 49,
                'name' => 'Hebei',
                'code' => 'HB',
                'adm1code' => 'CH10',
            ),
            394 => 
            array (
                'id' => 1343,
                'country_id' => 49,
                'name' => 'Hunan',
                'code' => 'HN',
                'adm1code' => 'CH11',
            ),
            395 => 
            array (
                'id' => 1344,
                'country_id' => 49,
                'name' => 'Hubei',
                'code' => 'HU',
                'adm1code' => 'CH12',
            ),
            396 => 
            array (
                'id' => 1345,
                'country_id' => 49,
                'name' => 'Xinjiang',
                'code' => 'XJ',
                'adm1code' => 'CH13',
            ),
            397 => 
            array (
                'id' => 1346,
                'country_id' => 49,
                'name' => 'Xizang',
                'code' => 'XZ',
                'adm1code' => 'CH14',
            ),
            398 => 
            array (
                'id' => 1347,
                'country_id' => 49,
                'name' => 'Gansu',
                'code' => 'GS',
                'adm1code' => 'CH15',
            ),
            399 => 
            array (
                'id' => 1348,
                'country_id' => 49,
                'name' => 'Guangxi',
                'code' => 'GX',
                'adm1code' => 'CH16',
            ),
            400 => 
            array (
                'id' => 1349,
                'country_id' => 49,
                'name' => 'Guizhou',
                'code' => 'GZ',
                'adm1code' => 'CH18',
            ),
            401 => 
            array (
                'id' => 1350,
                'country_id' => 49,
                'name' => 'Liaoning',
                'code' => 'LN',
                'adm1code' => 'CH19',
            ),
            402 => 
            array (
                'id' => 1351,
                'country_id' => 49,
                'name' => 'Nei Mongol',
                'code' => 'NM',
                'adm1code' => 'CH20',
            ),
            403 => 
            array (
                'id' => 1352,
                'country_id' => 49,
                'name' => 'Ningxia',
                'code' => 'NX',
                'adm1code' => 'CH21',
            ),
            404 => 
            array (
                'id' => 1353,
                'country_id' => 49,
                'name' => 'Beijing',
                'code' => 'BJ',
                'adm1code' => 'CH22',
            ),
            405 => 
            array (
                'id' => 1354,
                'country_id' => 49,
                'name' => 'Shanghai',
                'code' => 'SH',
                'adm1code' => 'CH23',
            ),
            406 => 
            array (
                'id' => 1355,
                'country_id' => 49,
                'name' => 'Shanxi',
                'code' => 'SX',
                'adm1code' => 'CH24',
            ),
            407 => 
            array (
                'id' => 1356,
                'country_id' => 49,
                'name' => 'Shandong',
                'code' => 'SD',
                'adm1code' => 'CH25',
            ),
            408 => 
            array (
                'id' => 1357,
                'country_id' => 49,
                'name' => 'Shaanxi',
                'code' => 'SA',
                'adm1code' => 'CH26',
            ),
            409 => 
            array (
                'id' => 1358,
                'country_id' => 49,
                'name' => 'Sichuan',
                'code' => 'SC',
                'adm1code' => 'CH32',
            ),
            410 => 
            array (
                'id' => 1359,
                'country_id' => 49,
                'name' => 'Tianjin',
                'code' => 'TJ',
                'adm1code' => 'CH28',
            ),
            411 => 
            array (
                'id' => 1360,
                'country_id' => 49,
                'name' => 'Yunnan',
                'code' => 'YN',
                'adm1code' => 'CH29',
            ),
            412 => 
            array (
                'id' => 1361,
                'country_id' => 49,
                'name' => 'Guangdong',
                'code' => 'GD',
                'adm1code' => 'CH30',
            ),
            413 => 
            array (
                'id' => 1362,
                'country_id' => 49,
                'name' => 'Hainan',
                'code' => 'HA',
                'adm1code' => 'CH31',
            ),
            414 => 
            array (
                'id' => 1363,
                'country_id' => 49,
                'name' => 'Chongqing',
                'code' => 'CQ',
                'adm1code' => 'CH33',
            ),
            415 => 
            array (
                'id' => 1364,
                'country_id' => 48,
                'name' => 'Valparaiso',
                'code' => 'VS',
                'adm1code' => 'CI01',
            ),
            416 => 
            array (
                'id' => 1365,
                'country_id' => 48,
                'name' => 'Aisen del General Carlos Ibanez del Campo',
                'code' => 'AI',
                'adm1code' => 'CI02',
            ),
            417 => 
            array (
                'id' => 1366,
                'country_id' => 48,
                'name' => 'Antofagasta',
                'code' => 'AN',
                'adm1code' => 'CI03',
            ),
            418 => 
            array (
                'id' => 1367,
                'country_id' => 48,
                'name' => 'Araucania',
                'code' => 'AR',
                'adm1code' => 'CI04',
            ),
            419 => 
            array (
                'id' => 1368,
                'country_id' => 48,
                'name' => 'Atacama',
                'code' => 'AT',
                'adm1code' => 'CI05',
            ),
            420 => 
            array (
                'id' => 1369,
                'country_id' => 48,
                'name' => 'Bio-Bio',
                'code' => 'BI',
                'adm1code' => 'CI06',
            ),
            421 => 
            array (
                'id' => 1370,
                'country_id' => 48,
                'name' => 'Coquimbo',
                'code' => 'CO',
                'adm1code' => 'CI07',
            ),
            422 => 
            array (
                'id' => 1371,
                'country_id' => 48,
                'name' => 'Libertador General Bernardo O\'Higgins',
                'code' => 'LI',
                'adm1code' => 'CI08',
            ),
            423 => 
            array (
                'id' => 1372,
                'country_id' => 48,
                'name' => 'Los Lagos',
                'code' => 'LL',
                'adm1code' => 'CI09',
            ),
            424 => 
            array (
                'id' => 1373,
                'country_id' => 48,
                'name' => 'Magallanes y de la Antartica Chilena',
                'code' => 'MA',
                'adm1code' => 'CI10',
            ),
            425 => 
            array (
                'id' => 1374,
                'country_id' => 48,
                'name' => 'Maule',
                'code' => 'ML',
                'adm1code' => 'CI11',
            ),
            426 => 
            array (
                'id' => 1375,
                'country_id' => 48,
                'name' => 'Region Metropolitana',
                'code' => 'RM',
                'adm1code' => 'CI12',
            ),
            427 => 
            array (
                'id' => 1376,
                'country_id' => 48,
                'name' => 'Tarapaca',
                'code' => 'TA',
                'adm1code' => 'CI13',
            ),
            428 => 
            array (
                'id' => 1377,
                'country_id' => 45,
                'name' => 'Creek',
                'code' => 'CR',
                'adm1code' => 'CJ01',
            ),
            429 => 
            array (
                'id' => 1378,
                'country_id' => 45,
                'name' => 'Eastern',
                'code' => 'EA',
                'adm1code' => 'CJ02',
            ),
            430 => 
            array (
                'id' => 1379,
                'country_id' => 45,
                'name' => 'Midland',
                'code' => 'MI',
                'adm1code' => 'CJ03',
            ),
            431 => 
            array (
                'id' => 1380,
                'country_id' => 45,
                'name' => 'South Town',
                'code' => 'SO',
                'adm1code' => 'CJ04',
            ),
            432 => 
            array (
                'id' => 1381,
                'country_id' => 45,
                'name' => 'Spot Bay',
                'code' => 'SP',
                'adm1code' => 'CJ05',
            ),
            433 => 
            array (
                'id' => 1382,
                'country_id' => 45,
                'name' => 'Stake Bay',
                'code' => 'ST',
                'adm1code' => 'CJ06',
            ),
            434 => 
            array (
                'id' => 1383,
                'country_id' => 45,
                'name' => 'West End',
                'code' => 'WD',
                'adm1code' => 'CJ07',
            ),
            435 => 
            array (
                'id' => 1384,
                'country_id' => 45,
                'name' => 'Western',
                'code' => 'WN',
                'adm1code' => 'CJ08',
            ),
            436 => 
            array (
                'id' => 1385,
                'country_id' => 42,
                'name' => 'Est',
                'code' => 'ES',
                'adm1code' => 'CM04',
            ),
            437 => 
            array (
                'id' => 1386,
                'country_id' => 42,
                'name' => 'Littoral',
                'code' => 'LT',
                'adm1code' => 'CM05',
            ),
            438 => 
            array (
                'id' => 1387,
                'country_id' => 42,
                'name' => 'NordOuest',
                'code' => 'NW',
                'adm1code' => 'CM07',
            ),
            439 => 
            array (
                'id' => 1388,
                'country_id' => 42,
                'name' => 'Ouest',
                'code' => 'OU',
                'adm1code' => 'CM08',
            ),
            440 => 
            array (
                'id' => 1389,
                'country_id' => 42,
                'name' => 'SudOuest',
                'code' => 'SW',
                'adm1code' => 'CM09',
            ),
            441 => 
            array (
                'id' => 1390,
                'country_id' => 42,
                'name' => 'Adamaoua',
                'code' => 'AD',
                'adm1code' => 'CM10',
            ),
            442 => 
            array (
                'id' => 1391,
                'country_id' => 42,
                'name' => 'Centre',
                'code' => 'CE',
                'adm1code' => 'CM11',
            ),
            443 => 
            array (
                'id' => 1392,
                'country_id' => 42,
                'name' => 'ExtremeNord',
                'code' => 'EN',
                'adm1code' => 'CM12',
            ),
            444 => 
            array (
                'id' => 1393,
                'country_id' => 42,
                'name' => 'Nord',
                'code' => 'NO',
                'adm1code' => 'CM13',
            ),
            445 => 
            array (
                'id' => 1394,
                'country_id' => 42,
                'name' => 'Sud',
                'code' => 'SU',
                'adm1code' => 'CM14',
            ),
            446 => 
            array (
                'id' => 1395,
                'country_id' => 54,
                'name' => 'Anjouan',
                'code' => 'AN',
                'adm1code' => 'CN01',
            ),
            447 => 
            array (
                'id' => 1396,
                'country_id' => 54,
                'name' => 'Grande Comore',
                'code' => 'GC',
                'adm1code' => 'CN02',
            ),
            448 => 
            array (
                'id' => 1397,
                'country_id' => 54,
                'name' => 'Moheli',
                'code' => 'MO',
                'adm1code' => 'CN03',
            ),
            449 => 
            array (
                'id' => 1398,
                'country_id' => 53,
                'name' => 'Amazonas',
                'code' => 'AM',
                'adm1code' => 'CO01',
            ),
            450 => 
            array (
                'id' => 1399,
                'country_id' => 53,
                'name' => 'Antioquia',
                'code' => 'AN',
                'adm1code' => 'CO02',
            ),
            451 => 
            array (
                'id' => 1400,
                'country_id' => 53,
                'name' => 'Arauca',
                'code' => 'AR',
                'adm1code' => 'CO03',
            ),
            452 => 
            array (
                'id' => 1401,
                'country_id' => 53,
                'name' => 'Atlantico',
                'code' => 'AT',
                'adm1code' => 'CO04',
            ),
            453 => 
            array (
                'id' => 1402,
                'country_id' => 53,
                'name' => 'Caqueta',
                'code' => 'CQ',
                'adm1code' => 'CO08',
            ),
            454 => 
            array (
                'id' => 1403,
                'country_id' => 53,
                'name' => 'Cauca',
                'code' => 'CA',
                'adm1code' => 'CO09',
            ),
            455 => 
            array (
                'id' => 1404,
                'country_id' => 53,
                'name' => 'Cesar',
                'code' => 'CE',
                'adm1code' => 'CO10',
            ),
            456 => 
            array (
                'id' => 1405,
                'country_id' => 53,
                'name' => 'Choco',
                'code' => 'CH',
                'adm1code' => 'CO11',
            ),
            457 => 
            array (
                'id' => 1406,
                'country_id' => 53,
                'name' => 'Cordoba',
                'code' => 'CR',
                'adm1code' => 'CO12',
            ),
            458 => 
            array (
                'id' => 1408,
                'country_id' => 53,
                'name' => 'Guaviare',
                'code' => 'GV',
                'adm1code' => 'CO14',
            ),
            459 => 
            array (
                'id' => 1409,
                'country_id' => 53,
                'name' => 'Guainia',
                'code' => 'GN',
                'adm1code' => 'CO15',
            ),
            460 => 
            array (
                'id' => 1410,
                'country_id' => 53,
                'name' => 'Huila',
                'code' => 'HU',
                'adm1code' => 'CO16',
            ),
            461 => 
            array (
                'id' => 1411,
                'country_id' => 53,
                'name' => 'La Guajira',
                'code' => 'LG',
                'adm1code' => 'CO17',
            ),
            462 => 
            array (
                'id' => 1412,
                'country_id' => 53,
                'name' => 'Meta',
                'code' => 'ME',
                'adm1code' => 'CO19',
            ),
            463 => 
            array (
                'id' => 1413,
                'country_id' => 53,
                'name' => 'Narino',
                'code' => 'NA',
                'adm1code' => 'CO20',
            ),
            464 => 
            array (
                'id' => 1414,
                'country_id' => 53,
                'name' => 'Norte de Santander',
                'code' => 'NS',
                'adm1code' => 'CO21',
            ),
            465 => 
            array (
                'id' => 1415,
                'country_id' => 53,
                'name' => 'Putumayo',
                'code' => 'PU',
                'adm1code' => 'CO22',
            ),
            466 => 
            array (
                'id' => 1416,
                'country_id' => 53,
                'name' => 'Quindio',
                'code' => 'QD',
                'adm1code' => 'CO23',
            ),
            467 => 
            array (
                'id' => 1417,
                'country_id' => 53,
                'name' => 'Risaralda',
                'code' => 'RI',
                'adm1code' => 'CO24',
            ),
            468 => 
            array (
                'id' => 1418,
                'country_id' => 53,
                'name' => 'San Andres y Providencia',
                'code' => 'SA',
                'adm1code' => 'CO25',
            ),
            469 => 
            array (
                'id' => 1419,
                'country_id' => 53,
                'name' => 'Santander',
                'code' => 'ST',
                'adm1code' => 'CO26',
            ),
            470 => 
            array (
                'id' => 1420,
                'country_id' => 53,
                'name' => 'Sucre',
                'code' => 'SU',
                'adm1code' => 'CO27',
            ),
            471 => 
            array (
                'id' => 1421,
                'country_id' => 53,
                'name' => 'Tolima',
                'code' => 'TO',
                'adm1code' => 'CO28',
            ),
            472 => 
            array (
                'id' => 1422,
                'country_id' => 53,
                'name' => 'Valle del Cauca',
                'code' => 'VC',
                'adm1code' => 'CO29',
            ),
            473 => 
            array (
                'id' => 1423,
                'country_id' => 53,
                'name' => 'Vaupes',
                'code' => 'VP',
                'adm1code' => 'CO30',
            ),
            474 => 
            array (
                'id' => 1424,
                'country_id' => 53,
                'name' => 'Vichada',
                'code' => 'VD',
                'adm1code' => 'CO31',
            ),
            475 => 
            array (
                'id' => 1425,
                'country_id' => 53,
                'name' => 'Casanare',
                'code' => 'CS',
                'adm1code' => 'CO32',
            ),
            476 => 
            array (
                'id' => 1426,
                'country_id' => 53,
                'name' => 'Cundinamarca',
                'code' => 'CU',
                'adm1code' => 'CO33',
            ),
            477 => 
            array (
                'id' => 1427,
                'country_id' => 53,
                'name' => 'Distrito Capital',
                'code' => 'DC',
                'adm1code' => 'CO34',
            ),
            478 => 
            array (
                'id' => 1428,
                'country_id' => 53,
                'name' => 'Bolivar',
                'code' => 'BL',
                'adm1code' => 'CO35',
            ),
            479 => 
            array (
                'id' => 1429,
                'country_id' => 53,
                'name' => 'Boyaca',
                'code' => 'BY',
                'adm1code' => 'CO36',
            ),
            480 => 
            array (
                'id' => 1430,
                'country_id' => 53,
                'name' => 'Caldas',
                'code' => 'CL',
                'adm1code' => 'CO37',
            ),
            481 => 
            array (
                'id' => 1431,
                'country_id' => 53,
                'name' => 'Magdalena',
                'code' => 'MA',
                'adm1code' => 'CO38',
            ),
            482 => 
            array (
                'id' => 1432,
                'country_id' => 59,
                'name' => 'Alajuela',
                'code' => 'AL',
                'adm1code' => 'CS01',
            ),
            483 => 
            array (
                'id' => 1433,
                'country_id' => 59,
                'name' => 'Cartago',
                'code' => 'CA',
                'adm1code' => 'CS02',
            ),
            484 => 
            array (
                'id' => 1434,
                'country_id' => 59,
                'name' => 'Guanacaste',
                'code' => 'GU',
                'adm1code' => 'CS03',
            ),
            485 => 
            array (
                'id' => 1435,
                'country_id' => 59,
                'name' => 'Heredia',
                'code' => 'HE',
                'adm1code' => 'CS04',
            ),
            486 => 
            array (
                'id' => 1436,
                'country_id' => 59,
                'name' => 'Limon',
                'code' => 'LI',
                'adm1code' => 'CS06',
            ),
            487 => 
            array (
                'id' => 1437,
                'country_id' => 59,
                'name' => 'Puntarenas',
                'code' => 'PU',
                'adm1code' => 'CS07',
            ),
            488 => 
            array (
                'id' => 1438,
                'country_id' => 59,
                'name' => 'San Jose',
                'code' => 'SJ',
                'adm1code' => 'CS08',
            ),
            489 => 
            array (
                'id' => 1439,
                'country_id' => 46,
                'name' => 'Bamingui-Bangoran',
                'code' => 'BB',
                'adm1code' => 'CT01',
            ),
            490 => 
            array (
                'id' => 1440,
                'country_id' => 46,
                'name' => 'Basse-Kotto',
                'code' => 'BK',
                'adm1code' => 'CT02',
            ),
            491 => 
            array (
                'id' => 1441,
                'country_id' => 46,
                'name' => 'Haute-Kotto',
                'code' => 'HK',
                'adm1code' => 'CT03',
            ),
            492 => 
            array (
                'id' => 1442,
                'country_id' => 46,
                'name' => 'Haute-Sangha',
                'code' => 'HS',
                'adm1code' => 'CT04',
            ),
            493 => 
            array (
                'id' => 1443,
                'country_id' => 46,
                'name' => 'Haut-Mbomou',
                'code' => 'HM',
                'adm1code' => 'CT05',
            ),
            494 => 
            array (
                'id' => 1444,
                'country_id' => 46,
                'name' => 'Kemo-Gribingui',
                'code' => 'KG',
                'adm1code' => 'CT06',
            ),
            495 => 
            array (
                'id' => 1445,
                'country_id' => 46,
                'name' => 'Lobaye',
                'code' => 'LB',
                'adm1code' => 'CT07',
            ),
            496 => 
            array (
                'id' => 1446,
                'country_id' => 46,
                'name' => 'Mbomou',
                'code' => 'MB',
                'adm1code' => 'CT08',
            ),
            497 => 
            array (
                'id' => 1447,
                'country_id' => 46,
                'name' => 'Nana-Mambere',
                'code' => 'NM',
                'adm1code' => 'CT09',
            ),
            498 => 
            array (
                'id' => 1448,
                'country_id' => 46,
                'name' => 'Ouaka',
                'code' => 'UK',
                'adm1code' => 'CT11',
            ),
            499 => 
            array (
                'id' => 1449,
                'country_id' => 46,
                'name' => 'Ouham',
                'code' => 'AC',
                'adm1code' => 'CT12',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 1450,
                'country_id' => 46,
                'name' => 'Ouham-Pende',
                'code' => 'OP',
                'adm1code' => 'CT13',
            ),
            1 => 
            array (
                'id' => 1451,
                'country_id' => 46,
                'name' => 'Vakaga',
                'code' => 'VK',
                'adm1code' => 'CT14',
            ),
            2 => 
            array (
                'id' => 1452,
                'country_id' => 46,
                'name' => 'Gribingui',
                'code' => 'KB',
                'adm1code' => 'CT15',
            ),
            3 => 
            array (
                'id' => 1453,
                'country_id' => 46,
                'name' => 'Sangha',
                'code' => 'SE',
                'adm1code' => 'CT16',
            ),
            4 => 
            array (
                'id' => 1454,
                'country_id' => 46,
                'name' => 'Ombella-Mpoko',
                'code' => 'MP',
                'adm1code' => 'CT17',
            ),
            5 => 
            array (
                'id' => 1455,
                'country_id' => 46,
                'name' => 'Bangui',
                'code' => 'BG',
                'adm1code' => 'CT18',
            ),
            6 => 
            array (
                'id' => 1456,
                'country_id' => 62,
                'name' => 'Pinar del Rio',
                'code' => 'PR',
                'adm1code' => 'CU01',
            ),
            7 => 
            array (
                'id' => 1457,
                'country_id' => 62,
                'name' => 'Ciudad de La Habana',
                'code' => 'CH',
                'adm1code' => 'CU02',
            ),
            8 => 
            array (
                'id' => 1458,
                'country_id' => 62,
                'name' => 'Matanzas',
                'code' => 'MA',
                'adm1code' => 'CU03',
            ),
            9 => 
            array (
                'id' => 1459,
                'country_id' => 62,
                'name' => 'Isla de la Juventud',
                'code' => 'IJ',
                'adm1code' => 'CU04',
            ),
            10 => 
            array (
                'id' => 1460,
                'country_id' => 62,
                'name' => 'Camaguey',
                'code' => 'CM',
                'adm1code' => 'CU05',
            ),
            11 => 
            array (
                'id' => 1461,
                'country_id' => 62,
                'name' => 'Ciego de Avila',
                'code' => 'CA',
                'adm1code' => 'CU07',
            ),
            12 => 
            array (
                'id' => 1462,
                'country_id' => 62,
                'name' => 'Cienfuegos',
                'code' => 'CF',
                'adm1code' => 'CU08',
            ),
            13 => 
            array (
                'id' => 1463,
                'country_id' => 62,
                'name' => 'Granma',
                'code' => 'GR',
                'adm1code' => 'CU09',
            ),
            14 => 
            array (
                'id' => 1464,
                'country_id' => 62,
                'name' => 'Guantanamo',
                'code' => 'GU',
                'adm1code' => 'CU10',
            ),
            15 => 
            array (
                'id' => 1465,
                'country_id' => 62,
                'name' => 'La Habana',
                'code' => 'LH',
                'adm1code' => 'CU11',
            ),
            16 => 
            array (
                'id' => 1466,
                'country_id' => 62,
                'name' => 'Holguin',
                'code' => 'HO',
                'adm1code' => 'CU12',
            ),
            17 => 
            array (
                'id' => 1467,
                'country_id' => 62,
                'name' => 'Las Tunas',
                'code' => 'LT',
                'adm1code' => 'CU13',
            ),
            18 => 
            array (
                'id' => 1468,
                'country_id' => 62,
                'name' => 'Sancti Spiritus',
                'code' => 'SS',
                'adm1code' => 'CU14',
            ),
            19 => 
            array (
                'id' => 1469,
                'country_id' => 62,
                'name' => 'Santiago de Cuba',
                'code' => 'SC',
                'adm1code' => 'CU15',
            ),
            20 => 
            array (
                'id' => 1470,
                'country_id' => 62,
                'name' => 'Villa Clara',
                'code' => 'VC',
                'adm1code' => 'CU16',
            ),
            21 => 
            array (
                'id' => 1471,
                'country_id' => 44,
                'name' => 'Boa Vista',
                'code' => 'BV',
                'adm1code' => 'CV01',
            ),
            22 => 
            array (
                'id' => 1472,
                'country_id' => 44,
                'name' => 'Brava',
                'code' => 'BR',
                'adm1code' => 'CV02',
            ),
            23 => 
            array (
                'id' => 1473,
                'country_id' => 44,
                'name' => 'Calheta de SÃ£o Miguel',
                'code' => 'SM',
                'adm1code' => 'CV03',
            ),
            24 => 
            array (
                'id' => 1474,
                'country_id' => 44,
                'name' => 'Maio',
                'code' => 'MA',
                'adm1code' => 'CV04',
            ),
            25 => 
            array (
                'id' => 1475,
                'country_id' => 44,
                'name' => 'Paul',
                'code' => 'PA',
                'adm1code' => 'CV05',
            ),
            26 => 
            array (
                'id' => 1476,
                'country_id' => 44,
                'name' => 'Praia',
                'code' => 'PI',
                'adm1code' => 'CV06',
            ),
            27 => 
            array (
                'id' => 1477,
                'country_id' => 44,
                'name' => 'Ribeira Grande',
                'code' => 'RG',
                'adm1code' => 'CV07',
            ),
            28 => 
            array (
                'id' => 1478,
                'country_id' => 44,
                'name' => 'Sal',
                'code' => 'SL',
                'adm1code' => 'CV08',
            ),
            29 => 
            array (
                'id' => 1479,
                'country_id' => 44,
                'name' => 'Santa Catarina',
                'code' => 'SC',
                'adm1code' => 'CV09',
            ),
            30 => 
            array (
                'id' => 1480,
                'country_id' => 44,
                'name' => 'Sao Nicolau',
                'code' => 'SN',
                'adm1code' => 'CV10',
            ),
            31 => 
            array (
                'id' => 1481,
                'country_id' => 44,
                'name' => 'Sao Vicente',
                'code' => 'SV',
                'adm1code' => 'CV11',
            ),
            32 => 
            array (
                'id' => 1482,
                'country_id' => 44,
                'name' => 'Tarrafal',
                'code' => 'TF',
                'adm1code' => 'CV12',
            ),
            33 => 
            array (
                'id' => 1483,
                'country_id' => 63,
                'name' => 'Famagusta',
                'code' => 'FA',
                'adm1code' => 'CY01',
            ),
            34 => 
            array (
                'id' => 1484,
                'country_id' => 63,
                'name' => 'Kyrenia',
                'code' => 'KY',
                'adm1code' => 'CY02',
            ),
            35 => 
            array (
                'id' => 1485,
                'country_id' => 63,
                'name' => 'Larnaca',
                'code' => 'LA',
                'adm1code' => 'CY03',
            ),
            36 => 
            array (
                'id' => 1486,
                'country_id' => 63,
                'name' => 'Nicosia',
                'code' => 'NI',
                'adm1code' => 'CY04',
            ),
            37 => 
            array (
                'id' => 1487,
                'country_id' => 63,
                'name' => 'Limassol',
                'code' => 'LI',
                'adm1code' => 'CY05',
            ),
            38 => 
            array (
                'id' => 1488,
                'country_id' => 63,
                'name' => 'Paphos',
                'code' => 'PA',
                'adm1code' => 'CY06',
            ),
            39 => 
            array (
                'id' => 1489,
                'country_id' => 65,
                'name' => 'Arhus',
                'code' => 'AR',
                'adm1code' => 'DA01',
            ),
            40 => 
            array (
                'id' => 1490,
                'country_id' => 65,
                'name' => 'Bornholm',
                'code' => 'BO',
                'adm1code' => 'DA02',
            ),
            41 => 
            array (
                'id' => 1491,
                'country_id' => 65,
                'name' => 'Frederiksborg',
                'code' => 'FR',
                'adm1code' => 'DA03',
            ),
            42 => 
            array (
                'id' => 1492,
                'country_id' => 65,
                'name' => 'Fyn',
                'code' => 'FY',
                'adm1code' => 'DA04',
            ),
            43 => 
            array (
                'id' => 1493,
                'country_id' => 65,
                'name' => 'Kobenhavn',
                'code' => 'SK',
                'adm1code' => 'DA06',
            ),
            44 => 
            array (
                'id' => 1494,
                'country_id' => 65,
                'name' => 'Nordjylland',
                'code' => 'NJ',
                'adm1code' => 'DA07',
            ),
            45 => 
            array (
                'id' => 1495,
                'country_id' => 65,
                'name' => 'Ribe',
                'code' => 'RB',
                'adm1code' => 'DA08',
            ),
            46 => 
            array (
                'id' => 1496,
                'country_id' => 65,
                'name' => 'Ringkobing',
                'code' => 'RK',
                'adm1code' => 'DA09',
            ),
            47 => 
            array (
                'id' => 1497,
                'country_id' => 65,
                'name' => 'Roskilde',
                'code' => 'RS',
                'adm1code' => 'DA10',
            ),
            48 => 
            array (
                'id' => 1498,
                'country_id' => 65,
                'name' => 'Sonderjylland',
                'code' => 'SJ',
                'adm1code' => 'DA11',
            ),
            49 => 
            array (
                'id' => 1499,
                'country_id' => 65,
                'name' => 'Storstrom',
                'code' => 'ST',
                'adm1code' => 'DA12',
            ),
            50 => 
            array (
                'id' => 1500,
                'country_id' => 65,
                'name' => 'Vejle',
                'code' => 'VJ',
                'adm1code' => 'DA13',
            ),
            51 => 
            array (
                'id' => 1501,
                'country_id' => 65,
                'name' => 'Vestsjalland',
                'code' => 'VS',
                'adm1code' => 'DA14',
            ),
            52 => 
            array (
                'id' => 1502,
                'country_id' => 65,
                'name' => 'Viborg',
                'code' => 'VB',
                'adm1code' => 'DA15',
            ),
            53 => 
            array (
                'id' => 1503,
                'country_id' => 65,
                'name' => 'Fredericksberg',
                'code' => 'SF',
                'adm1code' => 'DA16',
            ),
            54 => 
            array (
                'id' => 1504,
                'country_id' => 66,
                'name' => '\'Ali Sabih',
                'code' => 'AS',
                'adm1code' => 'DJ01',
            ),
            55 => 
            array (
                'id' => 1505,
                'country_id' => 66,
                'name' => 'Dikhil',
                'code' => 'DI',
                'adm1code' => 'DJ02',
            ),
            56 => 
            array (
                'id' => 1506,
                'country_id' => 66,
                'name' => 'Djibouti',
                'code' => 'DJ',
                'adm1code' => 'DJ03',
            ),
            57 => 
            array (
                'id' => 1507,
                'country_id' => 66,
                'name' => 'Obock',
                'code' => 'OB',
                'adm1code' => 'DJ04',
            ),
            58 => 
            array (
                'id' => 1508,
                'country_id' => 66,
                'name' => 'Tadjoura',
                'code' => 'TA',
                'adm1code' => 'DJ05',
            ),
            59 => 
            array (
                'id' => 1509,
                'country_id' => 67,
                'name' => 'Saint Andrew',
                'code' => 'AN',
                'adm1code' => 'DO02',
            ),
            60 => 
            array (
                'id' => 1510,
                'country_id' => 67,
                'name' => 'Saint David',
                'code' => 'DA',
                'adm1code' => 'DO03',
            ),
            61 => 
            array (
                'id' => 1511,
                'country_id' => 67,
                'name' => 'Saint George',
                'code' => 'GO',
                'adm1code' => 'DO04',
            ),
            62 => 
            array (
                'id' => 1512,
                'country_id' => 67,
                'name' => 'Saint John',
                'code' => 'JN',
                'adm1code' => 'DO05',
            ),
            63 => 
            array (
                'id' => 1513,
                'country_id' => 67,
                'name' => 'Saint Joseph',
                'code' => 'JH',
                'adm1code' => 'DO06',
            ),
            64 => 
            array (
                'id' => 1514,
                'country_id' => 67,
                'name' => 'Saint Luke',
                'code' => 'LU',
                'adm1code' => 'DO07',
            ),
            65 => 
            array (
                'id' => 1515,
                'country_id' => 67,
                'name' => 'Saint Mark',
                'code' => 'MA',
                'adm1code' => 'DO08',
            ),
            66 => 
            array (
                'id' => 1516,
                'country_id' => 67,
                'name' => 'Saint Patrick',
                'code' => 'PK',
                'adm1code' => 'DO09',
            ),
            67 => 
            array (
                'id' => 1517,
                'country_id' => 67,
                'name' => 'Saint Paul',
                'code' => 'PL',
                'adm1code' => 'DO10',
            ),
            68 => 
            array (
                'id' => 1518,
                'country_id' => 67,
                'name' => 'Saint Peter',
                'code' => 'PR',
                'adm1code' => 'DO11',
            ),
            69 => 
            array (
                'id' => 1519,
                'country_id' => 68,
                'name' => 'Azua',
                'code' => 'AZ',
                'adm1code' => 'DR01',
            ),
            70 => 
            array (
                'id' => 1520,
                'country_id' => 68,
                'name' => 'Baoruco',
                'code' => 'BR',
                'adm1code' => 'DR02',
            ),
            71 => 
            array (
                'id' => 1521,
                'country_id' => 68,
                'name' => 'Barahona',
                'code' => 'BH',
                'adm1code' => 'DR03',
            ),
            72 => 
            array (
                'id' => 1522,
                'country_id' => 68,
                'name' => 'Dajabon',
                'code' => 'DA',
                'adm1code' => 'DR04',
            ),
            73 => 
            array (
                'id' => 1523,
                'country_id' => 68,
                'name' => 'Distrito Nacional',
                'code' => 'DN',
                'adm1code' => 'DR05',
            ),
            74 => 
            array (
                'id' => 1524,
                'country_id' => 68,
                'name' => 'Duarte',
                'code' => 'DU',
                'adm1code' => 'DR06',
            ),
            75 => 
            array (
                'id' => 1525,
                'country_id' => 68,
                'name' => 'Espaillat',
                'code' => 'ES',
                'adm1code' => 'DR08',
            ),
            76 => 
            array (
                'id' => 1526,
                'country_id' => 68,
                'name' => 'Independencia',
                'code' => 'IN',
                'adm1code' => 'DR09',
            ),
            77 => 
            array (
                'id' => 1527,
                'country_id' => 68,
                'name' => 'La Altagracia',
                'code' => 'AL',
                'adm1code' => 'DR10',
            ),
            78 => 
            array (
                'id' => 1528,
                'country_id' => 68,
                'name' => 'Elias Pina',
                'code' => 'EP',
                'adm1code' => 'DR11',
            ),
            79 => 
            array (
                'id' => 1529,
                'country_id' => 68,
                'name' => 'La Romana',
                'code' => 'RO',
                'adm1code' => 'DR12',
            ),
            80 => 
            array (
                'id' => 1530,
                'country_id' => 68,
                'name' => 'Maria Trinidad Sanchez',
                'code' => 'MT',
                'adm1code' => 'DR14',
            ),
            81 => 
            array (
                'id' => 1531,
                'country_id' => 68,
                'name' => 'Monte Cristi',
                'code' => 'MC',
                'adm1code' => 'DR15',
            ),
            82 => 
            array (
                'id' => 1532,
                'country_id' => 68,
                'name' => 'Pedernales',
                'code' => 'PN',
                'adm1code' => 'DR16',
            ),
            83 => 
            array (
                'id' => 1533,
                'country_id' => 68,
                'name' => 'Peravia',
                'code' => 'PR',
                'adm1code' => 'DR17',
            ),
            84 => 
            array (
                'id' => 1534,
                'country_id' => 68,
                'name' => 'Puerto Plata',
                'code' => 'PP',
                'adm1code' => 'DR18',
            ),
            85 => 
            array (
                'id' => 1535,
                'country_id' => 68,
                'name' => 'Salcedo',
                'code' => 'SC',
                'adm1code' => 'DR19',
            ),
            86 => 
            array (
                'id' => 1536,
                'country_id' => 68,
                'name' => 'Samana',
                'code' => 'SM',
                'adm1code' => 'DR20',
            ),
            87 => 
            array (
                'id' => 1537,
                'country_id' => 68,
                'name' => 'Sanchez Ramirez',
                'code' => 'SZ',
                'adm1code' => 'DR21',
            ),
            88 => 
            array (
                'id' => 1538,
                'country_id' => 68,
                'name' => 'San Juan',
                'code' => 'JU',
                'adm1code' => 'DR23',
            ),
            89 => 
            array (
                'id' => 1539,
                'country_id' => 68,
                'name' => 'San Pedro de Macoris',
                'code' => 'PM',
                'adm1code' => 'DR24',
            ),
            90 => 
            array (
                'id' => 1540,
                'country_id' => 68,
                'name' => 'Santiago',
                'code' => 'ST',
                'adm1code' => 'DR25',
            ),
            91 => 
            array (
                'id' => 1541,
                'country_id' => 68,
                'name' => 'Santiago Rodriguez',
                'code' => 'SR',
                'adm1code' => 'DR26',
            ),
            92 => 
            array (
                'id' => 1542,
                'country_id' => 68,
                'name' => 'Valverde',
                'code' => 'VA',
                'adm1code' => 'DR27',
            ),
            93 => 
            array (
                'id' => 1543,
                'country_id' => 68,
                'name' => 'El Seibo',
                'code' => 'SE',
                'adm1code' => 'DR28',
            ),
            94 => 
            array (
                'id' => 1544,
                'country_id' => 68,
                'name' => 'Hato Mayor',
                'code' => 'HM',
                'adm1code' => 'DR29',
            ),
            95 => 
            array (
                'id' => 1545,
                'country_id' => 68,
                'name' => 'La Vega',
                'code' => 'VE',
                'adm1code' => 'DR30',
            ),
            96 => 
            array (
                'id' => 1546,
                'country_id' => 68,
                'name' => 'Monsenor Nouel',
                'code' => 'MN',
                'adm1code' => 'DR31',
            ),
            97 => 
            array (
                'id' => 1547,
                'country_id' => 68,
                'name' => 'Monte Plata',
                'code' => 'MP',
                'adm1code' => 'DR32',
            ),
            98 => 
            array (
                'id' => 1548,
                'country_id' => 68,
                'name' => 'San Cristobal',
                'code' => 'CR',
                'adm1code' => 'DR33',
            ),
            99 => 
            array (
                'id' => 1549,
                'country_id' => 70,
                'name' => 'Galapagos',
                'code' => 'GA',
                'adm1code' => 'EC01',
            ),
            100 => 
            array (
                'id' => 1550,
                'country_id' => 70,
                'name' => 'Azuay',
                'code' => 'AZ',
                'adm1code' => 'EC02',
            ),
            101 => 
            array (
                'id' => 1551,
                'country_id' => 70,
                'name' => 'Bolivar',
                'code' => 'BO',
                'adm1code' => 'EC03',
            ),
            102 => 
            array (
                'id' => 1552,
                'country_id' => 70,
                'name' => 'Canar',
                'code' => 'CN',
                'adm1code' => 'EC04',
            ),
            103 => 
            array (
                'id' => 1553,
                'country_id' => 70,
                'name' => 'Carchi',
                'code' => 'CR',
                'adm1code' => 'EC05',
            ),
            104 => 
            array (
                'id' => 1554,
                'country_id' => 70,
                'name' => 'Chimborazo',
                'code' => 'CB',
                'adm1code' => 'EC06',
            ),
            105 => 
            array (
                'id' => 1555,
                'country_id' => 70,
                'name' => 'Cotopaxi',
                'code' => 'CT',
                'adm1code' => 'EC07',
            ),
            106 => 
            array (
                'id' => 1556,
                'country_id' => 70,
                'name' => 'El Oro',
                'code' => 'EO',
                'adm1code' => 'EC08',
            ),
            107 => 
            array (
                'id' => 1557,
                'country_id' => 70,
                'name' => 'Esmeraldas',
                'code' => 'ES',
                'adm1code' => 'EC09',
            ),
            108 => 
            array (
                'id' => 1558,
                'country_id' => 70,
                'name' => 'Guayas',
                'code' => 'GU',
                'adm1code' => 'EC10',
            ),
            109 => 
            array (
                'id' => 1559,
                'country_id' => 70,
                'name' => 'Imbabura',
                'code' => 'IM',
                'adm1code' => 'EC11',
            ),
            110 => 
            array (
                'id' => 1560,
                'country_id' => 70,
                'name' => 'Loja',
                'code' => 'LJ',
                'adm1code' => 'EC12',
            ),
            111 => 
            array (
                'id' => 1561,
                'country_id' => 70,
                'name' => 'Los Rios',
                'code' => 'LR',
                'adm1code' => 'EC13',
            ),
            112 => 
            array (
                'id' => 1562,
                'country_id' => 70,
                'name' => 'Manabi',
                'code' => 'MN',
                'adm1code' => 'EC14',
            ),
            113 => 
            array (
                'id' => 1563,
                'country_id' => 70,
                'name' => 'Morona-Santiago',
                'code' => 'MS',
                'adm1code' => 'EC15',
            ),
            114 => 
            array (
                'id' => 1564,
                'country_id' => 70,
                'name' => 'Pastaza',
                'code' => 'PA',
                'adm1code' => 'EC17',
            ),
            115 => 
            array (
                'id' => 1565,
                'country_id' => 70,
                'name' => 'Pichincha',
                'code' => 'PI',
                'adm1code' => 'EC18',
            ),
            116 => 
            array (
                'id' => 1566,
                'country_id' => 70,
                'name' => 'Tungurahua',
                'code' => 'TU',
                'adm1code' => 'EC19',
            ),
            117 => 
            array (
                'id' => 1567,
                'country_id' => 70,
                'name' => 'Zamora-Chinchipe',
                'code' => 'ZC',
                'adm1code' => 'EC20',
            ),
            118 => 
            array (
                'id' => 1568,
                'country_id' => 70,
                'name' => 'Napo',
                'code' => 'NA',
                'adm1code' => 'EC23',
            ),
            119 => 
            array (
                'id' => 1569,
                'country_id' => 70,
                'name' => 'Sucumbios',
                'code' => 'SU',
                'adm1code' => 'EC22',
            ),
            120 => 
            array (
                'id' => 1570,
                'country_id' => 71,
                'name' => 'Ad Daqahliyah',
                'code' => 'DQ',
                'adm1code' => 'EG01',
            ),
            121 => 
            array (
                'id' => 1571,
                'country_id' => 71,
                'name' => 'Al Bahr al Ahmar',
                'code' => 'BA',
                'adm1code' => 'EG02',
            ),
            122 => 
            array (
                'id' => 1572,
                'country_id' => 71,
                'name' => 'Al Buhayrah',
                'code' => 'BH',
                'adm1code' => 'EG03',
            ),
            123 => 
            array (
                'id' => 1573,
                'country_id' => 71,
                'name' => 'Al Fayyum',
                'code' => 'FY',
                'adm1code' => 'EG04',
            ),
            124 => 
            array (
                'id' => 1574,
                'country_id' => 71,
                'name' => 'Al Gharbiyah',
                'code' => 'GH',
                'adm1code' => 'EG05',
            ),
            125 => 
            array (
                'id' => 1575,
                'country_id' => 71,
                'name' => 'Al Iskandariyah',
                'code' => 'IK',
                'adm1code' => 'EG06',
            ),
            126 => 
            array (
                'id' => 1576,
                'country_id' => 71,
                'name' => 'Al Isma\'iliyah',
                'code' => 'IS',
                'adm1code' => 'EG07',
            ),
            127 => 
            array (
                'id' => 1577,
                'country_id' => 71,
                'name' => 'Al Jizah',
                'code' => 'JZ',
                'adm1code' => 'EG08',
            ),
            128 => 
            array (
                'id' => 1578,
                'country_id' => 71,
                'name' => 'Al Minufiyah',
                'code' => 'MF',
                'adm1code' => 'EG09',
            ),
            129 => 
            array (
                'id' => 1579,
                'country_id' => 71,
                'name' => 'Al Minya',
                'code' => 'MN',
                'adm1code' => 'EG10',
            ),
            130 => 
            array (
                'id' => 1580,
                'country_id' => 71,
                'name' => 'Al Qahirah',
                'code' => 'QH',
                'adm1code' => 'EG11',
            ),
            131 => 
            array (
                'id' => 1581,
                'country_id' => 71,
                'name' => 'Al QalyÂ¯biyah',
                'code' => 'QL',
                'adm1code' => 'EG12',
            ),
            132 => 
            array (
                'id' => 1582,
                'country_id' => 71,
                'name' => 'Al Wadi al Jadid',
                'code' => 'WJ',
                'adm1code' => 'EG13',
            ),
            133 => 
            array (
                'id' => 1583,
                'country_id' => 71,
                'name' => 'Ash Sharqiyah',
                'code' => 'SQ',
                'adm1code' => 'EG14',
            ),
            134 => 
            array (
                'id' => 1584,
                'country_id' => 71,
                'name' => 'As Suways',
                'code' => 'SW',
                'adm1code' => 'EG15',
            ),
            135 => 
            array (
                'id' => 1585,
                'country_id' => 71,
                'name' => 'Aswan',
                'code' => 'AN',
                'adm1code' => 'EG16',
            ),
            136 => 
            array (
                'id' => 1586,
                'country_id' => 71,
                'name' => 'Asyut',
                'code' => 'AT',
                'adm1code' => 'EG17',
            ),
            137 => 
            array (
                'id' => 1587,
                'country_id' => 71,
                'name' => 'Bani Suwayf',
                'code' => 'BN',
                'adm1code' => 'EG18',
            ),
            138 => 
            array (
                'id' => 1588,
                'country_id' => 71,
                'name' => 'Bur Sa\'id',
                'code' => 'BS',
                'adm1code' => 'EG19',
            ),
            139 => 
            array (
                'id' => 1589,
                'country_id' => 71,
                'name' => 'Dumyat',
                'code' => 'DT',
                'adm1code' => 'EG20',
            ),
            140 => 
            array (
                'id' => 1590,
                'country_id' => 71,
                'name' => 'Kafr ash Shaykh',
                'code' => 'KS',
                'adm1code' => 'EG21',
            ),
            141 => 
            array (
                'id' => 1591,
                'country_id' => 71,
                'name' => 'Matruh',
                'code' => 'MT',
                'adm1code' => 'EG22',
            ),
            142 => 
            array (
                'id' => 1592,
                'country_id' => 71,
                'name' => 'Qina',
                'code' => 'QN',
                'adm1code' => 'EG23',
            ),
            143 => 
            array (
                'id' => 1593,
                'country_id' => 71,
                'name' => 'Suhaj',
                'code' => 'SJ',
                'adm1code' => 'EG24',
            ),
            144 => 
            array (
                'id' => 1594,
                'country_id' => 71,
                'name' => 'Janub Sina\'',
                'code' => 'JS',
                'adm1code' => 'EG26',
            ),
            145 => 
            array (
                'id' => 1595,
                'country_id' => 71,
                'name' => 'Shamal Sina\'',
                'code' => 'SS',
                'adm1code' => 'EG27',
            ),
            146 => 
            array (
                'id' => 1596,
                'country_id' => 117,
                'name' => 'Carlow',
                'code' => 'CW',
                'adm1code' => 'EI01',
            ),
            147 => 
            array (
                'id' => 1597,
                'country_id' => 117,
                'name' => 'Cavan',
                'code' => 'CN',
                'adm1code' => 'EI02',
            ),
            148 => 
            array (
                'id' => 1598,
                'country_id' => 117,
                'name' => 'Clare',
                'code' => 'CE',
                'adm1code' => 'EI03',
            ),
            149 => 
            array (
                'id' => 1599,
                'country_id' => 117,
                'name' => 'Cork',
                'code' => 'CK',
                'adm1code' => 'EI04',
            ),
            150 => 
            array (
                'id' => 1600,
                'country_id' => 117,
                'name' => 'Donegal',
                'code' => 'DL',
                'adm1code' => 'EI06',
            ),
            151 => 
            array (
                'id' => 1601,
                'country_id' => 117,
                'name' => 'Dublin',
                'code' => 'DN',
                'adm1code' => 'EI07',
            ),
            152 => 
            array (
                'id' => 1602,
                'country_id' => 117,
                'name' => 'Galway',
                'code' => 'GY',
                'adm1code' => 'EI10',
            ),
            153 => 
            array (
                'id' => 1603,
                'country_id' => 117,
                'name' => 'Kerry',
                'code' => 'KY',
                'adm1code' => 'EI11',
            ),
            154 => 
            array (
                'id' => 1604,
                'country_id' => 117,
                'name' => 'Kildare',
                'code' => 'KE',
                'adm1code' => 'EI12',
            ),
            155 => 
            array (
                'id' => 1605,
                'country_id' => 117,
                'name' => 'Kilkenny',
                'code' => 'KK',
                'adm1code' => 'EI13',
            ),
            156 => 
            array (
                'id' => 1606,
                'country_id' => 117,
                'name' => 'Leitrim',
                'code' => 'LM',
                'adm1code' => 'EI14',
            ),
            157 => 
            array (
                'id' => 1607,
                'country_id' => 117,
                'name' => 'Laois',
                'code' => 'LS',
                'adm1code' => 'EI15',
            ),
            158 => 
            array (
                'id' => 1608,
                'country_id' => 117,
                'name' => 'Limerick',
                'code' => 'LK',
                'adm1code' => 'EI16',
            ),
            159 => 
            array (
                'id' => 1609,
                'country_id' => 117,
                'name' => 'Longford',
                'code' => 'LD',
                'adm1code' => 'EI18',
            ),
            160 => 
            array (
                'id' => 1610,
                'country_id' => 117,
                'name' => 'Louth',
                'code' => 'LH',
                'adm1code' => 'EI19',
            ),
            161 => 
            array (
                'id' => 1611,
                'country_id' => 117,
                'name' => 'Mayo',
                'code' => 'MO',
                'adm1code' => 'EI20',
            ),
            162 => 
            array (
                'id' => 1612,
                'country_id' => 117,
                'name' => 'Meath',
                'code' => 'MH',
                'adm1code' => 'EI21',
            ),
            163 => 
            array (
                'id' => 1613,
                'country_id' => 117,
                'name' => 'Monaghan',
                'code' => 'MN',
                'adm1code' => 'EI22',
            ),
            164 => 
            array (
                'id' => 1614,
                'country_id' => 117,
                'name' => 'Offaly',
                'code' => 'OY',
                'adm1code' => 'EI23',
            ),
            165 => 
            array (
                'id' => 1615,
                'country_id' => 117,
                'name' => 'Roscommon',
                'code' => 'RN',
                'adm1code' => 'EI24',
            ),
            166 => 
            array (
                'id' => 1616,
                'country_id' => 117,
                'name' => 'Sligo',
                'code' => 'SO',
                'adm1code' => 'EI25',
            ),
            167 => 
            array (
                'id' => 1617,
                'country_id' => 117,
                'name' => 'Tipperary',
                'code' => 'TY',
                'adm1code' => 'EI26',
            ),
            168 => 
            array (
                'id' => 1618,
                'country_id' => 117,
                'name' => 'Waterford',
                'code' => 'WD',
                'adm1code' => 'EI27',
            ),
            169 => 
            array (
                'id' => 1619,
                'country_id' => 117,
                'name' => 'Westmeath',
                'code' => 'WH',
                'adm1code' => 'EI29',
            ),
            170 => 
            array (
                'id' => 1620,
                'country_id' => 117,
                'name' => 'Wexford',
                'code' => 'WX',
                'adm1code' => 'EI30',
            ),
            171 => 
            array (
                'id' => 1621,
                'country_id' => 117,
                'name' => 'Wicklow',
                'code' => 'WW',
                'adm1code' => 'EI31',
            ),
            172 => 
            array (
                'id' => 1622,
                'country_id' => 73,
                'name' => 'Annobon',
                'code' => 'AN',
                'adm1code' => 'EK03',
            ),
            173 => 
            array (
                'id' => 1623,
                'country_id' => 73,
                'name' => 'Bioko Norte',
                'code' => 'BN',
                'adm1code' => 'EK04',
            ),
            174 => 
            array (
                'id' => 1624,
                'country_id' => 73,
                'name' => 'Bioko Sur',
                'code' => 'BS',
                'adm1code' => 'EK05',
            ),
            175 => 
            array (
                'id' => 1625,
                'country_id' => 73,
                'name' => 'Centro Sur',
                'code' => 'CS',
                'adm1code' => 'EK06',
            ),
            176 => 
            array (
                'id' => 1626,
                'country_id' => 73,
                'name' => 'Kie-Ntem',
                'code' => 'KN',
                'adm1code' => 'EK07',
            ),
            177 => 
            array (
                'id' => 1627,
                'country_id' => 73,
                'name' => 'Litoral',
                'code' => 'LI',
                'adm1code' => 'EK08',
            ),
            178 => 
            array (
                'id' => 1628,
                'country_id' => 73,
                'name' => 'Wele-Nzas',
                'code' => 'WN',
                'adm1code' => 'EK09',
            ),
            179 => 
            array (
                'id' => 1629,
                'country_id' => 75,
                'name' => 'Harjumaa',
                'code' => 'HA',
                'adm1code' => 'EN01',
            ),
            180 => 
            array (
                'id' => 1630,
                'country_id' => 75,
                'name' => 'Hiiumaa',
                'code' => 'HI',
                'adm1code' => 'EN02',
            ),
            181 => 
            array (
                'id' => 1631,
                'country_id' => 75,
                'name' => 'Ida-Virumaa',
                'code' => 'IV',
                'adm1code' => 'EN03',
            ),
            182 => 
            array (
                'id' => 1632,
                'country_id' => 75,
                'name' => 'Jarvamaa',
                'code' => 'JR',
                'adm1code' => 'EN04',
            ),
            183 => 
            array (
                'id' => 1633,
                'country_id' => 75,
                'name' => 'Jogevamaa',
                'code' => 'JN',
                'adm1code' => 'EN05',
            ),
            184 => 
            array (
                'id' => 1634,
                'country_id' => 75,
                'name' => 'Laanemaa',
                'code' => 'LN',
                'adm1code' => 'EN07',
            ),
            185 => 
            array (
                'id' => 1635,
                'country_id' => 75,
                'name' => 'Laane-Virumaa',
                'code' => 'LV',
                'adm1code' => 'EN08',
            ),
            186 => 
            array (
                'id' => 1636,
                'country_id' => 75,
                'name' => 'Parnumaa',
                'code' => 'PR',
                'adm1code' => 'EN11',
            ),
            187 => 
            array (
                'id' => 1637,
                'country_id' => 75,
                'name' => 'Polvamaa',
                'code' => 'PL',
                'adm1code' => 'EN12',
            ),
            188 => 
            array (
                'id' => 1638,
                'country_id' => 75,
                'name' => 'Raplamaa',
                'code' => 'RA',
                'adm1code' => 'EN13',
            ),
            189 => 
            array (
                'id' => 1639,
                'country_id' => 75,
                'name' => 'Saaremaa',
                'code' => 'SA',
                'adm1code' => 'EN14',
            ),
            190 => 
            array (
                'id' => 1640,
                'country_id' => 75,
                'name' => 'Tartumaa',
                'code' => 'TA',
                'adm1code' => 'EN18',
            ),
            191 => 
            array (
                'id' => 1641,
                'country_id' => 75,
                'name' => 'Valgamaa',
                'code' => 'VG',
                'adm1code' => 'EN19',
            ),
            192 => 
            array (
                'id' => 1642,
                'country_id' => 75,
                'name' => 'Viljandimaa',
                'code' => 'VD',
                'adm1code' => 'EN20',
            ),
            193 => 
            array (
                'id' => 1643,
                'country_id' => 75,
                'name' => 'Vorumaa',
                'code' => 'VR',
                'adm1code' => 'EN21',
            ),
            194 => 
            array (
                'id' => 1644,
                'country_id' => 72,
                'name' => 'Ahuachapan',
                'code' => 'AH',
                'adm1code' => 'ES01',
            ),
            195 => 
            array (
                'id' => 1645,
                'country_id' => 72,
                'name' => 'Cabanas',
                'code' => 'CA',
                'adm1code' => 'ES02',
            ),
            196 => 
            array (
                'id' => 1646,
                'country_id' => 72,
                'name' => 'Chalatenango',
                'code' => 'CH',
                'adm1code' => 'ES03',
            ),
            197 => 
            array (
                'id' => 1647,
                'country_id' => 72,
                'name' => 'Cuscatlan',
                'code' => 'CU',
                'adm1code' => 'ES04',
            ),
            198 => 
            array (
                'id' => 1648,
                'country_id' => 72,
                'name' => 'La Libertad',
                'code' => 'LI',
                'adm1code' => 'ES05',
            ),
            199 => 
            array (
                'id' => 1649,
                'country_id' => 72,
                'name' => 'La Paz',
                'code' => 'PA',
                'adm1code' => 'ES06',
            ),
            200 => 
            array (
                'id' => 1650,
                'country_id' => 72,
                'name' => 'La Union',
                'code' => 'UN',
                'adm1code' => 'ES07',
            ),
            201 => 
            array (
                'id' => 1651,
                'country_id' => 72,
                'name' => 'Morazan',
                'code' => 'MO',
                'adm1code' => 'ES08',
            ),
            202 => 
            array (
                'id' => 1652,
                'country_id' => 72,
                'name' => 'San Miguel',
                'code' => 'SM',
                'adm1code' => 'ES09',
            ),
            203 => 
            array (
                'id' => 1653,
                'country_id' => 72,
                'name' => 'San Salvador',
                'code' => 'SS',
                'adm1code' => 'ES10',
            ),
            204 => 
            array (
                'id' => 1654,
                'country_id' => 72,
                'name' => 'Santa Ana',
                'code' => 'SA',
                'adm1code' => 'ES11',
            ),
            205 => 
            array (
                'id' => 1655,
                'country_id' => 72,
                'name' => 'San Vicente',
                'code' => 'SI',
                'adm1code' => 'ES12',
            ),
            206 => 
            array (
                'id' => 1656,
                'country_id' => 72,
                'name' => 'Sonsonate',
                'code' => 'SO',
                'adm1code' => 'ES13',
            ),
            207 => 
            array (
                'id' => 1657,
                'country_id' => 72,
                'name' => 'Usulutan',
                'code' => 'US',
                'adm1code' => 'ES14',
            ),
            208 => 
            array (
                'id' => 1687,
                'country_id' => 76,
                'name' => 'Harari People',
                'code' => 'HA',
                'adm1code' => 'ET50',
            ),
            209 => 
            array (
                'id' => 1688,
                'country_id' => 76,
                'name' => 'Gambela Peoples',
                'code' => 'GA',
                'adm1code' => 'ET49',
            ),
            210 => 
            array (
                'id' => 1690,
                'country_id' => 76,
                'name' => 'Benshangul-Gumaz',
                'code' => 'BE',
                'adm1code' => 'ET47',
            ),
            211 => 
            array (
                'id' => 1691,
                'country_id' => 76,
                'name' => 'Tigray',
                'code' => 'TI',
                'adm1code' => 'ET53',
            ),
            212 => 
            array (
                'id' => 1692,
                'country_id' => 76,
                'name' => 'Amhara',
                'code' => 'AM',
                'adm1code' => 'ET46',
            ),
            213 => 
            array (
                'id' => 1693,
                'country_id' => 76,
                'name' => 'Afar',
                'code' => 'AF',
                'adm1code' => 'ET45',
            ),
            214 => 
            array (
                'id' => 1694,
                'country_id' => 76,
                'name' => 'Oromia',
                'code' => 'OR',
                'adm1code' => 'ET51',
            ),
            215 => 
            array (
                'id' => 1695,
                'country_id' => 76,
                'name' => 'Somali',
                'code' => 'SO',
                'adm1code' => 'ET52',
            ),
            216 => 
            array (
                'id' => 1696,
                'country_id' => 76,
                'name' => 'Addis Ababa',
                'code' => 'AA',
                'adm1code' => 'ET44',
            ),
            217 => 
            array (
                'id' => 1697,
                'country_id' => 76,
                'name' => 'Southern Nations',
                'code' => 'SN',
                'adm1code' => 'ET54',
            ),
            218 => 
            array (
                'id' => 1746,
                'country_id' => 64,
                'name' => 'Hlavni Mesto Praha',
                'code' => 'PR',
                'adm1code' => 'EZ52',
            ),
            219 => 
            array (
                'id' => 1772,
                'country_id' => 81,
                'name' => 'Ahvenanmaa',
                'code' => 'AV',
                'adm1code' => 'FI01',
            ),
            220 => 
            array (
                'id' => 1777,
                'country_id' => 81,
                'name' => 'Lappi',
                'code' => 'LP',
                'adm1code' => 'FI06',
            ),
            221 => 
            array (
                'id' => 1779,
                'country_id' => 81,
                'name' => 'Oulu Laani',
                'code' => 'OU',
                'adm1code' => 'FI08',
            ),
            222 => 
            array (
                'id' => 1784,
                'country_id' => 80,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'FJ01',
            ),
            223 => 
            array (
                'id' => 1785,
                'country_id' => 80,
                'name' => 'Eastern',
                'code' => 'EA',
                'adm1code' => 'FJ02',
            ),
            224 => 
            array (
                'id' => 1786,
                'country_id' => 80,
                'name' => 'Northern',
                'code' => 'NO',
                'adm1code' => 'FJ03',
            ),
            225 => 
            array (
                'id' => 1787,
                'country_id' => 80,
                'name' => 'Rotuma',
                'code' => 'RO',
                'adm1code' => 'FJ04',
            ),
            226 => 
            array (
                'id' => 1788,
                'country_id' => 80,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'FJ05',
            ),
            227 => 
            array (
                'id' => 1789,
                'country_id' => 160,
                'name' => 'Kosrae',
                'code' => 'KO',
                'adm1code' => 'FM01',
            ),
            228 => 
            array (
                'id' => 1790,
                'country_id' => 160,
                'name' => 'Pohnpei',
                'code' => 'PO',
                'adm1code' => 'FM02',
            ),
            229 => 
            array (
                'id' => 1791,
                'country_id' => 160,
                'name' => 'Chuuk',
                'code' => 'CH',
                'adm1code' => 'FM03',
            ),
            230 => 
            array (
                'id' => 1792,
                'country_id' => 160,
                'name' => 'Yap',
                'code' => 'YA',
                'adm1code' => 'FM04',
            ),
            231 => 
            array (
                'id' => 1793,
                'country_id' => 82,
                'name' => 'Aquitaine',
                'code' => 'AQ',
                'adm1code' => 'FR97',
            ),
            232 => 
            array (
                'id' => 1794,
                'country_id' => 82,
                'name' => 'Auvergne',
                'code' => 'AU',
                'adm1code' => 'FR98',
            ),
            233 => 
            array (
                'id' => 1795,
                'country_id' => 82,
                'name' => 'Basse-Normandie',
                'code' => 'BA',
                'adm1code' => 'FR99',
            ),
            234 => 
            array (
                'id' => 1796,
                'country_id' => 82,
                'name' => 'Bourgogne',
                'code' => 'BO',
                'adm1code' => 'FRA1',
            ),
            235 => 
            array (
                'id' => 1797,
                'country_id' => 82,
                'name' => 'Bretagne',
                'code' => 'BR',
                'adm1code' => 'FRA2',
            ),
            236 => 
            array (
                'id' => 1798,
                'country_id' => 82,
                'name' => 'Centre',
                'code' => 'CE',
                'adm1code' => 'FRA3',
            ),
            237 => 
            array (
                'id' => 1799,
                'country_id' => 82,
                'name' => 'Champagne-Ardenne',
                'code' => 'CH',
                'adm1code' => 'FRA4',
            ),
            238 => 
            array (
                'id' => 1800,
                'country_id' => 82,
                'name' => 'Corse',
                'code' => 'CO',
                'adm1code' => 'FRA5',
            ),
            239 => 
            array (
                'id' => 1801,
                'country_id' => 82,
                'name' => 'Franche-Comte',
                'code' => 'FC',
                'adm1code' => 'FRA6',
            ),
            240 => 
            array (
                'id' => 1802,
                'country_id' => 82,
                'name' => 'Haute-Normandie',
                'code' => 'HA',
                'adm1code' => 'FRA7',
            ),
            241 => 
            array (
                'id' => 1803,
                'country_id' => 82,
                'name' => 'Ile-De-France',
                'code' => 'IL',
                'adm1code' => 'FRA8',
            ),
            242 => 
            array (
                'id' => 1804,
                'country_id' => 82,
                'name' => 'Languedoc-Roussillon',
                'code' => 'LA',
                'adm1code' => 'FRA9',
            ),
            243 => 
            array (
                'id' => 1805,
                'country_id' => 82,
                'name' => 'Limousin',
                'code' => 'LI',
                'adm1code' => 'FRB1',
            ),
            244 => 
            array (
                'id' => 1806,
                'country_id' => 82,
                'name' => 'Lorraine',
                'code' => 'LO',
                'adm1code' => 'FRB2',
            ),
            245 => 
            array (
                'id' => 1807,
                'country_id' => 82,
                'name' => 'Midi-Pyrenees',
                'code' => 'MI',
                'adm1code' => 'FRB3',
            ),
            246 => 
            array (
                'id' => 1808,
                'country_id' => 82,
                'name' => 'Nord-Pas-de-Calais',
                'code' => 'NO',
                'adm1code' => 'FRB4',
            ),
            247 => 
            array (
                'id' => 1809,
                'country_id' => 82,
                'name' => 'Pays de la Loire',
                'code' => 'PA',
                'adm1code' => 'FRB5',
            ),
            248 => 
            array (
                'id' => 1810,
                'country_id' => 82,
                'name' => 'Picardie',
                'code' => 'PI',
                'adm1code' => 'FRB6',
            ),
            249 => 
            array (
                'id' => 1811,
                'country_id' => 82,
                'name' => 'Poitou-Charentes',
                'code' => 'PO',
                'adm1code' => 'FRB7',
            ),
            250 => 
            array (
                'id' => 1812,
                'country_id' => 82,
                'name' => 'Provence-Alpes-Cote d\'Azur',
                'code' => 'PR',
                'adm1code' => 'FRB8',
            ),
            251 => 
            array (
                'id' => 1813,
                'country_id' => 82,
                'name' => 'Rhone-Alpes',
                'code' => 'RH',
                'adm1code' => 'FRB9',
            ),
            252 => 
            array (
                'id' => 1814,
                'country_id' => 82,
                'name' => 'Alsace',
                'code' => 'AL',
                'adm1code' => 'FRC1',
            ),
            253 => 
            array (
                'id' => 1815,
                'country_id' => 88,
                'name' => 'Banjul',
                'code' => 'BJ',
                'adm1code' => 'GA01',
            ),
            254 => 
            array (
                'id' => 1816,
                'country_id' => 88,
                'name' => 'Lower River',
                'code' => 'LR',
                'adm1code' => 'GA02',
            ),
            255 => 
            array (
                'id' => 1817,
                'country_id' => 88,
                'name' => 'MacCarthy Island',
                'code' => 'MC',
                'adm1code' => 'GA03',
            ),
            256 => 
            array (
                'id' => 1818,
                'country_id' => 88,
                'name' => 'Upper River',
                'code' => 'UR',
                'adm1code' => 'GA04',
            ),
            257 => 
            array (
                'id' => 1819,
                'country_id' => 88,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'GA05',
            ),
            258 => 
            array (
                'id' => 1820,
                'country_id' => 88,
                'name' => 'North Bank',
                'code' => 'NB',
                'adm1code' => 'GA07',
            ),
            259 => 
            array (
                'id' => 1821,
                'country_id' => 87,
                'name' => 'Estuaire',
                'code' => 'ES',
                'adm1code' => 'GB01',
            ),
            260 => 
            array (
                'id' => 1822,
                'country_id' => 87,
                'name' => 'Haut-Ogooue',
                'code' => 'HO',
                'adm1code' => 'GB02',
            ),
            261 => 
            array (
                'id' => 1823,
                'country_id' => 87,
                'name' => 'Moyen-Ogooue',
                'code' => 'MO',
                'adm1code' => 'GB03',
            ),
            262 => 
            array (
                'id' => 1824,
                'country_id' => 87,
                'name' => 'Ngounie',
                'code' => 'NG',
                'adm1code' => 'GB04',
            ),
            263 => 
            array (
                'id' => 1825,
                'country_id' => 87,
                'name' => 'Nyanga',
                'code' => 'NY',
                'adm1code' => 'GB05',
            ),
            264 => 
            array (
                'id' => 1826,
                'country_id' => 87,
                'name' => 'Ogooue-Ivindo',
                'code' => 'OI',
                'adm1code' => 'GB06',
            ),
            265 => 
            array (
                'id' => 1827,
                'country_id' => 87,
                'name' => 'Ogooue-Lolo',
                'code' => 'OL',
                'adm1code' => 'GB07',
            ),
            266 => 
            array (
                'id' => 1828,
                'country_id' => 87,
                'name' => 'Ogooue-Maritime',
                'code' => 'OM',
                'adm1code' => 'GB08',
            ),
            267 => 
            array (
                'id' => 1829,
                'country_id' => 87,
                'name' => 'Woleu-Ntem',
                'code' => 'WN',
                'adm1code' => 'GB09',
            ),
            268 => 
            array (
                'id' => 1831,
                'country_id' => 90,
                'name' => 'Abkhazia',
                'code' => 'AB',
                'adm1code' => 'GG02',
            ),
            269 => 
            array (
                'id' => 1833,
                'country_id' => 90,
                'name' => 'Ajaria',
                'code' => 'AJ',
                'adm1code' => 'GG04',
            ),
            270 => 
            array (
                'id' => 1879,
                'country_id' => 90,
                'name' => 'T\'bilisi',
                'code' => 'TB',
                'adm1code' => 'GG51',
            ),
            271 => 
            array (
                'id' => 1893,
                'country_id' => 92,
                'name' => 'Greater Accra',
                'code' => 'AA',
                'adm1code' => 'GH01',
            ),
            272 => 
            array (
                'id' => 1894,
                'country_id' => 92,
                'name' => 'Ashanti',
                'code' => 'AH',
                'adm1code' => 'GH02',
            ),
            273 => 
            array (
                'id' => 1895,
                'country_id' => 92,
                'name' => 'Brong-Ahafo',
                'code' => 'BA',
                'adm1code' => 'GH03',
            ),
            274 => 
            array (
                'id' => 1896,
                'country_id' => 92,
                'name' => 'Central',
                'code' => 'CP',
                'adm1code' => 'GH04',
            ),
            275 => 
            array (
                'id' => 1897,
                'country_id' => 92,
                'name' => 'Eastern',
                'code' => 'EP',
                'adm1code' => 'GH05',
            ),
            276 => 
            array (
                'id' => 1898,
                'country_id' => 92,
                'name' => 'Northern',
                'code' => 'NP',
                'adm1code' => 'GH06',
            ),
            277 => 
            array (
                'id' => 1899,
                'country_id' => 92,
                'name' => 'Volta',
                'code' => 'TV',
                'adm1code' => 'GH08',
            ),
            278 => 
            array (
                'id' => 1900,
                'country_id' => 92,
                'name' => 'Western',
                'code' => 'WP',
                'adm1code' => 'GH09',
            ),
            279 => 
            array (
                'id' => 1901,
                'country_id' => 92,
                'name' => 'Upper East',
                'code' => 'UE',
                'adm1code' => 'GH10',
            ),
            280 => 
            array (
                'id' => 1902,
                'country_id' => 92,
                'name' => 'Upper West',
                'code' => 'UW',
                'adm1code' => 'GH11',
            ),
            281 => 
            array (
                'id' => 1903,
                'country_id' => 97,
                'name' => 'Saint Andrew',
                'code' => 'AN',
                'adm1code' => 'GJ01',
            ),
            282 => 
            array (
                'id' => 1904,
                'country_id' => 97,
                'name' => 'Saint David',
                'code' => 'DA',
                'adm1code' => 'GJ02',
            ),
            283 => 
            array (
                'id' => 1905,
                'country_id' => 97,
                'name' => 'Saint George',
                'code' => 'GE',
                'adm1code' => 'GJ03',
            ),
            284 => 
            array (
                'id' => 1906,
                'country_id' => 97,
                'name' => 'Saint John',
                'code' => 'JO',
                'adm1code' => 'GJ04',
            ),
            285 => 
            array (
                'id' => 1907,
                'country_id' => 97,
                'name' => 'Saint Mark',
                'code' => 'MA',
                'adm1code' => 'GJ05',
            ),
            286 => 
            array (
                'id' => 1908,
                'country_id' => 97,
                'name' => 'Saint Patrick',
                'code' => 'PA',
                'adm1code' => 'GJ06',
            ),
            287 => 
            array (
                'id' => 1909,
                'country_id' => 96,
                'name' => 'Nordgronland',
                'code' => 'NG',
                'adm1code' => 'GL01',
            ),
            288 => 
            array (
                'id' => 1910,
                'country_id' => 96,
                'name' => 'Ostgronland',
                'code' => 'EG',
                'adm1code' => 'GL02',
            ),
            289 => 
            array (
                'id' => 1911,
                'country_id' => 96,
                'name' => 'Vestgronland',
                'code' => 'VG',
                'adm1code' => 'GL03',
            ),
            290 => 
            array (
                'id' => 1912,
                'country_id' => 91,
                'name' => 'Baden-Wurttemberg',
                'code' => 'BW',
                'adm1code' => 'GM01',
            ),
            291 => 
            array (
                'id' => 1913,
                'country_id' => 91,
                'name' => 'Bayern',
                'code' => 'BY',
                'adm1code' => 'GM02',
            ),
            292 => 
            array (
                'id' => 1914,
                'country_id' => 91,
                'name' => 'Bremen',
                'code' => 'HB',
                'adm1code' => 'GM03',
            ),
            293 => 
            array (
                'id' => 1915,
                'country_id' => 91,
                'name' => 'Hamburg',
                'code' => 'HH',
                'adm1code' => 'GM04',
            ),
            294 => 
            array (
                'id' => 1916,
                'country_id' => 91,
                'name' => 'Hessen',
                'code' => 'HE',
                'adm1code' => 'GM05',
            ),
            295 => 
            array (
                'id' => 1917,
                'country_id' => 91,
                'name' => 'Niedersachsen',
                'code' => 'NI',
                'adm1code' => 'GM06',
            ),
            296 => 
            array (
                'id' => 1918,
                'country_id' => 91,
                'name' => 'Nordrhein-Westfalen',
                'code' => 'NW',
                'adm1code' => 'GM07',
            ),
            297 => 
            array (
                'id' => 1919,
                'country_id' => 91,
                'name' => 'Rheinland-Pfalz',
                'code' => 'RP',
                'adm1code' => 'GM08',
            ),
            298 => 
            array (
                'id' => 1920,
                'country_id' => 91,
                'name' => 'Saarland',
                'code' => 'SL',
                'adm1code' => 'GM09',
            ),
            299 => 
            array (
                'id' => 1921,
                'country_id' => 91,
                'name' => 'Schleswig-Holstein',
                'code' => 'SH',
                'adm1code' => 'GM10',
            ),
            300 => 
            array (
                'id' => 1922,
                'country_id' => 91,
                'name' => 'Brandenburg',
                'code' => 'BB',
                'adm1code' => 'GM11',
            ),
            301 => 
            array (
                'id' => 1923,
                'country_id' => 91,
                'name' => 'Mecklenburg-Vorpommern',
                'code' => 'MY',
                'adm1code' => 'GM12',
            ),
            302 => 
            array (
                'id' => 1924,
                'country_id' => 91,
                'name' => 'Sachsen',
                'code' => 'SN',
                'adm1code' => 'GM13',
            ),
            303 => 
            array (
                'id' => 1925,
                'country_id' => 91,
                'name' => 'Sachsen-Anhalt',
                'code' => 'ST',
                'adm1code' => 'GM14',
            ),
            304 => 
            array (
                'id' => 1926,
                'country_id' => 91,
                'name' => 'Thuringen',
                'code' => 'TH',
                'adm1code' => 'GM15',
            ),
            305 => 
            array (
                'id' => 1927,
                'country_id' => 91,
                'name' => 'Berlin',
                'code' => 'BE',
                'adm1code' => 'GM16',
            ),
            306 => 
            array (
                'id' => 1928,
                'country_id' => 95,
                'name' => 'Evros',
                'code' => 'ES',
                'adm1code' => 'GR01',
            ),
            307 => 
            array (
                'id' => 1929,
                'country_id' => 95,
                'name' => 'Rodhopi',
                'code' => 'RD',
                'adm1code' => 'GR02',
            ),
            308 => 
            array (
                'id' => 1930,
                'country_id' => 95,
                'name' => 'Xanthi',
                'code' => 'XN',
                'adm1code' => 'GR03',
            ),
            309 => 
            array (
                'id' => 1931,
                'country_id' => 95,
                'name' => 'Drama',
                'code' => 'DR',
                'adm1code' => 'GR04',
            ),
            310 => 
            array (
                'id' => 1932,
                'country_id' => 95,
                'name' => 'Serrai',
                'code' => 'SR',
                'adm1code' => 'GR05',
            ),
            311 => 
            array (
                'id' => 1933,
                'country_id' => 95,
                'name' => 'Kilkis',
                'code' => 'KK',
                'adm1code' => 'GR06',
            ),
            312 => 
            array (
                'id' => 1934,
                'country_id' => 95,
                'name' => 'Pella',
                'code' => 'PL',
                'adm1code' => 'GR07',
            ),
            313 => 
            array (
                'id' => 1935,
                'country_id' => 95,
                'name' => 'Florina',
                'code' => 'FL',
                'adm1code' => 'GR08',
            ),
            314 => 
            array (
                'id' => 1936,
                'country_id' => 95,
                'name' => 'Kastoria',
                'code' => 'KS',
                'adm1code' => 'GR09',
            ),
            315 => 
            array (
                'id' => 1937,
                'country_id' => 95,
                'name' => 'Grevena',
                'code' => 'GE',
                'adm1code' => 'GR10',
            ),
            316 => 
            array (
                'id' => 1938,
                'country_id' => 95,
                'name' => 'Kozani',
                'code' => 'KZ',
                'adm1code' => 'GR11',
            ),
            317 => 
            array (
                'id' => 1939,
                'country_id' => 95,
                'name' => 'Imathia',
                'code' => 'IM',
                'adm1code' => 'GR12',
            ),
            318 => 
            array (
                'id' => 1940,
                'country_id' => 95,
                'name' => 'Thessaloniki',
                'code' => 'TN',
                'adm1code' => 'GR13',
            ),
            319 => 
            array (
                'id' => 1941,
                'country_id' => 95,
                'name' => 'Kavala',
                'code' => 'KV',
                'adm1code' => 'GR14',
            ),
            320 => 
            array (
                'id' => 1942,
                'country_id' => 95,
                'name' => 'Khalkidhiki',
                'code' => 'KD',
                'adm1code' => 'GR15',
            ),
            321 => 
            array (
                'id' => 1943,
                'country_id' => 95,
                'name' => 'Pieria',
                'code' => 'PI',
                'adm1code' => 'GR16',
            ),
            322 => 
            array (
                'id' => 1944,
                'country_id' => 95,
                'name' => 'Ioannina',
                'code' => 'IO',
                'adm1code' => 'GR17',
            ),
            323 => 
            array (
                'id' => 1945,
                'country_id' => 95,
                'name' => 'Thesprotia',
                'code' => 'TP',
                'adm1code' => 'GR18',
            ),
            324 => 
            array (
                'id' => 1946,
                'country_id' => 95,
                'name' => 'Preveza',
                'code' => 'PV',
                'adm1code' => 'GR19',
            ),
            325 => 
            array (
                'id' => 1947,
                'country_id' => 95,
                'name' => 'Arta',
                'code' => 'AR',
                'adm1code' => 'GR20',
            ),
            326 => 
            array (
                'id' => 1948,
                'country_id' => 95,
                'name' => 'Larisa',
                'code' => 'LR',
                'adm1code' => 'GR21',
            ),
            327 => 
            array (
                'id' => 1949,
                'country_id' => 95,
                'name' => 'Trikala',
                'code' => 'TR',
                'adm1code' => 'GR22',
            ),
            328 => 
            array (
                'id' => 1950,
                'country_id' => 95,
                'name' => 'Kardhitsa',
                'code' => 'KT',
                'adm1code' => 'GR23',
            ),
            329 => 
            array (
                'id' => 1951,
                'country_id' => 95,
                'name' => 'Magnisia',
                'code' => 'MG',
                'adm1code' => 'GR24',
            ),
            330 => 
            array (
                'id' => 1952,
                'country_id' => 95,
                'name' => 'Kerkira',
                'code' => 'KE',
                'adm1code' => 'GR25',
            ),
            331 => 
            array (
                'id' => 1953,
                'country_id' => 95,
                'name' => 'Levkas',
                'code' => 'LV',
                'adm1code' => 'GR26',
            ),
            332 => 
            array (
                'id' => 1954,
                'country_id' => 95,
                'name' => 'Kefallinia',
                'code' => 'KF',
                'adm1code' => 'GR27',
            ),
            333 => 
            array (
                'id' => 1955,
                'country_id' => 95,
                'name' => 'Zakinthos',
                'code' => 'ZK',
                'adm1code' => 'GR28',
            ),
            334 => 
            array (
                'id' => 1956,
                'country_id' => 95,
                'name' => 'Fthiotis',
                'code' => 'FT',
                'adm1code' => 'GR29',
            ),
            335 => 
            array (
                'id' => 1957,
                'country_id' => 95,
                'name' => 'Evritania',
                'code' => 'ET',
                'adm1code' => 'GR30',
            ),
            336 => 
            array (
                'id' => 1958,
                'country_id' => 95,
                'name' => 'Aitolia kai Akarnania',
                'code' => 'AA',
                'adm1code' => 'GR31',
            ),
            337 => 
            array (
                'id' => 1959,
                'country_id' => 95,
                'name' => 'Fokis',
                'code' => 'FK',
                'adm1code' => 'GR32',
            ),
            338 => 
            array (
                'id' => 1960,
                'country_id' => 95,
                'name' => 'Voiotia',
                'code' => 'VT',
                'adm1code' => 'GR33',
            ),
            339 => 
            array (
                'id' => 1961,
                'country_id' => 95,
                'name' => 'Evvoia',
                'code' => 'EV',
                'adm1code' => 'GR34',
            ),
            340 => 
            array (
                'id' => 1962,
                'country_id' => 95,
                'name' => 'Attiki',
                'code' => 'AT',
                'adm1code' => 'GR35',
            ),
            341 => 
            array (
                'id' => 1963,
                'country_id' => 95,
                'name' => 'Argolis',
                'code' => 'AG',
                'adm1code' => 'GR36',
            ),
            342 => 
            array (
                'id' => 1964,
                'country_id' => 95,
                'name' => 'Korinthia',
                'code' => 'KO',
                'adm1code' => 'GR37',
            ),
            343 => 
            array (
                'id' => 1965,
                'country_id' => 95,
                'name' => 'Akhaia',
                'code' => 'AK',
                'adm1code' => 'GR38',
            ),
            344 => 
            array (
                'id' => 1966,
                'country_id' => 95,
                'name' => 'Ilia',
                'code' => 'IL',
                'adm1code' => 'GR39',
            ),
            345 => 
            array (
                'id' => 1967,
                'country_id' => 95,
                'name' => 'Messinia',
                'code' => 'MS',
                'adm1code' => 'GR40',
            ),
            346 => 
            array (
                'id' => 1968,
                'country_id' => 95,
                'name' => 'Arkadhia',
                'code' => 'AD',
                'adm1code' => 'GR41',
            ),
            347 => 
            array (
                'id' => 1969,
                'country_id' => 95,
                'name' => 'Lakonia',
                'code' => 'LC',
                'adm1code' => 'GR42',
            ),
            348 => 
            array (
                'id' => 1970,
                'country_id' => 95,
                'name' => 'Khania',
                'code' => 'KN',
                'adm1code' => 'GR43',
            ),
            349 => 
            array (
                'id' => 1971,
                'country_id' => 95,
                'name' => 'Rethimni',
                'code' => 'RT',
                'adm1code' => 'GR44',
            ),
            350 => 
            array (
                'id' => 1972,
                'country_id' => 95,
            'name' => 'Iraklion (Crete)',
                'code' => 'IR',
                'adm1code' => 'GR45',
            ),
            351 => 
            array (
                'id' => 1973,
                'country_id' => 95,
                'name' => 'Lasithi',
                'code' => 'LT',
                'adm1code' => 'GR46',
            ),
            352 => 
            array (
                'id' => 1974,
                'country_id' => 95,
                'name' => 'Dhodhekanisos',
                'code' => 'DO',
                'adm1code' => 'GR47',
            ),
            353 => 
            array (
                'id' => 1975,
                'country_id' => 95,
                'name' => 'Samos',
                'code' => 'SM',
                'adm1code' => 'GR48',
            ),
            354 => 
            array (
                'id' => 1976,
                'country_id' => 95,
                'name' => 'Kikladhes',
                'code' => 'KY',
                'adm1code' => 'GR49',
            ),
            355 => 
            array (
                'id' => 1977,
                'country_id' => 95,
                'name' => 'Khios',
                'code' => 'KH',
                'adm1code' => 'GR50',
            ),
            356 => 
            array (
                'id' => 1978,
                'country_id' => 95,
                'name' => 'Lesvos',
                'code' => 'LS',
                'adm1code' => 'GR51',
            ),
            357 => 
            array (
                'id' => 1979,
                'country_id' => 100,
                'name' => 'Alta Verapaz',
                'code' => 'AV',
                'adm1code' => 'GT01',
            ),
            358 => 
            array (
                'id' => 1980,
                'country_id' => 100,
                'name' => 'Baja Verapaz',
                'code' => 'BV',
                'adm1code' => 'GT02',
            ),
            359 => 
            array (
                'id' => 1981,
                'country_id' => 100,
                'name' => 'Chimaltenango',
                'code' => 'CM',
                'adm1code' => 'GT03',
            ),
            360 => 
            array (
                'id' => 1982,
                'country_id' => 100,
                'name' => 'Chiquimula',
                'code' => 'CQ',
                'adm1code' => 'GT04',
            ),
            361 => 
            array (
                'id' => 1983,
                'country_id' => 100,
                'name' => 'El Progreso',
                'code' => 'PR',
                'adm1code' => 'GT05',
            ),
            362 => 
            array (
                'id' => 1984,
                'country_id' => 100,
                'name' => 'Escuintla',
                'code' => 'ES',
                'adm1code' => 'GT06',
            ),
            363 => 
            array (
                'id' => 1985,
                'country_id' => 100,
                'name' => 'Guatemala',
                'code' => 'GU',
                'adm1code' => 'GT07',
            ),
            364 => 
            array (
                'id' => 1986,
                'country_id' => 100,
                'name' => 'Huehuetenango',
                'code' => 'HU',
                'adm1code' => 'GT08',
            ),
            365 => 
            array (
                'id' => 1987,
                'country_id' => 100,
                'name' => 'Izabal',
                'code' => 'IZ',
                'adm1code' => 'GT09',
            ),
            366 => 
            array (
                'id' => 1988,
                'country_id' => 100,
                'name' => 'Jalapa',
                'code' => 'JA',
                'adm1code' => 'GT10',
            ),
            367 => 
            array (
                'id' => 1989,
                'country_id' => 100,
                'name' => 'Jutiapa',
                'code' => 'JU',
                'adm1code' => 'GT11',
            ),
            368 => 
            array (
                'id' => 1990,
                'country_id' => 100,
                'name' => 'Peten',
                'code' => 'PE',
                'adm1code' => 'GT12',
            ),
            369 => 
            array (
                'id' => 1991,
                'country_id' => 100,
                'name' => 'Quetzaltenango',
                'code' => 'QZ',
                'adm1code' => 'GT13',
            ),
            370 => 
            array (
                'id' => 1992,
                'country_id' => 100,
                'name' => 'Quiche',
                'code' => 'QC',
                'adm1code' => 'GT14',
            ),
            371 => 
            array (
                'id' => 1993,
                'country_id' => 100,
                'name' => 'Retalhuleu',
                'code' => 'RE',
                'adm1code' => 'GT15',
            ),
            372 => 
            array (
                'id' => 1994,
                'country_id' => 100,
                'name' => 'Sacatepequez',
                'code' => 'SA',
                'adm1code' => 'GT16',
            ),
            373 => 
            array (
                'id' => 1995,
                'country_id' => 100,
                'name' => 'San Marcos',
                'code' => 'SM',
                'adm1code' => 'GT17',
            ),
            374 => 
            array (
                'id' => 1996,
                'country_id' => 100,
                'name' => 'Santa Rosa',
                'code' => 'SR',
                'adm1code' => 'GT18',
            ),
            375 => 
            array (
                'id' => 1997,
                'country_id' => 100,
                'name' => 'Solola',
                'code' => 'SO',
                'adm1code' => 'GT19',
            ),
            376 => 
            array (
                'id' => 1998,
                'country_id' => 100,
                'name' => 'Suchitepequez',
                'code' => 'SU',
                'adm1code' => 'GT20',
            ),
            377 => 
            array (
                'id' => 1999,
                'country_id' => 100,
                'name' => 'Totonicapan',
                'code' => 'TO',
                'adm1code' => 'GT21',
            ),
            378 => 
            array (
                'id' => 2000,
                'country_id' => 100,
                'name' => 'Zacapa',
                'code' => 'ZA',
                'adm1code' => 'GT22',
            ),
            379 => 
            array (
                'id' => 2001,
                'country_id' => 102,
                'name' => 'Beyla',
                'code' => 'BE',
                'adm1code' => 'GV01',
            ),
            380 => 
            array (
                'id' => 2002,
                'country_id' => 102,
                'name' => 'Boffa',
                'code' => 'BF',
                'adm1code' => 'GV02',
            ),
            381 => 
            array (
                'id' => 2003,
                'country_id' => 102,
                'name' => 'Boke',
                'code' => 'BK',
                'adm1code' => 'GV03',
            ),
            382 => 
            array (
                'id' => 2004,
                'country_id' => 102,
                'name' => 'Conakry',
                'code' => 'CK',
                'adm1code' => 'GV04',
            ),
            383 => 
            array (
                'id' => 2005,
                'country_id' => 102,
                'name' => 'Dabola',
                'code' => 'DB',
                'adm1code' => 'GV05',
            ),
            384 => 
            array (
                'id' => 2006,
                'country_id' => 102,
                'name' => 'Dalaba',
                'code' => 'DL',
                'adm1code' => 'GV06',
            ),
            385 => 
            array (
                'id' => 2007,
                'country_id' => 102,
                'name' => 'Dinguiraye',
                'code' => 'DI',
                'adm1code' => 'GV07',
            ),
            386 => 
            array (
                'id' => 2008,
                'country_id' => 102,
                'name' => 'Dubreka',
                'code' => 'DU',
                'adm1code' => 'GV31',
            ),
            387 => 
            array (
                'id' => 2009,
                'country_id' => 102,
                'name' => 'Faranah',
                'code' => 'FA',
                'adm1code' => 'GV09',
            ),
            388 => 
            array (
                'id' => 2010,
                'country_id' => 102,
                'name' => 'Forecariah',
                'code' => 'FO',
                'adm1code' => 'GV10',
            ),
            389 => 
            array (
                'id' => 2011,
                'country_id' => 102,
                'name' => 'Fria',
                'code' => 'FR',
                'adm1code' => 'GV11',
            ),
            390 => 
            array (
                'id' => 2012,
                'country_id' => 102,
                'name' => 'Gaoual',
                'code' => 'GA',
                'adm1code' => 'GV12',
            ),
            391 => 
            array (
                'id' => 2013,
                'country_id' => 102,
                'name' => 'Gueckedou',
                'code' => 'GU',
                'adm1code' => 'GV13',
            ),
            392 => 
            array (
                'id' => 2014,
                'country_id' => 102,
                'name' => 'Kankan',
                'code' => 'KA',
                'adm1code' => 'GV32',
            ),
            393 => 
            array (
                'id' => 2015,
                'country_id' => 102,
                'name' => 'Kerouane',
                'code' => 'KE',
                'adm1code' => 'GV15',
            ),
            394 => 
            array (
                'id' => 2016,
                'country_id' => 102,
                'name' => 'Kindia',
                'code' => 'KD',
                'adm1code' => 'GV16',
            ),
            395 => 
            array (
                'id' => 2017,
                'country_id' => 102,
                'name' => 'Kissidougou',
                'code' => 'KS',
                'adm1code' => 'GV17',
            ),
            396 => 
            array (
                'id' => 2018,
                'country_id' => 102,
                'name' => 'Koundara',
                'code' => 'KN',
                'adm1code' => 'GV18',
            ),
            397 => 
            array (
                'id' => 2019,
                'country_id' => 102,
                'name' => 'Kouroussa',
                'code' => 'KO',
                'adm1code' => 'GV19',
            ),
            398 => 
            array (
                'id' => 2020,
                'country_id' => 102,
                'name' => 'Labe',
                'code' => 'LA',
                'adm1code' => 'GV34',
            ),
            399 => 
            array (
                'id' => 2021,
                'country_id' => 102,
                'name' => 'Macenta',
                'code' => 'MC',
                'adm1code' => 'GV21',
            ),
            400 => 
            array (
                'id' => 2022,
                'country_id' => 102,
                'name' => 'Mali',
                'code' => 'ML',
                'adm1code' => 'GV22',
            ),
            401 => 
            array (
                'id' => 2023,
                'country_id' => 102,
                'name' => 'Mamou',
                'code' => 'MM',
                'adm1code' => 'GV23',
            ),
            402 => 
            array (
                'id' => 2024,
                'country_id' => 102,
                'name' => 'Nzerekore',
                'code' => 'NZ',
                'adm1code' => 'GV38',
            ),
            403 => 
            array (
                'id' => 2025,
                'country_id' => 102,
                'name' => 'Pita',
                'code' => 'PI',
                'adm1code' => 'GV25',
            ),
            404 => 
            array (
                'id' => 2026,
                'country_id' => 102,
                'name' => 'Siguiri',
                'code' => 'SI',
                'adm1code' => 'GV39',
            ),
            405 => 
            array (
                'id' => 2027,
                'country_id' => 102,
                'name' => 'Telimele',
                'code' => 'TE',
                'adm1code' => 'GV27',
            ),
            406 => 
            array (
                'id' => 2028,
                'country_id' => 102,
                'name' => 'Tougue',
                'code' => 'TO',
                'adm1code' => 'GV28',
            ),
            407 => 
            array (
                'id' => 2029,
                'country_id' => 102,
                'name' => 'Yomou',
                'code' => 'YO',
                'adm1code' => 'GV29',
            ),
            408 => 
            array (
                'id' => 2030,
                'country_id' => 104,
                'name' => 'Barima-Waini',
                'code' => 'BA',
                'adm1code' => 'GY10',
            ),
            409 => 
            array (
                'id' => 2031,
                'country_id' => 104,
                'name' => 'Cuyuni-Mazaruni',
                'code' => 'CU',
                'adm1code' => 'GY11',
            ),
            410 => 
            array (
                'id' => 2032,
                'country_id' => 104,
                'name' => 'Demerara-Mahaica',
                'code' => 'DE',
                'adm1code' => 'GY12',
            ),
            411 => 
            array (
                'id' => 2033,
                'country_id' => 104,
                'name' => 'East Berbice-Corentyne',
                'code' => 'EB',
                'adm1code' => 'GY13',
            ),
            412 => 
            array (
                'id' => 2034,
                'country_id' => 104,
                'name' => 'Essequibo Islands-West Demerara',
                'code' => 'ES',
                'adm1code' => 'GY14',
            ),
            413 => 
            array (
                'id' => 2035,
                'country_id' => 104,
                'name' => 'Mahaica-Berbice',
                'code' => 'MA',
                'adm1code' => 'GY15',
            ),
            414 => 
            array (
                'id' => 2036,
                'country_id' => 104,
                'name' => 'Pomeroon-Supenaam',
                'code' => 'PM',
                'adm1code' => 'GY16',
            ),
            415 => 
            array (
                'id' => 2037,
                'country_id' => 104,
                'name' => 'Potaro-Siparuni',
                'code' => 'PT',
                'adm1code' => 'GY17',
            ),
            416 => 
            array (
                'id' => 2038,
                'country_id' => 104,
                'name' => 'Upper Demerara-Berbice',
                'code' => 'UD',
                'adm1code' => 'GY18',
            ),
            417 => 
            array (
                'id' => 2039,
                'country_id' => 104,
                'name' => 'Upper Takutu-Upper Essequibo',
                'code' => 'UT',
                'adm1code' => 'GY19',
            ),
            418 => 
            array (
                'id' => 2040,
                'country_id' => 105,
                'name' => 'Nord-Ouest',
                'code' => 'NO',
                'adm1code' => 'HA03',
            ),
            419 => 
            array (
                'id' => 2041,
                'country_id' => 105,
                'name' => 'Artibonite',
                'code' => 'AR',
                'adm1code' => 'HA06',
            ),
            420 => 
            array (
                'id' => 2042,
                'country_id' => 105,
                'name' => 'Centre',
                'code' => 'CE',
                'adm1code' => 'HA07',
            ),
            421 => 
            array (
                'id' => 2043,
                'country_id' => 105,
                'name' => 'Grand\'Anse',
                'code' => 'GA',
                'adm1code' => 'HA08',
            ),
            422 => 
            array (
                'id' => 2044,
                'country_id' => 105,
                'name' => 'Nord',
                'code' => 'ND',
                'adm1code' => 'HA09',
            ),
            423 => 
            array (
                'id' => 2045,
                'country_id' => 105,
                'name' => 'Nord-Est',
                'code' => 'NE',
                'adm1code' => 'HA10',
            ),
            424 => 
            array (
                'id' => 2046,
                'country_id' => 105,
                'name' => 'Ouest',
                'code' => 'OU',
                'adm1code' => 'HA11',
            ),
            425 => 
            array (
                'id' => 2047,
                'country_id' => 105,
                'name' => 'Sud',
                'code' => 'SD',
                'adm1code' => 'HA12',
            ),
            426 => 
            array (
                'id' => 2048,
                'country_id' => 105,
                'name' => 'Sud-Est',
                'code' => 'SE',
                'adm1code' => 'HA13',
            ),
            427 => 
            array (
                'id' => 2049,
                'country_id' => 108,
                'name' => 'Atlantida',
                'code' => 'AT',
                'adm1code' => 'HO01',
            ),
            428 => 
            array (
                'id' => 2050,
                'country_id' => 108,
                'name' => 'Choluteca',
                'code' => 'CH',
                'adm1code' => 'HO02',
            ),
            429 => 
            array (
                'id' => 2051,
                'country_id' => 108,
                'name' => 'Colon',
                'code' => 'CL',
                'adm1code' => 'HO03',
            ),
            430 => 
            array (
                'id' => 2052,
                'country_id' => 108,
                'name' => 'Comayagua',
                'code' => 'CM',
                'adm1code' => 'HO04',
            ),
            431 => 
            array (
                'id' => 2053,
                'country_id' => 108,
                'name' => 'Copan',
                'code' => 'CP',
                'adm1code' => 'HO05',
            ),
            432 => 
            array (
                'id' => 2054,
                'country_id' => 108,
                'name' => 'Cortes',
                'code' => 'CR',
                'adm1code' => 'HO06',
            ),
            433 => 
            array (
                'id' => 2055,
                'country_id' => 108,
                'name' => 'El Paraiso',
                'code' => 'EP',
                'adm1code' => 'HO07',
            ),
            434 => 
            array (
                'id' => 2056,
                'country_id' => 108,
                'name' => 'Francisco Morazan',
                'code' => 'FM',
                'adm1code' => 'HO08',
            ),
            435 => 
            array (
                'id' => 2057,
                'country_id' => 108,
                'name' => 'Gracias a Dios',
                'code' => 'GD',
                'adm1code' => 'HO09',
            ),
            436 => 
            array (
                'id' => 2058,
                'country_id' => 108,
                'name' => 'Intibuca',
                'code' => 'IN',
                'adm1code' => 'HO10',
            ),
            437 => 
            array (
                'id' => 2059,
                'country_id' => 108,
                'name' => 'Islas de la Bahia',
                'code' => 'IB',
                'adm1code' => 'HO11',
            ),
            438 => 
            array (
                'id' => 2060,
                'country_id' => 108,
                'name' => 'La Paz',
                'code' => 'LP',
                'adm1code' => 'HO12',
            ),
            439 => 
            array (
                'id' => 2061,
                'country_id' => 108,
                'name' => 'Lempira',
                'code' => 'LE',
                'adm1code' => 'HO13',
            ),
            440 => 
            array (
                'id' => 2062,
                'country_id' => 108,
                'name' => 'Ocotepeque',
                'code' => 'OC',
                'adm1code' => 'HO14',
            ),
            441 => 
            array (
                'id' => 2063,
                'country_id' => 108,
                'name' => 'Olancho',
                'code' => 'OL',
                'adm1code' => 'HO15',
            ),
            442 => 
            array (
                'id' => 2064,
                'country_id' => 108,
                'name' => 'Santa Barbara',
                'code' => 'SB',
                'adm1code' => 'HO16',
            ),
            443 => 
            array (
                'id' => 2065,
                'country_id' => 108,
                'name' => 'Valle',
                'code' => 'VA',
                'adm1code' => 'HO17',
            ),
            444 => 
            array (
                'id' => 2066,
                'country_id' => 108,
                'name' => 'Yoro',
                'code' => 'YO',
                'adm1code' => 'HO18',
            ),
            445 => 
            array (
                'id' => 2067,
                'country_id' => 111,
                'name' => 'Bacs-Kiskun',
                'code' => 'BK',
                'adm1code' => 'HU01',
            ),
            446 => 
            array (
                'id' => 2068,
                'country_id' => 111,
                'name' => 'Baranya',
                'code' => 'BA',
                'adm1code' => 'HU02',
            ),
            447 => 
            array (
                'id' => 2069,
                'country_id' => 111,
                'name' => 'Bekes',
                'code' => 'BE',
                'adm1code' => 'HU03',
            ),
            448 => 
            array (
                'id' => 2070,
                'country_id' => 111,
                'name' => 'Borsod-Abauj-Zemplen',
                'code' => 'BZ',
                'adm1code' => 'HU04',
            ),
            449 => 
            array (
                'id' => 2071,
                'country_id' => 111,
                'name' => 'Budapest',
                'code' => 'BU',
                'adm1code' => 'HU05',
            ),
            450 => 
            array (
                'id' => 2072,
                'country_id' => 111,
                'name' => 'Csongrad',
                'code' => 'CS',
                'adm1code' => 'HU06',
            ),
            451 => 
            array (
                'id' => 2073,
                'country_id' => 111,
                'name' => 'Debrecen',
                'code' => 'DE',
                'adm1code' => 'HU07',
            ),
            452 => 
            array (
                'id' => 2074,
                'country_id' => 111,
                'name' => 'Fejer',
                'code' => 'FE',
                'adm1code' => 'HU08',
            ),
            453 => 
            array (
                'id' => 2075,
                'country_id' => 111,
                'name' => 'Gyor-Moson-Sopron',
                'code' => 'GS',
                'adm1code' => 'HU09',
            ),
            454 => 
            array (
                'id' => 2076,
                'country_id' => 111,
                'name' => 'Hajdu-Bihar',
                'code' => 'HB',
                'adm1code' => 'HU10',
            ),
            455 => 
            array (
                'id' => 2077,
                'country_id' => 111,
                'name' => 'Heves',
                'code' => 'HE',
                'adm1code' => 'HU11',
            ),
            456 => 
            array (
                'id' => 2078,
                'country_id' => 111,
                'name' => 'Komarom-Esztergom',
                'code' => 'KE',
                'adm1code' => 'HU12',
            ),
            457 => 
            array (
                'id' => 2079,
                'country_id' => 111,
                'name' => 'Miskolc',
                'code' => 'MI',
                'adm1code' => 'HU13',
            ),
            458 => 
            array (
                'id' => 2080,
                'country_id' => 111,
                'name' => 'Nograd',
                'code' => 'NO',
                'adm1code' => 'HU14',
            ),
            459 => 
            array (
                'id' => 2081,
                'country_id' => 111,
                'name' => 'Pees',
                'code' => 'PS',
                'adm1code' => 'HU15',
            ),
            460 => 
            array (
                'id' => 2082,
                'country_id' => 111,
                'name' => 'Pest',
                'code' => 'PE',
                'adm1code' => 'HU16',
            ),
            461 => 
            array (
                'id' => 2083,
                'country_id' => 111,
                'name' => 'Somogy',
                'code' => 'SO',
                'adm1code' => 'HU17',
            ),
            462 => 
            array (
                'id' => 2084,
                'country_id' => 111,
                'name' => 'Szabolcs-Szatmar-Bereg',
                'code' => 'SZ',
                'adm1code' => 'HU18',
            ),
            463 => 
            array (
                'id' => 2085,
                'country_id' => 111,
                'name' => 'Szeged',
                'code' => 'SD',
                'adm1code' => 'HU19',
            ),
            464 => 
            array (
                'id' => 2086,
                'country_id' => 111,
                'name' => 'Jasz-Nagykun-Szolnok',
                'code' => 'JN',
                'adm1code' => 'HU20',
            ),
            465 => 
            array (
                'id' => 2087,
                'country_id' => 111,
                'name' => 'Tolna',
                'code' => 'TO',
                'adm1code' => 'HU21',
            ),
            466 => 
            array (
                'id' => 2088,
                'country_id' => 111,
                'name' => 'Vas',
                'code' => 'VA',
                'adm1code' => 'HU22',
            ),
            467 => 
            array (
                'id' => 2089,
                'country_id' => 111,
                'name' => 'Veszprem',
                'code' => 'VM',
                'adm1code' => 'HU39',
            ),
            468 => 
            array (
                'id' => 2090,
                'country_id' => 111,
                'name' => 'Zala',
                'code' => 'ZA',
                'adm1code' => 'HU24',
            ),
            469 => 
            array (
                'id' => 2091,
                'country_id' => 111,
                'name' => 'Gyor',
                'code' => 'GY',
                'adm1code' => 'HU25',
            ),
            470 => 
            array (
                'id' => 2092,
                'country_id' => 111,
                'name' => 'Bekescsaba',
                'code' => 'BC',
                'adm1code' => 'HU26',
            ),
            471 => 
            array (
                'id' => 2093,
                'country_id' => 111,
                'name' => 'Dunaujvaros',
                'code' => 'DU',
                'adm1code' => 'HU27',
            ),
            472 => 
            array (
                'id' => 2094,
                'country_id' => 111,
                'name' => 'Eger',
                'code' => 'EG',
                'adm1code' => 'HU28',
            ),
            473 => 
            array (
                'id' => 2095,
                'country_id' => 111,
                'name' => 'Hodmezovasarhely',
                'code' => 'HV',
                'adm1code' => 'HU29',
            ),
            474 => 
            array (
                'id' => 2096,
                'country_id' => 111,
                'name' => 'Kaposvar',
                'code' => 'KV',
                'adm1code' => 'HU30',
            ),
            475 => 
            array (
                'id' => 2097,
                'country_id' => 111,
                'name' => 'Kecskemet',
                'code' => 'KM',
                'adm1code' => 'HU31',
            ),
            476 => 
            array (
                'id' => 2098,
                'country_id' => 111,
                'name' => 'Nagykanizsa',
                'code' => 'NK',
                'adm1code' => 'HU32',
            ),
            477 => 
            array (
                'id' => 2099,
                'country_id' => 111,
                'name' => 'Nyiregyhaza',
                'code' => 'NY',
                'adm1code' => 'HU33',
            ),
            478 => 
            array (
                'id' => 2100,
                'country_id' => 111,
                'name' => 'Sopron',
                'code' => 'SN',
                'adm1code' => 'HU34',
            ),
            479 => 
            array (
                'id' => 2101,
                'country_id' => 111,
                'name' => 'Szekesfehervar',
                'code' => 'SF',
                'adm1code' => 'HU35',
            ),
            480 => 
            array (
                'id' => 2102,
                'country_id' => 111,
                'name' => 'Szolnok',
                'code' => 'SK',
                'adm1code' => 'HU36',
            ),
            481 => 
            array (
                'id' => 2103,
                'country_id' => 111,
                'name' => 'Szombathely',
                'code' => 'SH',
                'adm1code' => 'HU37',
            ),
            482 => 
            array (
                'id' => 2104,
                'country_id' => 111,
                'name' => 'Tatabanya',
                'code' => 'TB',
                'adm1code' => 'HU38',
            ),
            483 => 
            array (
                'id' => 2105,
                'country_id' => 111,
                'name' => 'Zalaegerszeg',
                'code' => 'ZE',
                'adm1code' => 'HU40',
            ),
            484 => 
            array (
                'id' => 2106,
                'country_id' => 112,
                'name' => 'Akranes',
                'code' => 'AK',
                'adm1code' => 'IC01',
            ),
            485 => 
            array (
                'id' => 2107,
                'country_id' => 112,
                'name' => 'Akureyri',
                'code' => 'AU',
                'adm1code' => 'IC02',
            ),
            486 => 
            array (
                'id' => 2108,
                'country_id' => 112,
                'name' => 'Arnessysla',
                'code' => 'AR',
                'adm1code' => 'IC03',
            ),
            487 => 
            array (
                'id' => 2109,
                'country_id' => 112,
                'name' => 'Austur-Bardastrandarsysla',
                'code' => 'AB',
                'adm1code' => 'IC04',
            ),
            488 => 
            array (
                'id' => 2110,
                'country_id' => 112,
                'name' => 'Austur-Hunavatnssysla',
                'code' => 'AH',
                'adm1code' => 'IC05',
            ),
            489 => 
            array (
                'id' => 2111,
                'country_id' => 112,
                'name' => 'Austur-Skaftafellssysla',
                'code' => 'AS',
                'adm1code' => 'IC06',
            ),
            490 => 
            array (
                'id' => 2112,
                'country_id' => 112,
                'name' => 'Borgarfjardarsysla',
                'code' => 'BF',
                'adm1code' => 'IC07',
            ),
            491 => 
            array (
                'id' => 2113,
                'country_id' => 112,
                'name' => 'Dalasysla',
                'code' => 'DS',
                'adm1code' => 'IC08',
            ),
            492 => 
            array (
                'id' => 2114,
                'country_id' => 112,
                'name' => 'Eyjafjardarsysla',
                'code' => 'EY',
                'adm1code' => 'IC09',
            ),
            493 => 
            array (
                'id' => 2115,
                'country_id' => 112,
                'name' => 'Gullbringusysla',
                'code' => 'GU',
                'adm1code' => 'IC10',
            ),
            494 => 
            array (
                'id' => 2116,
                'country_id' => 112,
                'name' => 'Hafnarfjordur',
                'code' => 'HA',
                'adm1code' => 'IC11',
            ),
            495 => 
            array (
                'id' => 2117,
                'country_id' => 112,
                'name' => 'Husavik',
                'code' => 'HU',
                'adm1code' => 'IC12',
            ),
            496 => 
            array (
                'id' => 2118,
                'country_id' => 112,
                'name' => 'Isafjordur',
                'code' => 'IA',
                'adm1code' => 'IC13',
            ),
            497 => 
            array (
                'id' => 2119,
                'country_id' => 112,
                'name' => 'Keflavik',
                'code' => 'KE',
                'adm1code' => 'IC14',
            ),
            498 => 
            array (
                'id' => 2120,
                'country_id' => 112,
                'name' => 'Kjosarsysla',
                'code' => 'KJ',
                'adm1code' => 'IC15',
            ),
            499 => 
            array (
                'id' => 2121,
                'country_id' => 112,
                'name' => 'Kopavogur',
                'code' => 'KO',
                'adm1code' => 'IC16',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 2122,
                'country_id' => 112,
                'name' => 'Myrasysla',
                'code' => 'MY',
                'adm1code' => 'IC17',
            ),
            1 => 
            array (
                'id' => 2123,
                'country_id' => 112,
                'name' => 'Neskaupstadur',
                'code' => 'NE',
                'adm1code' => 'IC18',
            ),
            2 => 
            array (
                'id' => 2124,
                'country_id' => 112,
                'name' => 'Nordur-Isafjardarsysla',
                'code' => 'NI',
                'adm1code' => 'IC19',
            ),
            3 => 
            array (
                'id' => 2125,
                'country_id' => 112,
                'name' => 'Nordur-Mulasysla',
                'code' => 'NM',
                'adm1code' => 'IC20',
            ),
            4 => 
            array (
                'id' => 2126,
                'country_id' => 112,
                'name' => 'Nordur-Tingeyjarsysla',
                'code' => 'NT',
                'adm1code' => 'IC21',
            ),
            5 => 
            array (
                'id' => 2127,
                'country_id' => 112,
                'name' => 'Olafsfjordur',
                'code' => 'OL',
                'adm1code' => 'IC22',
            ),
            6 => 
            array (
                'id' => 2128,
                'country_id' => 112,
                'name' => 'RangÂ·rvallasysla',
                'code' => 'RA',
                'adm1code' => 'IC23',
            ),
            7 => 
            array (
                'id' => 2129,
                'country_id' => 112,
                'name' => 'Reykjavik',
                'code' => 'RE',
                'adm1code' => 'IC24',
            ),
            8 => 
            array (
                'id' => 2130,
                'country_id' => 112,
                'name' => 'Saudarkrokur',
                'code' => 'SA',
                'adm1code' => 'IC25',
            ),
            9 => 
            array (
                'id' => 2131,
                'country_id' => 112,
                'name' => 'Seydisfjordur',
                'code' => 'SE',
                'adm1code' => 'IC26',
            ),
            10 => 
            array (
                'id' => 2132,
                'country_id' => 112,
                'name' => 'Siglufjordur',
                'code' => 'SI',
                'adm1code' => 'IC27',
            ),
            11 => 
            array (
                'id' => 2133,
                'country_id' => 112,
                'name' => 'Skagafjardarsysla',
                'code' => 'SG',
                'adm1code' => 'IC28',
            ),
            12 => 
            array (
                'id' => 2134,
                'country_id' => 112,
                'name' => 'Snafellsnes-og Hnappadalssysla',
                'code' => 'SH',
                'adm1code' => 'IC29',
            ),
            13 => 
            array (
                'id' => 2135,
                'country_id' => 112,
                'name' => 'Strandasysla',
                'code' => 'SD',
                'adm1code' => 'IC30',
            ),
            14 => 
            array (
                'id' => 2136,
                'country_id' => 112,
                'name' => 'Sudur-Mulasysla',
                'code' => 'SM',
                'adm1code' => 'IC31',
            ),
            15 => 
            array (
                'id' => 2137,
                'country_id' => 112,
                'name' => 'Sudur-Tingeyjarsysla',
                'code' => 'ST',
                'adm1code' => 'IC32',
            ),
            16 => 
            array (
                'id' => 2138,
                'country_id' => 112,
                'name' => 'Vestmannaeyjar',
                'code' => 'VE',
                'adm1code' => 'IC33',
            ),
            17 => 
            array (
                'id' => 2139,
                'country_id' => 112,
                'name' => 'Vestur-Bardastrandarsysla',
                'code' => 'VB',
                'adm1code' => 'IC34',
            ),
            18 => 
            array (
                'id' => 2140,
                'country_id' => 112,
                'name' => 'Vestur-Hunavatnssysla',
                'code' => 'VH',
                'adm1code' => 'IC35',
            ),
            19 => 
            array (
                'id' => 2141,
                'country_id' => 112,
                'name' => 'Vestur-Isafjardarsysla',
                'code' => 'VI',
                'adm1code' => 'IC36',
            ),
            20 => 
            array (
                'id' => 2142,
                'country_id' => 112,
                'name' => 'Vestur-Skaftafellssysla',
                'code' => 'VS',
                'adm1code' => 'IC37',
            ),
            21 => 
            array (
                'id' => 2143,
                'country_id' => 114,
            'name' => 'Aceh (Atjeh)',
                'code' => 'AC',
                'adm1code' => 'ID01',
            ),
            22 => 
            array (
                'id' => 2144,
                'country_id' => 114,
                'name' => 'Bengkulu',
                'code' => 'BE',
                'adm1code' => 'ID03',
            ),
            23 => 
            array (
                'id' => 2145,
                'country_id' => 114,
            'name' => 'Jakarta Raya (Djakarta Raya)',
                'code' => 'JK',
                'adm1code' => 'ID04',
            ),
            24 => 
            array (
                'id' => 2146,
                'country_id' => 114,
            'name' => 'Jambi (Djambi)',
                'code' => 'JA',
                'adm1code' => 'ID05',
            ),
            25 => 
            array (
                'id' => 2147,
                'country_id' => 114,
            'name' => 'Jawa Barat (Djawa Barat)',
                'code' => 'JR',
                'adm1code' => 'ID30',
            ),
            26 => 
            array (
                'id' => 2148,
                'country_id' => 114,
            'name' => 'Jawa Tengah (Djawa Tengah)',
                'code' => 'JT',
                'adm1code' => 'ID07',
            ),
            27 => 
            array (
                'id' => 2149,
                'country_id' => 114,
            'name' => 'Jawa Timur (Djawa Timur)',
                'code' => 'JI',
                'adm1code' => 'ID08',
            ),
            28 => 
            array (
                'id' => 2150,
                'country_id' => 114,
            'name' => 'Yogyakarta (Jogjakarta)',
                'code' => 'YO',
                'adm1code' => 'ID10',
            ),
            29 => 
            array (
                'id' => 2151,
                'country_id' => 114,
                'name' => 'Kalimantan Barat',
                'code' => 'KB',
                'adm1code' => 'ID11',
            ),
            30 => 
            array (
                'id' => 2152,
                'country_id' => 114,
                'name' => 'Kalimantan Selatan',
                'code' => 'KS',
                'adm1code' => 'ID12',
            ),
            31 => 
            array (
                'id' => 2153,
                'country_id' => 114,
                'name' => 'Kalimantan Tengah',
                'code' => 'KT',
                'adm1code' => 'ID13',
            ),
            32 => 
            array (
                'id' => 2154,
                'country_id' => 114,
                'name' => 'Kalimantan Timur',
                'code' => 'KI',
                'adm1code' => 'ID14',
            ),
            33 => 
            array (
                'id' => 2155,
                'country_id' => 114,
                'name' => 'Lampung',
                'code' => 'LA',
                'adm1code' => 'ID15',
            ),
            34 => 
            array (
                'id' => 2156,
                'country_id' => 114,
                'name' => 'Maluku',
                'code' => 'MA',
                'adm1code' => 'ID28',
            ),
            35 => 
            array (
                'id' => 2157,
                'country_id' => 114,
                'name' => 'Nusa Tenggara Barat',
                'code' => 'NB',
                'adm1code' => 'ID17',
            ),
            36 => 
            array (
                'id' => 2158,
                'country_id' => 114,
                'name' => 'Nusa Tenggara Timur',
                'code' => 'NT',
                'adm1code' => 'ID18',
            ),
            37 => 
            array (
                'id' => 2159,
                'country_id' => 114,
                'name' => 'Riau',
                'code' => 'RI',
                'adm1code' => 'ID19',
            ),
            38 => 
            array (
                'id' => 2160,
                'country_id' => 114,
                'name' => 'Sulawesi Selatan',
                'code' => 'SN',
                'adm1code' => 'ID20',
            ),
            39 => 
            array (
                'id' => 2161,
                'country_id' => 114,
                'name' => 'Sulawesi Tengah',
                'code' => 'ST',
                'adm1code' => 'ID21',
            ),
            40 => 
            array (
                'id' => 2162,
                'country_id' => 114,
                'name' => 'Sulawesi Tenggara',
                'code' => 'SG',
                'adm1code' => 'ID22',
            ),
            41 => 
            array (
                'id' => 2163,
                'country_id' => 114,
                'name' => 'Sulawesi Utara',
                'code' => 'SW',
                'adm1code' => 'ID31',
            ),
            42 => 
            array (
                'id' => 2164,
                'country_id' => 114,
                'name' => 'Sumatera Barat',
                'code' => 'SB',
                'adm1code' => 'ID24',
            ),
            43 => 
            array (
                'id' => 2165,
                'country_id' => 114,
                'name' => 'Sumatera Selatan',
                'code' => 'SL',
                'adm1code' => 'ID32',
            ),
            44 => 
            array (
                'id' => 2166,
                'country_id' => 114,
                'name' => 'Sumatera Utara',
                'code' => 'SU',
                'adm1code' => 'ID26',
            ),
            45 => 
            array (
                'id' => 2168,
                'country_id' => 113,
                'name' => 'Andaman and Nicobar Islands',
                'code' => 'AN',
                'adm1code' => 'IN01',
            ),
            46 => 
            array (
                'id' => 2169,
                'country_id' => 113,
                'name' => 'Andhra Pradesh',
                'code' => 'AP',
                'adm1code' => 'IN02',
            ),
            47 => 
            array (
                'id' => 2170,
                'country_id' => 113,
                'name' => 'Assam',
                'code' => 'AS',
                'adm1code' => 'IN03',
            ),
            48 => 
            array (
                'id' => 2171,
                'country_id' => 113,
                'name' => 'Bihar',
                'code' => 'BR',
                'adm1code' => 'IN34',
            ),
            49 => 
            array (
                'id' => 2172,
                'country_id' => 113,
                'name' => 'Chandigarh',
                'code' => 'CH',
                'adm1code' => 'IN05',
            ),
            50 => 
            array (
                'id' => 2173,
                'country_id' => 113,
                'name' => 'Dadra and Nagar Haveli',
                'code' => 'DN',
                'adm1code' => 'IN06',
            ),
            51 => 
            array (
                'id' => 2174,
                'country_id' => 113,
                'name' => 'Delhi',
                'code' => 'DL',
                'adm1code' => 'IN07',
            ),
            52 => 
            array (
                'id' => 2175,
                'country_id' => 113,
                'name' => 'Gujarat',
                'code' => 'GJ',
                'adm1code' => 'IN09',
            ),
            53 => 
            array (
                'id' => 2176,
                'country_id' => 113,
                'name' => 'Haryana',
                'code' => 'HR',
                'adm1code' => 'IN10',
            ),
            54 => 
            array (
                'id' => 2177,
                'country_id' => 113,
                'name' => 'Himachal Pradesh',
                'code' => 'HP',
                'adm1code' => 'IN11',
            ),
            55 => 
            array (
                'id' => 2178,
                'country_id' => 113,
                'name' => 'Jammu and Kashmir',
                'code' => 'JK',
                'adm1code' => 'IN12',
            ),
            56 => 
            array (
                'id' => 2179,
                'country_id' => 113,
                'name' => 'Kerala',
                'code' => 'KL',
                'adm1code' => 'IN13',
            ),
            57 => 
            array (
                'id' => 2180,
                'country_id' => 113,
                'name' => 'Lakshadweep',
                'code' => 'LD',
                'adm1code' => 'IN14',
            ),
            58 => 
            array (
                'id' => 2181,
                'country_id' => 113,
                'name' => 'Madhya Pradesh',
                'code' => 'MP',
                'adm1code' => 'IN35',
            ),
            59 => 
            array (
                'id' => 2182,
                'country_id' => 113,
                'name' => 'Maharashtra',
                'code' => 'MH',
                'adm1code' => 'IN16',
            ),
            60 => 
            array (
                'id' => 2183,
                'country_id' => 113,
                'name' => 'Manipur',
                'code' => 'MM',
                'adm1code' => 'IN17',
            ),
            61 => 
            array (
                'id' => 2184,
                'country_id' => 113,
                'name' => 'Meghalaya',
                'code' => 'ML',
                'adm1code' => 'IN18',
            ),
            62 => 
            array (
                'id' => 2185,
                'country_id' => 113,
                'name' => 'Karnataka',
                'code' => 'KA',
                'adm1code' => 'IN19',
            ),
            63 => 
            array (
                'id' => 2186,
                'country_id' => 113,
                'name' => 'Nagaland',
                'code' => 'NL',
                'adm1code' => 'IN20',
            ),
            64 => 
            array (
                'id' => 2187,
                'country_id' => 113,
                'name' => 'Orissa',
                'code' => 'OR',
                'adm1code' => 'IN21',
            ),
            65 => 
            array (
                'id' => 2188,
                'country_id' => 113,
                'name' => 'Pondicherry',
                'code' => 'PY',
                'adm1code' => 'IN22',
            ),
            66 => 
            array (
                'id' => 2189,
                'country_id' => 113,
                'name' => 'Punjab',
                'code' => 'PB',
                'adm1code' => 'IN23',
            ),
            67 => 
            array (
                'id' => 2190,
                'country_id' => 113,
                'name' => 'Rajasthan',
                'code' => 'RJ',
                'adm1code' => 'IN24',
            ),
            68 => 
            array (
                'id' => 2191,
                'country_id' => 113,
                'name' => 'Tamil Nadu',
                'code' => 'TN',
                'adm1code' => 'IN25',
            ),
            69 => 
            array (
                'id' => 2192,
                'country_id' => 113,
                'name' => 'Tripura',
                'code' => 'TR',
                'adm1code' => 'IN26',
            ),
            70 => 
            array (
                'id' => 2193,
                'country_id' => 113,
                'name' => 'Uttar Pradesh',
                'code' => 'UP',
                'adm1code' => 'IN36',
            ),
            71 => 
            array (
                'id' => 2194,
                'country_id' => 113,
                'name' => 'West Bengal',
                'code' => 'WB',
                'adm1code' => 'IN28',
            ),
            72 => 
            array (
                'id' => 2195,
                'country_id' => 113,
                'name' => 'Sikkim',
                'code' => 'SK',
                'adm1code' => 'IN29',
            ),
            73 => 
            array (
                'id' => 2196,
                'country_id' => 113,
                'name' => 'Arunachal Pradesh',
                'code' => 'AR',
                'adm1code' => 'IN30',
            ),
            74 => 
            array (
                'id' => 2197,
                'country_id' => 113,
                'name' => 'Mizoram',
                'code' => 'MZ',
                'adm1code' => 'IN31',
            ),
            75 => 
            array (
                'id' => 2198,
                'country_id' => 113,
                'name' => 'Daman and Diu',
                'code' => 'DD',
                'adm1code' => 'IN32',
            ),
            76 => 
            array (
                'id' => 2199,
                'country_id' => 113,
                'name' => 'Goa',
                'code' => 'GA',
                'adm1code' => 'IN33',
            ),
            77 => 
            array (
                'id' => 2200,
                'country_id' => 115,
                'name' => 'Azarbayjan-e Gharbi',
                'code' => 'WA',
                'adm1code' => 'IR01',
            ),
            78 => 
            array (
                'id' => 2202,
                'country_id' => 115,
                'name' => 'Chahar MaÂ±all va Bakhtiari',
                'code' => 'CM',
                'adm1code' => 'IR03',
            ),
            79 => 
            array (
                'id' => 2203,
                'country_id' => 115,
                'name' => 'Sistan va Baluchestan',
                'code' => 'SB',
                'adm1code' => 'IR04',
            ),
            80 => 
            array (
                'id' => 2204,
                'country_id' => 115,
                'name' => 'Kohgiluyeh va Buyer Ahmad',
                'code' => 'KB',
                'adm1code' => 'IR05',
            ),
            81 => 
            array (
                'id' => 2206,
                'country_id' => 115,
                'name' => 'Fars',
                'code' => 'FA',
                'adm1code' => 'IR07',
            ),
            82 => 
            array (
                'id' => 2207,
                'country_id' => 115,
                'name' => 'Gilan',
                'code' => 'GI',
                'adm1code' => 'IR08',
            ),
            83 => 
            array (
                'id' => 2208,
                'country_id' => 115,
                'name' => 'Hamadan',
                'code' => 'HD',
                'adm1code' => 'IR09',
            ),
            84 => 
            array (
                'id' => 2209,
                'country_id' => 115,
                'name' => 'Ilam',
                'code' => 'IL',
                'adm1code' => 'IR10',
            ),
            85 => 
            array (
                'id' => 2210,
                'country_id' => 115,
                'name' => 'Hormozgan',
                'code' => 'HG',
                'adm1code' => 'IR11',
            ),
            86 => 
            array (
                'id' => 2212,
                'country_id' => 115,
                'name' => 'Kermanshah',
                'code' => 'BK',
                'adm1code' => 'IR13',
            ),
            87 => 
            array (
                'id' => 2213,
                'country_id' => 115,
                'name' => 'Khuzestan',
                'code' => 'KZ',
                'adm1code' => 'IR15',
            ),
            88 => 
            array (
                'id' => 2214,
                'country_id' => 115,
                'name' => 'Kordestan',
                'code' => 'KD',
                'adm1code' => 'IR16',
            ),
            89 => 
            array (
                'id' => 2215,
                'country_id' => 115,
                'name' => 'Mazandaran',
                'code' => 'MN',
                'adm1code' => 'IR35',
            ),
            90 => 
            array (
                'id' => 2219,
                'country_id' => 115,
                'name' => 'Bushehr',
                'code' => 'BS',
                'adm1code' => 'IR22',
            ),
            91 => 
            array (
                'id' => 2220,
                'country_id' => 115,
                'name' => 'Lorestan',
                'code' => 'LO',
                'adm1code' => 'IR23',
            ),
            92 => 
            array (
                'id' => 2221,
                'country_id' => 115,
                'name' => 'Markazi',
                'code' => 'MK',
                'adm1code' => 'IR34',
            ),
            93 => 
            array (
                'id' => 2222,
                'country_id' => 115,
                'name' => 'Semnan',
                'code' => 'SM',
                'adm1code' => 'IR25',
            ),
            94 => 
            array (
                'id' => 2223,
                'country_id' => 115,
                'name' => 'Tehran',
                'code' => 'TH',
                'adm1code' => 'IR26',
            ),
            95 => 
            array (
                'id' => 2224,
                'country_id' => 115,
                'name' => 'Zanjan',
                'code' => 'ZA',
                'adm1code' => 'IR36',
            ),
            96 => 
            array (
                'id' => 2225,
                'country_id' => 115,
                'name' => 'Esfahan',
                'code' => 'ES',
                'adm1code' => 'IR28',
            ),
            97 => 
            array (
                'id' => 2226,
                'country_id' => 115,
                'name' => 'Kerman',
                'code' => 'KE',
                'adm1code' => 'IR29',
            ),
            98 => 
            array (
                'id' => 2227,
                'country_id' => 115,
                'name' => 'Khorasan',
                'code' => 'KR',
                'adm1code' => 'IR30',
            ),
            99 => 
            array (
                'id' => 2228,
                'country_id' => 115,
                'name' => 'Yazd',
                'code' => 'YA',
                'adm1code' => 'IR31',
            ),
            100 => 
            array (
                'id' => 2229,
                'country_id' => 115,
                'name' => 'Ardabil',
                'code' => 'AR',
                'adm1code' => 'IR32',
            ),
            101 => 
            array (
                'id' => 2230,
                'country_id' => 115,
                'name' => 'Azarbayjan-e Sharqi',
                'code' => 'EA',
                'adm1code' => 'IR33',
            ),
            102 => 
            array (
                'id' => 2232,
                'country_id' => 118,
            'name' => 'HaDarom (Southern)',
                'code' => 'HD',
                'adm1code' => 'IS01',
            ),
            103 => 
            array (
                'id' => 2233,
                'country_id' => 118,
            'name' => 'HaMerkaz (Central)',
                'code' => 'HM',
                'adm1code' => 'IS02',
            ),
            104 => 
            array (
                'id' => 2234,
                'country_id' => 118,
            'name' => 'HaÃ»afon  (Northern)',
                'code' => 'HZ',
                'adm1code' => 'IS03',
            ),
            105 => 
            array (
                'id' => 2235,
                'country_id' => 118,
            'name' => 'HÃ­efa  (Haifa)',
                'code' => 'HA',
                'adm1code' => 'IS04',
            ),
            106 => 
            array (
                'id' => 2236,
                'country_id' => 118,
                'name' => 'Tel Aviv',
                'code' => 'TA',
                'adm1code' => 'IS05',
            ),
            107 => 
            array (
                'id' => 2237,
                'country_id' => 118,
            'name' => 'Yerushalayim  (Jerusalem)',
                'code' => 'JM',
                'adm1code' => 'IS06',
            ),
            108 => 
            array (
                'id' => 2238,
                'country_id' => 119,
                'name' => 'Abruzzi',
                'code' => 'AB',
                'adm1code' => 'IT01',
            ),
            109 => 
            array (
                'id' => 2239,
                'country_id' => 119,
                'name' => 'Basilicata',
                'code' => 'BA',
                'adm1code' => 'IT02',
            ),
            110 => 
            array (
                'id' => 2240,
                'country_id' => 119,
                'name' => 'Calabria',
                'code' => 'CA',
                'adm1code' => 'IT03',
            ),
            111 => 
            array (
                'id' => 2241,
                'country_id' => 119,
                'name' => 'Campania',
                'code' => 'CM',
                'adm1code' => 'IT04',
            ),
            112 => 
            array (
                'id' => 2242,
                'country_id' => 119,
                'name' => 'Emilia-Romagna',
                'code' => 'EM',
                'adm1code' => 'IT05',
            ),
            113 => 
            array (
                'id' => 2243,
                'country_id' => 119,
                'name' => 'Friuli-Venezia Giulia',
                'code' => 'FR',
                'adm1code' => 'IT06',
            ),
            114 => 
            array (
                'id' => 2244,
                'country_id' => 119,
                'name' => 'Lazio',
                'code' => 'LA',
                'adm1code' => 'IT07',
            ),
            115 => 
            array (
                'id' => 2245,
                'country_id' => 119,
                'name' => 'Liguria',
                'code' => 'LI',
                'adm1code' => 'IT08',
            ),
            116 => 
            array (
                'id' => 2246,
                'country_id' => 119,
                'name' => 'Lombardia',
                'code' => 'LO',
                'adm1code' => 'IT09',
            ),
            117 => 
            array (
                'id' => 2247,
                'country_id' => 119,
                'name' => 'Marche',
                'code' => 'MA',
                'adm1code' => 'IT10',
            ),
            118 => 
            array (
                'id' => 2248,
                'country_id' => 119,
                'name' => 'Molise',
                'code' => 'MO',
                'adm1code' => 'IT11',
            ),
            119 => 
            array (
                'id' => 2249,
                'country_id' => 119,
                'name' => 'Piemonte',
                'code' => 'PI',
                'adm1code' => 'IT12',
            ),
            120 => 
            array (
                'id' => 2250,
                'country_id' => 119,
                'name' => 'Puglia',
                'code' => 'PU',
                'adm1code' => 'IT13',
            ),
            121 => 
            array (
                'id' => 2251,
                'country_id' => 119,
                'name' => 'Sardegna',
                'code' => 'SA',
                'adm1code' => 'IT14',
            ),
            122 => 
            array (
                'id' => 2252,
                'country_id' => 119,
                'name' => 'Sicilia',
                'code' => 'SI',
                'adm1code' => 'IT15',
            ),
            123 => 
            array (
                'id' => 2253,
                'country_id' => 119,
                'name' => 'Toscana',
                'code' => 'TO',
                'adm1code' => 'IT16',
            ),
            124 => 
            array (
                'id' => 2254,
                'country_id' => 119,
                'name' => 'Trentino-Alto Adige',
                'code' => 'TR',
                'adm1code' => 'IT17',
            ),
            125 => 
            array (
                'id' => 2255,
                'country_id' => 119,
                'name' => 'Umbria',
                'code' => 'UM',
                'adm1code' => 'IT18',
            ),
            126 => 
            array (
                'id' => 2256,
                'country_id' => 119,
                'name' => 'Valle d\'Aosta',
                'code' => 'VA',
                'adm1code' => 'IT19',
            ),
            127 => 
            array (
                'id' => 2257,
                'country_id' => 119,
                'name' => 'Veneto',
                'code' => 'VE',
                'adm1code' => 'IT20',
            ),
            128 => 
            array (
                'id' => 2259,
                'country_id' => 60,
                'name' => 'Dabakala',
                'code' => 'DB',
                'adm1code' => 'IV03',
            ),
            129 => 
            array (
                'id' => 2260,
                'country_id' => 60,
                'name' => 'Aboisso',
                'code' => 'AO',
                'adm1code' => 'IV62',
            ),
            130 => 
            array (
                'id' => 2261,
                'country_id' => 60,
                'name' => 'Adzope',
                'code' => 'AZ',
                'adm1code' => 'IV05',
            ),
            131 => 
            array (
                'id' => 2262,
                'country_id' => 60,
                'name' => 'Agboville',
                'code' => 'AV',
                'adm1code' => 'IV06',
            ),
            132 => 
            array (
                'id' => 2263,
                'country_id' => 60,
                'name' => 'Biankouma',
                'code' => 'BI',
                'adm1code' => 'IV07',
            ),
            133 => 
            array (
                'id' => 2264,
                'country_id' => 60,
                'name' => 'Bouna',
                'code' => 'BO',
                'adm1code' => 'IV11',
            ),
            134 => 
            array (
                'id' => 2265,
                'country_id' => 60,
                'name' => 'Boundiali',
                'code' => 'BL',
                'adm1code' => 'IV12',
            ),
            135 => 
            array (
                'id' => 2266,
                'country_id' => 60,
                'name' => 'Danane',
                'code' => 'DN',
                'adm1code' => 'IV14',
            ),
            136 => 
            array (
                'id' => 2267,
                'country_id' => 60,
                'name' => 'Divo',
                'code' => 'DV',
                'adm1code' => 'IV16',
            ),
            137 => 
            array (
                'id' => 2268,
                'country_id' => 60,
                'name' => 'Ferkessedougou',
                'code' => 'FE',
                'adm1code' => 'IV17',
            ),
            138 => 
            array (
                'id' => 2269,
                'country_id' => 60,
                'name' => 'Gagnoa',
                'code' => 'GA',
                'adm1code' => 'IV18',
            ),
            139 => 
            array (
                'id' => 2270,
                'country_id' => 60,
                'name' => 'Katiola',
                'code' => 'KA',
                'adm1code' => 'IV20',
            ),
            140 => 
            array (
                'id' => 2271,
                'country_id' => 60,
                'name' => 'Korhogo',
                'code' => 'KO',
                'adm1code' => 'IV21',
            ),
            141 => 
            array (
                'id' => 2272,
                'country_id' => 60,
                'name' => 'Odienne',
                'code' => 'OD',
                'adm1code' => 'IV23',
            ),
            142 => 
            array (
                'id' => 2273,
                'country_id' => 60,
                'name' => 'Seguela',
                'code' => 'SE',
                'adm1code' => 'IV25',
            ),
            143 => 
            array (
                'id' => 2274,
                'country_id' => 60,
                'name' => 'Touba',
                'code' => 'TO',
                'adm1code' => 'IV26',
            ),
            144 => 
            array (
                'id' => 2275,
                'country_id' => 60,
                'name' => 'Bongouanou',
                'code' => 'BG',
                'adm1code' => 'IV27',
            ),
            145 => 
            array (
                'id' => 2276,
                'country_id' => 60,
                'name' => 'Issia',
                'code' => 'IS',
                'adm1code' => 'IV28',
            ),
            146 => 
            array (
                'id' => 2277,
                'country_id' => 60,
                'name' => 'Lakota',
                'code' => 'LA',
                'adm1code' => 'IV29',
            ),
            147 => 
            array (
                'id' => 2278,
                'country_id' => 60,
                'name' => 'Mankono',
                'code' => 'MK',
                'adm1code' => 'IV30',
            ),
            148 => 
            array (
                'id' => 2279,
                'country_id' => 60,
                'name' => 'Oume',
                'code' => 'OU',
                'adm1code' => 'IV31',
            ),
            149 => 
            array (
                'id' => 2280,
                'country_id' => 60,
                'name' => 'Soubre',
                'code' => 'SO',
                'adm1code' => 'IV32',
            ),
            150 => 
            array (
                'id' => 2281,
                'country_id' => 60,
                'name' => 'Tingrela',
                'code' => 'TG',
                'adm1code' => 'IV33',
            ),
            151 => 
            array (
                'id' => 2282,
                'country_id' => 60,
                'name' => 'Zuenoula',
                'code' => 'ZU',
                'adm1code' => 'IV34',
            ),
            152 => 
            array (
                'id' => 2283,
                'country_id' => 60,
                'name' => 'Abidjan',
                'code' => 'AB',
                'adm1code' => 'IV61',
            ),
            153 => 
            array (
                'id' => 2284,
                'country_id' => 60,
                'name' => 'Bangolo',
                'code' => 'BA',
                'adm1code' => 'IV36',
            ),
            154 => 
            array (
                'id' => 2285,
                'country_id' => 60,
                'name' => 'Beoumi',
                'code' => 'BE',
                'adm1code' => 'IV37',
            ),
            155 => 
            array (
                'id' => 2286,
                'country_id' => 60,
                'name' => 'Bondoukou',
                'code' => 'BD',
                'adm1code' => 'IV38',
            ),
            156 => 
            array (
                'id' => 2287,
                'country_id' => 60,
                'name' => 'Bouafle',
                'code' => 'BF',
                'adm1code' => 'IV39',
            ),
            157 => 
            array (
                'id' => 2288,
                'country_id' => 60,
                'name' => 'Bouake',
                'code' => 'BK',
                'adm1code' => 'IV40',
            ),
            158 => 
            array (
                'id' => 2289,
                'country_id' => 60,
                'name' => 'Daloa',
                'code' => 'DL',
                'adm1code' => 'IV41',
            ),
            159 => 
            array (
                'id' => 2290,
                'country_id' => 60,
                'name' => 'Daoukro',
                'code' => 'DO',
                'adm1code' => 'IV42',
            ),
            160 => 
            array (
                'id' => 2291,
                'country_id' => 60,
                'name' => 'Dimbokro',
                'code' => 'DI',
                'adm1code' => 'IV67',
            ),
            161 => 
            array (
                'id' => 2292,
                'country_id' => 60,
                'name' => 'Duekoue',
                'code' => 'DU',
                'adm1code' => 'IV44',
            ),
            162 => 
            array (
                'id' => 2293,
                'country_id' => 60,
                'name' => 'Grand-Lahou',
                'code' => 'GL',
                'adm1code' => 'IV45',
            ),
            163 => 
            array (
                'id' => 2294,
                'country_id' => 60,
                'name' => 'Guiglo',
                'code' => 'GU',
                'adm1code' => 'IV69',
            ),
            164 => 
            array (
                'id' => 2295,
                'country_id' => 60,
                'name' => 'Man',
                'code' => 'MA',
                'adm1code' => 'IV47',
            ),
            165 => 
            array (
                'id' => 2296,
                'country_id' => 60,
                'name' => 'Mbahiakro',
                'code' => 'MB',
                'adm1code' => 'IV48',
            ),
            166 => 
            array (
                'id' => 2297,
                'country_id' => 60,
                'name' => 'Sakassou',
                'code' => 'SK',
                'adm1code' => 'IV49',
            ),
            167 => 
            array (
                'id' => 2298,
                'country_id' => 60,
                'name' => 'San Pedro',
                'code' => 'SP',
                'adm1code' => 'IV50',
            ),
            168 => 
            array (
                'id' => 2299,
                'country_id' => 60,
                'name' => 'Sassandra',
                'code' => 'SA',
                'adm1code' => 'IV51',
            ),
            169 => 
            array (
                'id' => 2300,
                'country_id' => 60,
                'name' => 'Sinfra',
                'code' => 'SI',
                'adm1code' => 'IV52',
            ),
            170 => 
            array (
                'id' => 2301,
                'country_id' => 60,
                'name' => 'Tabou',
                'code' => 'TA',
                'adm1code' => 'IV53',
            ),
            171 => 
            array (
                'id' => 2302,
                'country_id' => 60,
                'name' => 'Tanda',
                'code' => 'TD',
                'adm1code' => 'IV54',
            ),
            172 => 
            array (
                'id' => 2303,
                'country_id' => 60,
                'name' => 'Tiassale',
                'code' => 'TI',
                'adm1code' => 'IV55',
            ),
            173 => 
            array (
                'id' => 2304,
                'country_id' => 60,
                'name' => 'Toumodi',
                'code' => 'TM',
                'adm1code' => 'IV56',
            ),
            174 => 
            array (
                'id' => 2305,
                'country_id' => 60,
                'name' => 'Vavoua',
                'code' => 'VA',
                'adm1code' => 'IV57',
            ),
            175 => 
            array (
                'id' => 2306,
                'country_id' => 60,
                'name' => 'Yamoussoukro',
                'code' => 'YA',
                'adm1code' => 'IV73',
            ),
            176 => 
            array (
                'id' => 2307,
                'country_id' => 60,
                'name' => 'Agnilbilekrou',
                'code' => 'AG',
                'adm1code' => 'IV60',
            ),
            177 => 
            array (
                'id' => 2308,
                'country_id' => 116,
                'name' => 'Al Anbar',
                'code' => 'AN',
                'adm1code' => 'IZ01',
            ),
            178 => 
            array (
                'id' => 2309,
                'country_id' => 116,
                'name' => 'Al Basrah',
                'code' => 'BA',
                'adm1code' => 'IZ02',
            ),
            179 => 
            array (
                'id' => 2310,
                'country_id' => 116,
                'name' => 'Al MuthannÂ·',
                'code' => 'MU',
                'adm1code' => 'IZ03',
            ),
            180 => 
            array (
                'id' => 2311,
                'country_id' => 116,
                'name' => 'Al Qadisiyah',
                'code' => 'QA',
                'adm1code' => 'IZ04',
            ),
            181 => 
            array (
                'id' => 2312,
                'country_id' => 116,
                'name' => 'As Sulaymaniyah',
                'code' => 'SU',
                'adm1code' => 'IZ05',
            ),
            182 => 
            array (
                'id' => 2313,
                'country_id' => 116,
                'name' => 'Babil',
                'code' => 'BB',
                'adm1code' => 'IZ06',
            ),
            183 => 
            array (
                'id' => 2314,
                'country_id' => 116,
                'name' => 'Baghdad',
                'code' => 'BG',
                'adm1code' => 'IZ07',
            ),
            184 => 
            array (
                'id' => 2315,
                'country_id' => 116,
                'name' => 'Dahuk',
                'code' => 'DA',
                'adm1code' => 'IZ08',
            ),
            185 => 
            array (
                'id' => 2316,
                'country_id' => 116,
                'name' => 'Dhi Qar',
                'code' => 'DQ',
                'adm1code' => 'IZ09',
            ),
            186 => 
            array (
                'id' => 2317,
                'country_id' => 116,
                'name' => 'Diyala',
                'code' => 'DI',
                'adm1code' => 'IZ10',
            ),
            187 => 
            array (
                'id' => 2318,
                'country_id' => 116,
                'name' => 'Arbil',
                'code' => 'AR',
                'adm1code' => 'IZ11',
            ),
            188 => 
            array (
                'id' => 2319,
                'country_id' => 116,
                'name' => 'Karbala\'',
                'code' => 'KA',
                'adm1code' => 'IZ12',
            ),
            189 => 
            array (
                'id' => 2320,
                'country_id' => 116,
                'name' => 'At Ta\'mim',
                'code' => 'TS',
                'adm1code' => 'IZ13',
            ),
            190 => 
            array (
                'id' => 2321,
                'country_id' => 116,
                'name' => 'Maysan',
                'code' => 'MA',
                'adm1code' => 'IZ14',
            ),
            191 => 
            array (
                'id' => 2322,
                'country_id' => 116,
                'name' => 'Ninawa',
                'code' => 'NI',
                'adm1code' => 'IZ15',
            ),
            192 => 
            array (
                'id' => 2323,
                'country_id' => 116,
                'name' => 'Wasit',
                'code' => 'WA',
                'adm1code' => 'IZ16',
            ),
            193 => 
            array (
                'id' => 2324,
                'country_id' => 116,
                'name' => 'An Najaf',
                'code' => 'NA',
                'adm1code' => 'IZ17',
            ),
            194 => 
            array (
                'id' => 2325,
                'country_id' => 116,
                'name' => 'SÃ±alah ad Din',
                'code' => 'SD',
                'adm1code' => 'IZ18',
            ),
            195 => 
            array (
                'id' => 2326,
                'country_id' => 122,
                'name' => 'Aichi',
                'code' => 'AI',
                'adm1code' => 'JA01',
            ),
            196 => 
            array (
                'id' => 2327,
                'country_id' => 122,
                'name' => 'Akita',
                'code' => 'AK',
                'adm1code' => 'JA02',
            ),
            197 => 
            array (
                'id' => 2328,
                'country_id' => 122,
                'name' => 'Aomori',
                'code' => 'AM',
                'adm1code' => 'JA03',
            ),
            198 => 
            array (
                'id' => 2329,
                'country_id' => 122,
                'name' => 'Chiba',
                'code' => 'CH',
                'adm1code' => 'JA04',
            ),
            199 => 
            array (
                'id' => 2330,
                'country_id' => 122,
                'name' => 'Ehime',
                'code' => 'EH',
                'adm1code' => 'JA05',
            ),
            200 => 
            array (
                'id' => 2331,
                'country_id' => 122,
                'name' => 'Fukui',
                'code' => 'FU',
                'adm1code' => 'JA06',
            ),
            201 => 
            array (
                'id' => 2332,
                'country_id' => 122,
                'name' => 'Fukuoka',
                'code' => 'FK',
                'adm1code' => 'JA07',
            ),
            202 => 
            array (
                'id' => 2333,
                'country_id' => 122,
                'name' => 'Fukushima',
                'code' => 'FS',
                'adm1code' => 'JA08',
            ),
            203 => 
            array (
                'id' => 2334,
                'country_id' => 122,
                'name' => 'Gifu',
                'code' => 'GI',
                'adm1code' => 'JA09',
            ),
            204 => 
            array (
                'id' => 2335,
                'country_id' => 122,
                'name' => 'Gumma',
                'code' => 'GU',
                'adm1code' => 'JA10',
            ),
            205 => 
            array (
                'id' => 2336,
                'country_id' => 122,
                'name' => 'Hiroshima',
                'code' => 'HI',
                'adm1code' => 'JA11',
            ),
            206 => 
            array (
                'id' => 2337,
                'country_id' => 122,
                'name' => 'Hokkaido',
                'code' => 'HO',
                'adm1code' => 'JA12',
            ),
            207 => 
            array (
                'id' => 2338,
                'country_id' => 122,
                'name' => 'Hyogo',
                'code' => 'HY',
                'adm1code' => 'JA13',
            ),
            208 => 
            array (
                'id' => 2339,
                'country_id' => 122,
                'name' => 'Ibaraki',
                'code' => 'IB',
                'adm1code' => 'JA14',
            ),
            209 => 
            array (
                'id' => 2340,
                'country_id' => 122,
                'name' => 'Ishikawa',
                'code' => 'IS',
                'adm1code' => 'JA15',
            ),
            210 => 
            array (
                'id' => 2341,
                'country_id' => 122,
                'name' => 'Iwate',
                'code' => 'IW',
                'adm1code' => 'JA16',
            ),
            211 => 
            array (
                'id' => 2342,
                'country_id' => 122,
                'name' => 'Kagawa',
                'code' => 'KA',
                'adm1code' => 'JA17',
            ),
            212 => 
            array (
                'id' => 2343,
                'country_id' => 122,
                'name' => 'Kagoshima',
                'code' => 'KG',
                'adm1code' => 'JA18',
            ),
            213 => 
            array (
                'id' => 2344,
                'country_id' => 122,
                'name' => 'Kanagawa',
                'code' => 'KN',
                'adm1code' => 'JA19',
            ),
            214 => 
            array (
                'id' => 2345,
                'country_id' => 122,
                'name' => 'Kochi',
                'code' => 'KO',
                'adm1code' => 'JA20',
            ),
            215 => 
            array (
                'id' => 2346,
                'country_id' => 122,
                'name' => 'Kumamoto',
                'code' => 'KU',
                'adm1code' => 'JA21',
            ),
            216 => 
            array (
                'id' => 2347,
                'country_id' => 122,
                'name' => 'Kyoto',
                'code' => 'KY',
                'adm1code' => 'JA22',
            ),
            217 => 
            array (
                'id' => 2348,
                'country_id' => 122,
                'name' => 'Mie',
                'code' => 'MI',
                'adm1code' => 'JA23',
            ),
            218 => 
            array (
                'id' => 2349,
                'country_id' => 122,
                'name' => 'Miyagi',
                'code' => 'MY',
                'adm1code' => 'JA24',
            ),
            219 => 
            array (
                'id' => 2350,
                'country_id' => 122,
                'name' => 'Miyazaki',
                'code' => 'MZ',
                'adm1code' => 'JA25',
            ),
            220 => 
            array (
                'id' => 2351,
                'country_id' => 122,
                'name' => 'Nagano',
                'code' => 'NA',
                'adm1code' => 'JA26',
            ),
            221 => 
            array (
                'id' => 2352,
                'country_id' => 122,
                'name' => 'Nagasaki',
                'code' => 'NG',
                'adm1code' => 'JA27',
            ),
            222 => 
            array (
                'id' => 2353,
                'country_id' => 122,
                'name' => 'Nara',
                'code' => 'NR',
                'adm1code' => 'JA28',
            ),
            223 => 
            array (
                'id' => 2354,
                'country_id' => 122,
                'name' => 'Niigata',
                'code' => 'NI',
                'adm1code' => 'JA29',
            ),
            224 => 
            array (
                'id' => 2355,
                'country_id' => 122,
                'name' => 'Oita',
                'code' => 'OI',
                'adm1code' => 'JA30',
            ),
            225 => 
            array (
                'id' => 2356,
                'country_id' => 122,
                'name' => 'Okayama',
                'code' => 'OK',
                'adm1code' => 'JA31',
            ),
            226 => 
            array (
                'id' => 2357,
                'country_id' => 122,
                'name' => 'Osaka',
                'code' => 'OS',
                'adm1code' => 'JA32',
            ),
            227 => 
            array (
                'id' => 2358,
                'country_id' => 122,
                'name' => 'Saga',
                'code' => 'SA',
                'adm1code' => 'JA33',
            ),
            228 => 
            array (
                'id' => 2359,
                'country_id' => 122,
                'name' => 'Saitama',
                'code' => 'SI',
                'adm1code' => 'JA34',
            ),
            229 => 
            array (
                'id' => 2360,
                'country_id' => 122,
                'name' => 'Shiga',
                'code' => 'SH',
                'adm1code' => 'JA35',
            ),
            230 => 
            array (
                'id' => 2361,
                'country_id' => 122,
                'name' => 'Shimane',
                'code' => 'SM',
                'adm1code' => 'JA36',
            ),
            231 => 
            array (
                'id' => 2362,
                'country_id' => 122,
                'name' => 'Shizuoka',
                'code' => 'SZ',
                'adm1code' => 'JA37',
            ),
            232 => 
            array (
                'id' => 2363,
                'country_id' => 122,
                'name' => 'Tochigi',
                'code' => 'TO',
                'adm1code' => 'JA38',
            ),
            233 => 
            array (
                'id' => 2364,
                'country_id' => 122,
                'name' => 'Tokushima',
                'code' => 'TK',
                'adm1code' => 'JA39',
            ),
            234 => 
            array (
                'id' => 2365,
                'country_id' => 122,
                'name' => 'Tokyo',
                'code' => 'TY',
                'adm1code' => 'JA40',
            ),
            235 => 
            array (
                'id' => 2366,
                'country_id' => 122,
                'name' => 'Tottori',
                'code' => 'TT',
                'adm1code' => 'JA41',
            ),
            236 => 
            array (
                'id' => 2367,
                'country_id' => 122,
                'name' => 'Toyama',
                'code' => 'TA',
                'adm1code' => 'JA42',
            ),
            237 => 
            array (
                'id' => 2368,
                'country_id' => 122,
                'name' => 'Wakayama',
                'code' => 'WA',
                'adm1code' => 'JA43',
            ),
            238 => 
            array (
                'id' => 2369,
                'country_id' => 122,
                'name' => 'Yamagata',
                'code' => 'YA',
                'adm1code' => 'JA44',
            ),
            239 => 
            array (
                'id' => 2370,
                'country_id' => 122,
                'name' => 'Yamaguchi',
                'code' => 'YM',
                'adm1code' => 'JA45',
            ),
            240 => 
            array (
                'id' => 2371,
                'country_id' => 122,
                'name' => 'Yamanashi',
                'code' => 'YN',
                'adm1code' => 'JA46',
            ),
            241 => 
            array (
                'id' => 2372,
                'country_id' => 122,
                'name' => 'Okinawa',
                'code' => 'ON',
                'adm1code' => 'JA47',
            ),
            242 => 
            array (
                'id' => 2373,
                'country_id' => 120,
                'name' => 'Clarendon',
                'code' => 'CL',
                'adm1code' => 'JM01',
            ),
            243 => 
            array (
                'id' => 2374,
                'country_id' => 120,
                'name' => 'Hanover',
                'code' => 'HA',
                'adm1code' => 'JM02',
            ),
            244 => 
            array (
                'id' => 2375,
                'country_id' => 120,
                'name' => 'Manchester',
                'code' => 'MA',
                'adm1code' => 'JM04',
            ),
            245 => 
            array (
                'id' => 2376,
                'country_id' => 120,
                'name' => 'Portland',
                'code' => 'PO',
                'adm1code' => 'JM07',
            ),
            246 => 
            array (
                'id' => 2377,
                'country_id' => 120,
                'name' => 'Saint Andrew',
                'code' => 'SD',
                'adm1code' => 'JM08',
            ),
            247 => 
            array (
                'id' => 2378,
                'country_id' => 120,
                'name' => 'Saint Ann',
                'code' => 'SN',
                'adm1code' => 'JM09',
            ),
            248 => 
            array (
                'id' => 2379,
                'country_id' => 120,
                'name' => 'Saint Catherine',
                'code' => 'SC',
                'adm1code' => 'JM10',
            ),
            249 => 
            array (
                'id' => 2380,
                'country_id' => 120,
                'name' => 'Saint Elizabeth',
                'code' => 'SE',
                'adm1code' => 'JM11',
            ),
            250 => 
            array (
                'id' => 2381,
                'country_id' => 120,
                'name' => 'Saint James',
                'code' => 'SJ',
                'adm1code' => 'JM12',
            ),
            251 => 
            array (
                'id' => 2382,
                'country_id' => 120,
                'name' => 'Saint Mary',
                'code' => 'SM',
                'adm1code' => 'JM13',
            ),
            252 => 
            array (
                'id' => 2383,
                'country_id' => 120,
                'name' => 'Saint Thomas',
                'code' => 'ST',
                'adm1code' => 'JM14',
            ),
            253 => 
            array (
                'id' => 2384,
                'country_id' => 120,
                'name' => 'Trelawny',
                'code' => 'TR',
                'adm1code' => 'JM15',
            ),
            254 => 
            array (
                'id' => 2385,
                'country_id' => 120,
                'name' => 'Westmoreland',
                'code' => 'WE',
                'adm1code' => 'JM16',
            ),
            255 => 
            array (
                'id' => 2386,
                'country_id' => 120,
                'name' => 'Kingston',
                'code' => 'KI',
                'adm1code' => 'JM17',
            ),
            256 => 
            array (
                'id' => 2387,
                'country_id' => 126,
                'name' => 'Al Balqa\'',
                'code' => 'BA',
                'adm1code' => 'JO02',
            ),
            257 => 
            array (
                'id' => 2388,
                'country_id' => 126,
                'name' => 'Ma\'an',
                'code' => 'MN',
                'adm1code' => 'JO19',
            ),
            258 => 
            array (
                'id' => 2389,
                'country_id' => 126,
                'name' => 'Al Karak',
                'code' => 'KA',
                'adm1code' => 'JO09',
            ),
            259 => 
            array (
                'id' => 2390,
                'country_id' => 126,
                'name' => 'Al Mafraq',
                'code' => 'MA',
                'adm1code' => 'JO15',
            ),
            260 => 
            array (
                'id' => 2391,
                'country_id' => 126,
                'name' => '\'Amman',
                'code' => 'AM',
                'adm1code' => 'JO16',
            ),
            261 => 
            array (
                'id' => 2392,
                'country_id' => 126,
                'name' => 'At Tafilah',
                'code' => 'AT',
                'adm1code' => 'JO12',
            ),
            262 => 
            array (
                'id' => 2393,
                'country_id' => 126,
                'name' => 'Az Zaraq',
                'code' => 'AZ',
                'adm1code' => 'JO17',
            ),
            263 => 
            array (
                'id' => 2394,
                'country_id' => 126,
                'name' => 'Irbid',
                'code' => 'IR',
                'adm1code' => 'JO18',
            ),
            264 => 
            array (
                'id' => 2395,
                'country_id' => 129,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'KE01',
            ),
            265 => 
            array (
                'id' => 2396,
                'country_id' => 129,
                'name' => 'Coast',
                'code' => 'CO',
                'adm1code' => 'KE02',
            ),
            266 => 
            array (
                'id' => 2397,
                'country_id' => 129,
                'name' => 'Eastern',
                'code' => 'EA',
                'adm1code' => 'KE03',
            ),
            267 => 
            array (
                'id' => 2398,
                'country_id' => 129,
                'name' => 'Nairobi Area',
                'code' => 'NA',
                'adm1code' => 'KE05',
            ),
            268 => 
            array (
                'id' => 2399,
                'country_id' => 129,
                'name' => 'NorthEastern',
                'code' => 'NE',
                'adm1code' => 'KE06',
            ),
            269 => 
            array (
                'id' => 2400,
                'country_id' => 129,
                'name' => 'Nyanza',
                'code' => 'NY',
                'adm1code' => 'KE07',
            ),
            270 => 
            array (
                'id' => 2401,
                'country_id' => 129,
                'name' => 'Rift Valley',
                'code' => 'RV',
                'adm1code' => 'KE08',
            ),
            271 => 
            array (
                'id' => 2402,
                'country_id' => 129,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'KE09',
            ),
            272 => 
            array (
                'id' => 2403,
                'country_id' => 135,
                'name' => 'Bishkek',
                'code' => 'BI',
                'adm1code' => 'KG01',
            ),
            273 => 
            array (
                'id' => 2404,
                'country_id' => 135,
                'name' => 'Chuy',
                'code' => 'CH',
                'adm1code' => 'KG02',
            ),
            274 => 
            array (
                'id' => 2405,
                'country_id' => 135,
                'name' => 'Jalal-Abad',
                'code' => 'DA',
                'adm1code' => 'KG03',
            ),
            275 => 
            array (
                'id' => 2406,
                'country_id' => 135,
                'name' => 'Naryn',
                'code' => 'NA',
                'adm1code' => 'KG04',
            ),
            276 => 
            array (
                'id' => 2407,
                'country_id' => 135,
                'name' => 'Osh',
                'code' => 'OS',
                'adm1code' => 'KG08',
            ),
            277 => 
            array (
                'id' => 2408,
                'country_id' => 135,
                'name' => 'Talas',
                'code' => 'TL',
                'adm1code' => 'KG06',
            ),
            278 => 
            array (
                'id' => 2409,
                'country_id' => 135,
                'name' => 'Ysyk-Kol',
                'code' => 'YK',
                'adm1code' => 'KG07',
            ),
            279 => 
            array (
                'id' => 2410,
                'country_id' => 132,
                'name' => 'Chagang-do',
                'code' => 'CH',
                'adm1code' => 'KN01',
            ),
            280 => 
            array (
                'id' => 2411,
                'country_id' => 132,
                'name' => 'Hamgyong-namdo',
                'code' => 'HN',
                'adm1code' => 'KN03',
            ),
            281 => 
            array (
                'id' => 2412,
                'country_id' => 132,
                'name' => 'Hwanghae-namdo',
                'code' => 'WN',
                'adm1code' => 'KN06',
            ),
            282 => 
            array (
                'id' => 2413,
                'country_id' => 132,
                'name' => 'Hwanghae-bukto',
                'code' => 'WB',
                'adm1code' => 'KN07',
            ),
            283 => 
            array (
                'id' => 2414,
                'country_id' => 132,
                'name' => 'Kaesong-si',
                'code' => 'KS',
                'adm1code' => 'KN08',
            ),
            284 => 
            array (
                'id' => 2415,
                'country_id' => 132,
                'name' => 'Kangwon-do',
                'code' => 'KW',
                'adm1code' => 'KN09',
            ),
            285 => 
            array (
                'id' => 2416,
                'country_id' => 132,
                'name' => 'P\'yongan-namdo',
                'code' => 'PN',
                'adm1code' => 'KN15',
            ),
            286 => 
            array (
                'id' => 2417,
                'country_id' => 132,
                'name' => 'P\'yongyang-si',
                'code' => 'PY',
                'adm1code' => 'KN12',
            ),
            287 => 
            array (
                'id' => 2418,
                'country_id' => 132,
                'name' => 'Yanggang-do',
                'code' => 'YG',
                'adm1code' => 'KN13',
            ),
            288 => 
            array (
                'id' => 2419,
                'country_id' => 132,
                'name' => 'Namp\'o-si',
                'code' => 'NP',
                'adm1code' => 'KN14',
            ),
            289 => 
            array (
                'id' => 2420,
                'country_id' => 132,
                'name' => 'Hamgyong-bukto',
                'code' => 'HG',
                'adm1code' => 'KN17',
            ),
            290 => 
            array (
                'id' => 2421,
                'country_id' => 131,
                'name' => 'Gilbert Islands',
                'code' => 'GI',
                'adm1code' => 'KR01',
            ),
            291 => 
            array (
                'id' => 2422,
                'country_id' => 131,
                'name' => 'Line Islands',
                'code' => 'LI',
                'adm1code' => 'KR02',
            ),
            292 => 
            array (
                'id' => 2423,
                'country_id' => 131,
                'name' => 'Phoenix Islands',
                'code' => 'PI',
                'adm1code' => 'KR03',
            ),
            293 => 
            array (
                'id' => 2424,
                'country_id' => 133,
                'name' => 'Cheju-do',
                'code' => 'CJ',
                'adm1code' => 'KS01',
            ),
            294 => 
            array (
                'id' => 2425,
                'country_id' => 133,
                'name' => 'Cholla-bukto',
                'code' => 'CB',
                'adm1code' => 'KS03',
            ),
            295 => 
            array (
                'id' => 2426,
                'country_id' => 133,
                'name' => 'Ch\'ungch\'ong-bukto',
                'code' => 'GB',
                'adm1code' => 'KS05',
            ),
            296 => 
            array (
                'id' => 2427,
                'country_id' => 133,
                'name' => 'Kangwon-do',
                'code' => 'KW',
                'adm1code' => 'KS06',
            ),
            297 => 
            array (
                'id' => 2428,
                'country_id' => 133,
                'name' => 'Kyongsang-namdo',
                'code' => 'KN',
                'adm1code' => 'KS20',
            ),
            298 => 
            array (
                'id' => 2429,
                'country_id' => 133,
                'name' => 'Pusan-gwangyoksi',
                'code' => 'PU',
                'adm1code' => 'KS10',
            ),
            299 => 
            array (
                'id' => 2430,
                'country_id' => 133,
                'name' => 'Soul-t\'ukpyolsi',
                'code' => 'SO',
                'adm1code' => 'KS11',
            ),
            300 => 
            array (
                'id' => 2431,
                'country_id' => 133,
                'name' => 'Inch\'on-gwangyoksi',
                'code' => 'IN',
                'adm1code' => 'KS12',
            ),
            301 => 
            array (
                'id' => 2432,
                'country_id' => 133,
                'name' => 'Kyonggi-do',
                'code' => 'KG',
                'adm1code' => 'KS13',
            ),
            302 => 
            array (
                'id' => 2433,
                'country_id' => 133,
                'name' => 'Kyongsang-bukto',
                'code' => 'KB',
                'adm1code' => 'KS14',
            ),
            303 => 
            array (
                'id' => 2434,
                'country_id' => 133,
                'name' => 'Taegu-gwangyoksi',
                'code' => 'TG',
                'adm1code' => 'KS15',
            ),
            304 => 
            array (
                'id' => 2435,
                'country_id' => 133,
                'name' => 'Cholla-namdo',
                'code' => 'CN',
                'adm1code' => 'KS16',
            ),
            305 => 
            array (
                'id' => 2436,
                'country_id' => 133,
                'name' => 'Ch\'ungch\'ong-namdo',
                'code' => 'GN',
                'adm1code' => 'KS17',
            ),
            306 => 
            array (
                'id' => 2437,
                'country_id' => 133,
                'name' => 'Kwangju-gwangyoksi',
                'code' => 'KJ',
                'adm1code' => 'KS18',
            ),
            307 => 
            array (
                'id' => 2438,
                'country_id' => 133,
                'name' => 'Taejon-gwangyoksi',
                'code' => 'TJ',
                'adm1code' => 'KS19',
            ),
            308 => 
            array (
                'id' => 2439,
                'country_id' => 134,
                'name' => 'Al Kuwayt',
                'code' => 'KU',
                'adm1code' => 'KU02',
            ),
            309 => 
            array (
                'id' => 2441,
                'country_id' => 134,
                'name' => 'Hawalli',
                'code' => 'HA',
                'adm1code' => 'KU03',
            ),
            310 => 
            array (
                'id' => 2442,
                'country_id' => 134,
                'name' => 'Al Ahmadi',
                'code' => 'AH',
                'adm1code' => 'KU04',
            ),
            311 => 
            array (
                'id' => 2443,
                'country_id' => 134,
                'name' => 'Al Jahra\'',
                'code' => 'JA',
                'adm1code' => 'KU05',
            ),
            312 => 
            array (
                'id' => 2444,
                'country_id' => 134,
                'name' => 'Al Farwaniyah',
                'code' => 'FA',
                'adm1code' => 'KU06',
            ),
            313 => 
            array (
                'id' => 2445,
                'country_id' => 128,
                'name' => 'Almaty',
                'code' => 'AC',
                'adm1code' => 'KZ02',
            ),
            314 => 
            array (
                'id' => 2446,
                'country_id' => 128,
                'name' => 'Aqmola',
                'code' => 'AM',
                'adm1code' => 'KZ03',
            ),
            315 => 
            array (
                'id' => 2447,
                'country_id' => 128,
                'name' => 'Aqtobe',
                'code' => 'AT',
                'adm1code' => 'KZ04',
            ),
            316 => 
            array (
                'id' => 2448,
                'country_id' => 128,
                'name' => 'Astana',
                'code' => 'AS',
                'adm1code' => 'KZ05',
            ),
            317 => 
            array (
                'id' => 2449,
                'country_id' => 128,
                'name' => 'Atyrau',
                'code' => 'AR',
                'adm1code' => 'KZ06',
            ),
            318 => 
            array (
                'id' => 2450,
                'country_id' => 128,
                'name' => 'Batys Qazaqstan',
                'code' => 'BQ',
                'adm1code' => 'KZ07',
            ),
            319 => 
            array (
                'id' => 2451,
                'country_id' => 128,
                'name' => 'Bayqongyr',
                'code' => 'BY',
                'adm1code' => 'KZ08',
            ),
            320 => 
            array (
                'id' => 2452,
                'country_id' => 128,
                'name' => 'Mangghystau',
                'code' => 'MG',
                'adm1code' => 'KZ09',
            ),
            321 => 
            array (
                'id' => 2453,
                'country_id' => 128,
                'name' => 'Ongtustik Qazaqstan',
                'code' => 'OQ',
                'adm1code' => 'KZ10',
            ),
            322 => 
            array (
                'id' => 2454,
                'country_id' => 128,
                'name' => 'Pavlodar',
                'code' => 'PA',
                'adm1code' => 'KZ11',
            ),
            323 => 
            array (
                'id' => 2455,
                'country_id' => 128,
                'name' => 'Qaraghandy',
                'code' => 'QG',
                'adm1code' => 'KZ12',
            ),
            324 => 
            array (
                'id' => 2456,
                'country_id' => 128,
                'name' => 'Qostanay',
                'code' => 'QS',
                'adm1code' => 'KZ13',
            ),
            325 => 
            array (
                'id' => 2457,
                'country_id' => 128,
                'name' => 'Qyzylorda',
                'code' => 'QO',
                'adm1code' => 'KZ14',
            ),
            326 => 
            array (
                'id' => 2458,
                'country_id' => 128,
                'name' => 'Shyghys Qazaqstan',
                'code' => 'SQ',
                'adm1code' => 'KZ15',
            ),
            327 => 
            array (
                'id' => 2459,
                'country_id' => 128,
                'name' => 'Soltustik Qazaqstan',
                'code' => 'SA',
                'adm1code' => 'KZ16',
            ),
            328 => 
            array (
                'id' => 2460,
                'country_id' => 128,
                'name' => 'Zhambyl',
                'code' => 'ZM',
                'adm1code' => 'KZ17',
            ),
            329 => 
            array (
                'id' => 2464,
                'country_id' => 136,
                'name' => 'Attapu',
                'code' => 'AT',
                'adm1code' => 'LA01',
            ),
            330 => 
            array (
                'id' => 2465,
                'country_id' => 136,
                'name' => 'Champasak',
                'code' => 'CH',
                'adm1code' => 'LA02',
            ),
            331 => 
            array (
                'id' => 2466,
                'country_id' => 136,
                'name' => 'Houaphan',
                'code' => 'HO',
                'adm1code' => 'LA03',
            ),
            332 => 
            array (
                'id' => 2467,
                'country_id' => 136,
                'name' => 'Oudomxai',
                'code' => 'OU',
                'adm1code' => 'LA07',
            ),
            333 => 
            array (
                'id' => 2468,
                'country_id' => 136,
                'name' => 'Xiagnabouli',
                'code' => 'XA',
                'adm1code' => 'LA13',
            ),
            334 => 
            array (
                'id' => 2469,
                'country_id' => 136,
                'name' => 'Xiangkhoang',
                'code' => 'XI',
                'adm1code' => 'LA14',
            ),
            335 => 
            array (
                'id' => 2470,
                'country_id' => 136,
                'name' => 'Khammouan',
                'code' => 'KH',
                'adm1code' => 'LA15',
            ),
            336 => 
            array (
                'id' => 2471,
                'country_id' => 136,
                'name' => 'Louangnamtha',
                'code' => 'LM',
                'adm1code' => 'LA16',
            ),
            337 => 
            array (
                'id' => 2472,
                'country_id' => 136,
                'name' => 'Louangphabang',
                'code' => 'LP',
                'adm1code' => 'LA17',
            ),
            338 => 
            array (
                'id' => 2473,
                'country_id' => 136,
                'name' => 'Phongsali',
                'code' => 'PH',
                'adm1code' => 'LA18',
            ),
            339 => 
            array (
                'id' => 2474,
                'country_id' => 136,
                'name' => 'Salavan',
                'code' => 'SL',
                'adm1code' => 'LA19',
            ),
            340 => 
            array (
                'id' => 2475,
                'country_id' => 136,
                'name' => 'Savannakhet',
                'code' => 'SV',
                'adm1code' => 'LA20',
            ),
            341 => 
            array (
                'id' => 2476,
                'country_id' => 136,
                'name' => 'Bokeo',
                'code' => 'BK',
                'adm1code' => 'LA22',
            ),
            342 => 
            array (
                'id' => 2477,
                'country_id' => 136,
                'name' => 'Bolikhamxai',
                'code' => 'BL',
                'adm1code' => 'LA23',
            ),
            343 => 
            array (
                'id' => 2478,
                'country_id' => 136,
                'name' => 'Viangchan',
                'code' => 'VI',
                'adm1code' => 'LA27',
            ),
            344 => 
            array (
                'id' => 2479,
                'country_id' => 136,
                'name' => 'Xaisomboun',
                'code' => 'XS',
                'adm1code' => 'LA25',
            ),
            345 => 
            array (
                'id' => 2480,
                'country_id' => 136,
                'name' => 'Xekong',
                'code' => 'XE',
                'adm1code' => 'LA26',
            ),
            346 => 
            array (
                'id' => 2481,
                'country_id' => 138,
                'name' => 'Beqaa',
                'code' => 'BI',
                'adm1code' => 'LE01',
            ),
            347 => 
            array (
                'id' => 2482,
                'country_id' => 138,
                'name' => 'Liban-Sud',
                'code' => 'JA',
                'adm1code' => 'LE06',
            ),
            348 => 
            array (
                'id' => 2483,
                'country_id' => 138,
                'name' => 'Liban-Nord',
                'code' => 'AS',
                'adm1code' => 'LE03',
            ),
            349 => 
            array (
                'id' => 2484,
                'country_id' => 138,
                'name' => 'Beyrouth',
                'code' => 'BA',
                'adm1code' => 'LE04',
            ),
            350 => 
            array (
                'id' => 2485,
                'country_id' => 138,
                'name' => 'Mont-Liban',
                'code' => 'JL',
                'adm1code' => 'LE05',
            ),
            351 => 
            array (
                'id' => 2486,
                'country_id' => 137,
                'name' => 'Aizjrayjkes Rajons',
                'code' => 'AI',
                'adm1code' => 'LG01',
            ),
            352 => 
            array (
                'id' => 2487,
                'country_id' => 137,
                'name' => 'Aluksnes Rajons',
                'code' => 'AL',
                'adm1code' => 'LG02',
            ),
            353 => 
            array (
                'id' => 2488,
                'country_id' => 137,
                'name' => 'Balvu Rajons',
                'code' => 'BL',
                'adm1code' => 'LG03',
            ),
            354 => 
            array (
                'id' => 2489,
                'country_id' => 137,
                'name' => 'Bauskas Rajons',
                'code' => 'BU',
                'adm1code' => 'LG04',
            ),
            355 => 
            array (
                'id' => 2490,
                'country_id' => 137,
                'name' => 'Cesu Rajons',
                'code' => 'CE',
                'adm1code' => 'LG05',
            ),
            356 => 
            array (
                'id' => 2491,
                'country_id' => 137,
                'name' => 'Daugavpils',
                'code' => 'DA',
                'adm1code' => 'LG06',
            ),
            357 => 
            array (
                'id' => 2492,
                'country_id' => 137,
                'name' => 'Daugavpils Rajons',
                'code' => 'DU',
                'adm1code' => 'LG07',
            ),
            358 => 
            array (
                'id' => 2493,
                'country_id' => 137,
                'name' => 'Dobeles Rajons',
                'code' => 'DO',
                'adm1code' => 'LG08',
            ),
            359 => 
            array (
                'id' => 2494,
                'country_id' => 137,
                'name' => 'Gulbenes Rajons',
                'code' => 'GU',
                'adm1code' => 'LG09',
            ),
            360 => 
            array (
                'id' => 2495,
                'country_id' => 137,
                'name' => 'Jekabpils Rajons',
                'code' => 'JK',
                'adm1code' => 'LG10',
            ),
            361 => 
            array (
                'id' => 2496,
                'country_id' => 137,
                'name' => 'Jelgava',
                'code' => 'JE',
                'adm1code' => 'LG11',
            ),
            362 => 
            array (
                'id' => 2497,
                'country_id' => 137,
                'name' => 'Jelgavas Rajons',
                'code' => 'JL',
                'adm1code' => 'LG12',
            ),
            363 => 
            array (
                'id' => 2498,
                'country_id' => 137,
                'name' => 'Jurmala',
                'code' => 'JU',
                'adm1code' => 'LG13',
            ),
            364 => 
            array (
                'id' => 2499,
                'country_id' => 137,
                'name' => 'Kraslavas Rajons',
                'code' => 'KR',
                'adm1code' => 'LG14',
            ),
            365 => 
            array (
                'id' => 2500,
                'country_id' => 137,
                'name' => 'Kuldigas Rajons',
                'code' => 'KU',
                'adm1code' => 'LG15',
            ),
            366 => 
            array (
                'id' => 2501,
                'country_id' => 137,
                'name' => 'Liepaja',
                'code' => 'LI',
                'adm1code' => 'LG16',
            ),
            367 => 
            array (
                'id' => 2502,
                'country_id' => 137,
                'name' => 'Liepajas Rajons',
                'code' => 'LE',
                'adm1code' => 'LG17',
            ),
            368 => 
            array (
                'id' => 2503,
                'country_id' => 137,
                'name' => 'Limbazu Rajons',
                'code' => 'LM',
                'adm1code' => 'LG18',
            ),
            369 => 
            array (
                'id' => 2504,
                'country_id' => 137,
                'name' => 'Ludzas Rajons',
                'code' => 'LU',
                'adm1code' => 'LG19',
            ),
            370 => 
            array (
                'id' => 2505,
                'country_id' => 137,
                'name' => 'Madonas Rajons',
                'code' => 'MA',
                'adm1code' => 'LG20',
            ),
            371 => 
            array (
                'id' => 2506,
                'country_id' => 137,
                'name' => 'Ogres Rajons',
                'code' => 'OG',
                'adm1code' => 'LG21',
            ),
            372 => 
            array (
                'id' => 2507,
                'country_id' => 137,
                'name' => 'Preiju Rajons',
                'code' => 'PR',
                'adm1code' => 'LG22',
            ),
            373 => 
            array (
                'id' => 2508,
                'country_id' => 137,
                'name' => 'Rezekne',
                'code' => 'RE',
                'adm1code' => 'LG23',
            ),
            374 => 
            array (
                'id' => 2509,
                'country_id' => 137,
                'name' => 'Rezeknes Rajons',
                'code' => 'RA',
                'adm1code' => 'LG24',
            ),
            375 => 
            array (
                'id' => 2510,
                'country_id' => 137,
                'name' => 'Riga',
                'code' => 'RI',
                'adm1code' => 'LG25',
            ),
            376 => 
            array (
                'id' => 2511,
                'country_id' => 137,
                'name' => 'Rigas Rajons',
                'code' => 'RG',
                'adm1code' => 'LG26',
            ),
            377 => 
            array (
                'id' => 2512,
                'country_id' => 137,
                'name' => 'Saldus Rajons',
                'code' => 'SA',
                'adm1code' => 'LG27',
            ),
            378 => 
            array (
                'id' => 2513,
                'country_id' => 137,
                'name' => 'Talsu Rajons',
                'code' => 'TA',
                'adm1code' => 'LG28',
            ),
            379 => 
            array (
                'id' => 2514,
                'country_id' => 137,
                'name' => 'Tukuma Rajons',
                'code' => 'TU',
                'adm1code' => 'LG29',
            ),
            380 => 
            array (
                'id' => 2515,
                'country_id' => 137,
                'name' => 'Valkas Rajons',
                'code' => 'VK',
                'adm1code' => 'LG30',
            ),
            381 => 
            array (
                'id' => 2516,
                'country_id' => 137,
                'name' => 'Valmieras Rajons',
                'code' => 'VM',
                'adm1code' => 'LG31',
            ),
            382 => 
            array (
                'id' => 2517,
                'country_id' => 137,
                'name' => 'Ventspils',
                'code' => 'VE',
                'adm1code' => 'LG32',
            ),
            383 => 
            array (
                'id' => 2518,
                'country_id' => 137,
                'name' => 'Ventspils Rajons',
                'code' => 'VN',
                'adm1code' => 'LG33',
            ),
            384 => 
            array (
                'id' => 2521,
                'country_id' => 143,
                'name' => 'Alytaus Apskritis',
                'code' => 'AL',
                'adm1code' => 'LH56',
            ),
            385 => 
            array (
                'id' => 2531,
                'country_id' => 143,
                'name' => 'Kauno Apskritis',
                'code' => 'KU',
                'adm1code' => 'LH57',
            ),
            386 => 
            array (
                'id' => 2535,
                'country_id' => 143,
                'name' => 'Klaipedos Apskritis',
                'code' => 'KL',
                'adm1code' => 'LH58',
            ),
            387 => 
            array (
                'id' => 2540,
                'country_id' => 143,
                'name' => 'Marijampoles Apskritis',
                'code' => 'MR',
                'adm1code' => 'LH59',
            ),
            388 => 
            array (
                'id' => 2548,
                'country_id' => 143,
                'name' => 'Panevezio Apskritis',
                'code' => 'PN',
                'adm1code' => 'LH60',
            ),
            389 => 
            array (
                'id' => 2557,
                'country_id' => 143,
                'name' => 'Siauliu Apskritis',
                'code' => 'SA',
                'adm1code' => 'LH61',
            ),
            390 => 
            array (
                'id' => 2564,
                'country_id' => 143,
                'name' => 'Taurages Apskritis',
                'code' => 'TA',
                'adm1code' => 'LH62',
            ),
            391 => 
            array (
                'id' => 2565,
                'country_id' => 143,
                'name' => 'Telsiu Apskritis',
                'code' => 'TE',
                'adm1code' => 'LH63',
            ),
            392 => 
            array (
                'id' => 2568,
                'country_id' => 143,
                'name' => 'Utenos Apskritis',
                'code' => 'UT',
                'adm1code' => 'LH64',
            ),
            393 => 
            array (
                'id' => 2572,
                'country_id' => 143,
                'name' => 'Vilniaus Apskritis',
                'code' => 'VL',
                'adm1code' => 'LH65',
            ),
            394 => 
            array (
                'id' => 2574,
                'country_id' => 140,
                'name' => 'Bong',
                'code' => 'BG',
                'adm1code' => 'LI01',
            ),
            395 => 
            array (
                'id' => 2575,
                'country_id' => 140,
                'name' => 'Grand Gedeh',
                'code' => 'GG',
                'adm1code' => 'LI02',
            ),
            396 => 
            array (
                'id' => 2576,
                'country_id' => 140,
                'name' => 'Lofa',
                'code' => 'LO',
                'adm1code' => 'LI05',
            ),
            397 => 
            array (
                'id' => 2578,
                'country_id' => 140,
                'name' => 'Nimba',
                'code' => 'NI',
                'adm1code' => 'LI09',
            ),
            398 => 
            array (
                'id' => 2579,
                'country_id' => 140,
                'name' => 'Sinoe',
                'code' => 'SI',
                'adm1code' => 'LI10',
            ),
            399 => 
            array (
                'id' => 2580,
                'country_id' => 140,
                'name' => 'Grand Bassa',
                'code' => 'GB',
                'adm1code' => 'LI11',
            ),
            400 => 
            array (
                'id' => 2581,
                'country_id' => 140,
                'name' => 'Grand Cape Mount',
                'code' => 'CM',
                'adm1code' => 'LI12',
            ),
            401 => 
            array (
                'id' => 2582,
                'country_id' => 140,
                'name' => 'Maryland',
                'code' => 'MY',
                'adm1code' => 'LI13',
            ),
            402 => 
            array (
                'id' => 2583,
                'country_id' => 140,
                'name' => 'Montserrado',
                'code' => 'MO',
                'adm1code' => 'LI14',
            ),
            403 => 
            array (
                'id' => 2584,
                'country_id' => 140,
                'name' => 'Bomi',
                'code' => 'BM',
                'adm1code' => 'LI15',
            ),
            404 => 
            array (
                'id' => 2585,
                'country_id' => 140,
                'name' => 'Grand Kru',
                'code' => 'GK',
                'adm1code' => 'LI16',
            ),
            405 => 
            array (
                'id' => 2586,
                'country_id' => 140,
                'name' => 'Margibi',
                'code' => 'MG',
                'adm1code' => 'LI17',
            ),
            406 => 
            array (
                'id' => 2587,
                'country_id' => 140,
                'name' => 'River Cess',
                'code' => 'RI',
                'adm1code' => 'LI18',
            ),
            407 => 
            array (
                'id' => 2588,
                'country_id' => 220,
                'name' => 'Banskobystricky',
                'code' => 'BC',
                'adm1code' => 'LO01',
            ),
            408 => 
            array (
                'id' => 2589,
                'country_id' => 220,
                'name' => 'Bratislavsky',
                'code' => 'BL',
                'adm1code' => 'LO02',
            ),
            409 => 
            array (
                'id' => 2590,
                'country_id' => 220,
                'name' => 'Kosicky',
                'code' => 'KI',
                'adm1code' => 'LO03',
            ),
            410 => 
            array (
                'id' => 2591,
                'country_id' => 220,
                'name' => 'Nitrinsky',
                'code' => 'NI',
                'adm1code' => 'LO04',
            ),
            411 => 
            array (
                'id' => 2592,
                'country_id' => 220,
                'name' => 'Presovsky',
                'code' => 'PV',
                'adm1code' => 'LO05',
            ),
            412 => 
            array (
                'id' => 2593,
                'country_id' => 220,
                'name' => 'Treciansky',
                'code' => 'TC',
                'adm1code' => 'LO06',
            ),
            413 => 
            array (
                'id' => 2594,
                'country_id' => 220,
                'name' => 'Trnavsky',
                'code' => 'TA',
                'adm1code' => 'LO07',
            ),
            414 => 
            array (
                'id' => 2595,
                'country_id' => 220,
                'name' => 'Zilinsky',
                'code' => 'ZI',
                'adm1code' => 'LO08',
            ),
            415 => 
            array (
                'id' => 2596,
                'country_id' => 142,
                'name' => 'Balzers',
                'code' => 'BA',
                'adm1code' => 'LS01',
            ),
            416 => 
            array (
                'id' => 2597,
                'country_id' => 142,
                'name' => 'Eschen',
                'code' => 'ES',
                'adm1code' => 'LS02',
            ),
            417 => 
            array (
                'id' => 2598,
                'country_id' => 142,
                'name' => 'Gamprin',
                'code' => 'GA',
                'adm1code' => 'LS03',
            ),
            418 => 
            array (
                'id' => 2599,
                'country_id' => 142,
                'name' => 'Mauren',
                'code' => 'MA',
                'adm1code' => 'LS04',
            ),
            419 => 
            array (
                'id' => 2600,
                'country_id' => 142,
                'name' => 'Planken',
                'code' => 'PL',
                'adm1code' => 'LS05',
            ),
            420 => 
            array (
                'id' => 2601,
                'country_id' => 142,
                'name' => 'Ruggell',
                'code' => 'RU',
                'adm1code' => 'LS06',
            ),
            421 => 
            array (
                'id' => 2602,
                'country_id' => 142,
                'name' => 'Schaan',
                'code' => 'SN',
                'adm1code' => 'LS07',
            ),
            422 => 
            array (
                'id' => 2603,
                'country_id' => 142,
                'name' => 'Schellenberg',
                'code' => 'SB',
                'adm1code' => 'LS08',
            ),
            423 => 
            array (
                'id' => 2604,
                'country_id' => 142,
                'name' => 'Triesen',
                'code' => 'TN',
                'adm1code' => 'LS09',
            ),
            424 => 
            array (
                'id' => 2605,
                'country_id' => 142,
                'name' => 'Triesenberg',
                'code' => 'TB',
                'adm1code' => 'LS10',
            ),
            425 => 
            array (
                'id' => 2606,
                'country_id' => 142,
                'name' => 'Vaduz',
                'code' => 'VA',
                'adm1code' => 'LS11',
            ),
            426 => 
            array (
                'id' => 2613,
                'country_id' => 139,
                'name' => 'Berea',
                'code' => 'BE',
                'adm1code' => 'LT10',
            ),
            427 => 
            array (
                'id' => 2614,
                'country_id' => 139,
                'name' => 'Butha-Buthe',
                'code' => 'BB',
                'adm1code' => 'LT11',
            ),
            428 => 
            array (
                'id' => 2615,
                'country_id' => 139,
                'name' => 'Leribe',
                'code' => 'LE',
                'adm1code' => 'LT12',
            ),
            429 => 
            array (
                'id' => 2616,
                'country_id' => 139,
                'name' => 'Mafeteng',
                'code' => 'MF',
                'adm1code' => 'LT13',
            ),
            430 => 
            array (
                'id' => 2617,
                'country_id' => 139,
                'name' => 'Maseru',
                'code' => 'MS',
                'adm1code' => 'LT14',
            ),
            431 => 
            array (
                'id' => 2618,
                'country_id' => 139,
                'name' => 'Mohale\'s Hoek',
                'code' => 'MH',
                'adm1code' => 'LT15',
            ),
            432 => 
            array (
                'id' => 2619,
                'country_id' => 139,
                'name' => 'Mokhotlong',
                'code' => 'MK',
                'adm1code' => 'LT16',
            ),
            433 => 
            array (
                'id' => 2620,
                'country_id' => 139,
                'name' => 'Qacha\'s Hoek',
                'code' => 'QN',
                'adm1code' => 'LT17',
            ),
            434 => 
            array (
                'id' => 2621,
                'country_id' => 139,
                'name' => 'Quthing',
                'code' => 'QT',
                'adm1code' => 'LT18',
            ),
            435 => 
            array (
                'id' => 2622,
                'country_id' => 139,
                'name' => 'Thaba-Tseka',
                'code' => 'TT',
                'adm1code' => 'LT19',
            ),
            436 => 
            array (
                'id' => 2623,
                'country_id' => 144,
                'name' => 'Diekirch',
                'code' => 'DI',
                'adm1code' => 'LU01',
            ),
            437 => 
            array (
                'id' => 2624,
                'country_id' => 144,
                'name' => 'Grevenmacher',
                'code' => 'GR',
                'adm1code' => 'LU02',
            ),
            438 => 
            array (
                'id' => 2625,
                'country_id' => 144,
                'name' => 'Luxembourg',
                'code' => 'LU',
                'adm1code' => 'LU03',
            ),
            439 => 
            array (
                'id' => 2627,
                'country_id' => 141,
                'name' => 'Al \'Aziziyah',
                'code' => 'AZ',
                'adm1code' => 'LY03',
            ),
            440 => 
            array (
                'id' => 2629,
                'country_id' => 141,
                'name' => 'Al Jufrah',
                'code' => 'JU',
                'adm1code' => 'LY05',
            ),
            441 => 
            array (
                'id' => 2631,
                'country_id' => 141,
                'name' => 'Al Kufrah',
                'code' => 'KU',
                'adm1code' => 'LY08',
            ),
            442 => 
            array (
                'id' => 2636,
                'country_id' => 141,
                'name' => 'Ash Shati\'',
                'code' => 'SH',
                'adm1code' => 'LY13',
            ),
            443 => 
            array (
                'id' => 2646,
                'country_id' => 141,
                'name' => 'Murzuq',
                'code' => 'MU',
                'adm1code' => 'LY30',
            ),
            444 => 
            array (
                'id' => 2650,
                'country_id' => 141,
                'name' => 'Sabha',
                'code' => 'SB',
                'adm1code' => 'LY34',
            ),
            445 => 
            array (
                'id' => 2655,
                'country_id' => 141,
                'name' => 'Tarhunah',
                'code' => 'TH',
                'adm1code' => 'LY41',
            ),
            446 => 
            array (
                'id' => 2656,
                'country_id' => 141,
                'name' => 'TÃ¶ubruq',
                'code' => 'TU',
                'adm1code' => 'LY42',
            ),
            447 => 
            array (
                'id' => 2658,
                'country_id' => 141,
                'name' => 'Zlitan',
                'code' => 'ZL',
                'adm1code' => 'LY45',
            ),
            448 => 
            array (
                'id' => 2660,
                'country_id' => 141,
                'name' => 'Ajdabiya',
                'code' => 'AJ',
                'adm1code' => 'LY47',
            ),
            449 => 
            array (
                'id' => 2661,
                'country_id' => 141,
                'name' => 'Al Fatih',
                'code' => 'FA',
                'adm1code' => 'LY48',
            ),
            450 => 
            array (
                'id' => 2662,
                'country_id' => 141,
                'name' => 'Al Jabal al Akhdar',
                'code' => 'JA',
                'adm1code' => 'LY49',
            ),
            451 => 
            array (
                'id' => 2663,
                'country_id' => 141,
                'name' => 'Al Khums',
                'code' => 'KH',
                'adm1code' => 'LY50',
            ),
            452 => 
            array (
                'id' => 2664,
                'country_id' => 141,
                'name' => 'An Nuqat al Khams',
                'code' => 'NK',
                'adm1code' => 'LY51',
            ),
            453 => 
            array (
                'id' => 2665,
                'country_id' => 141,
                'name' => 'Awbari',
                'code' => 'AW',
                'adm1code' => 'LY52',
            ),
            454 => 
            array (
                'id' => 2666,
                'country_id' => 141,
                'name' => 'Az Zawiyah',
                'code' => 'ZA',
                'adm1code' => 'LY53',
            ),
            455 => 
            array (
                'id' => 2667,
                'country_id' => 141,
                'name' => 'Banghazi',
                'code' => 'BA',
                'adm1code' => 'LY54',
            ),
            456 => 
            array (
                'id' => 2668,
                'country_id' => 141,
                'name' => 'Darnah',
                'code' => 'DA',
                'adm1code' => 'LY55',
            ),
            457 => 
            array (
                'id' => 2669,
                'country_id' => 141,
                'name' => 'Ghadamis',
                'code' => 'GD',
                'adm1code' => 'LY56',
            ),
            458 => 
            array (
                'id' => 2670,
                'country_id' => 141,
                'name' => 'Gharyan',
                'code' => 'GR',
                'adm1code' => 'LY57',
            ),
            459 => 
            array (
                'id' => 2671,
                'country_id' => 141,
                'name' => 'Misratah',
                'code' => 'MI',
                'adm1code' => 'LY58',
            ),
            460 => 
            array (
                'id' => 2672,
                'country_id' => 141,
                'name' => 'Sawfajjin',
                'code' => 'SF',
                'adm1code' => 'LY59',
            ),
            461 => 
            array (
                'id' => 2673,
                'country_id' => 141,
                'name' => 'Surt',
                'code' => 'SU',
                'adm1code' => 'LY60',
            ),
            462 => 
            array (
                'id' => 2674,
                'country_id' => 141,
                'name' => 'Tarabulus',
                'code' => 'TB',
                'adm1code' => 'LY61',
            ),
            463 => 
            array (
                'id' => 2675,
                'country_id' => 141,
                'name' => 'Yafran',
                'code' => 'YA',
                'adm1code' => 'LY62',
            ),
            464 => 
            array (
                'id' => 2676,
                'country_id' => 147,
                'name' => 'Antsiranana',
                'code' => 'AS',
                'adm1code' => 'MA01',
            ),
            465 => 
            array (
                'id' => 2677,
                'country_id' => 147,
                'name' => 'Fianarantsoa',
                'code' => 'FI',
                'adm1code' => 'MA02',
            ),
            466 => 
            array (
                'id' => 2678,
                'country_id' => 147,
                'name' => 'Mahajanga',
                'code' => 'MA',
                'adm1code' => 'MA03',
            ),
            467 => 
            array (
                'id' => 2679,
                'country_id' => 147,
                'name' => 'Toamasina',
                'code' => 'TM',
                'adm1code' => 'MA04',
            ),
            468 => 
            array (
                'id' => 2680,
                'country_id' => 147,
                'name' => 'Antananarivo',
                'code' => 'AV',
                'adm1code' => 'MA05',
            ),
            469 => 
            array (
                'id' => 2681,
                'country_id' => 147,
                'name' => 'Toliara',
                'code' => 'TL',
                'adm1code' => 'MA06',
            ),
            470 => 
            array (
                'id' => 2682,
                'country_id' => 145,
                'name' => 'Ilhas',
                'code' => 'IL',
                'adm1code' => 'MC01',
            ),
            471 => 
            array (
                'id' => 2683,
                'country_id' => 145,
                'name' => 'Macau',
                'code' => 'MA',
                'adm1code' => 'MC02',
            ),
            472 => 
            array (
                'id' => 2685,
                'country_id' => 163,
                'name' => 'Balti',
                'code' => 'BL',
                'adm1code' => 'MD46',
            ),
            473 => 
            array (
                'id' => 2689,
                'country_id' => 163,
                'name' => 'Cahul',
                'code' => 'CG',
                'adm1code' => 'MD47',
            ),
            474 => 
            array (
                'id' => 2696,
                'country_id' => 163,
                'name' => 'Chisinau',
                'code' => 'CE',
                'adm1code' => 'MD48',
            ),
            475 => 
            array (
                'id' => 2702,
                'country_id' => 163,
                'name' => 'Stinga Nistrului',
                'code' => 'DU',
                'adm1code' => 'MD49',
            ),
            476 => 
            array (
                'id' => 2703,
                'country_id' => 163,
                'name' => 'Edinet',
                'code' => 'ET',
                'adm1code' => 'MD50',
            ),
            477 => 
            array (
                'id' => 2706,
                'country_id' => 163,
                'name' => 'Gagauzia',
                'code' => 'GA',
                'adm1code' => 'MD51',
            ),
            478 => 
            array (
                'id' => 2714,
                'country_id' => 163,
                'name' => 'Orhei',
                'code' => 'OR',
                'adm1code' => 'MD53',
            ),
            479 => 
            array (
                'id' => 2721,
                'country_id' => 163,
                'name' => 'Soroca',
                'code' => 'SR',
                'adm1code' => 'MD54',
            ),
            480 => 
            array (
                'id' => 2727,
                'country_id' => 163,
                'name' => 'Ungheni',
                'code' => 'UN',
                'adm1code' => 'MD56',
            ),
            481 => 
            array (
                'id' => 2729,
                'country_id' => 165,
                'name' => 'Arhangay',
                'code' => 'AR',
                'adm1code' => 'MG01',
            ),
            482 => 
            array (
                'id' => 2730,
                'country_id' => 165,
                'name' => 'Bayanhongor',
                'code' => 'BH',
                'adm1code' => 'MG02',
            ),
            483 => 
            array (
                'id' => 2731,
                'country_id' => 165,
                'name' => 'Bayan-Olgiy',
                'code' => 'BO',
                'adm1code' => 'MG03',
            ),
            484 => 
            array (
                'id' => 2734,
                'country_id' => 165,
                'name' => 'Dornogovi',
                'code' => 'DG',
                'adm1code' => 'MG07',
            ),
            485 => 
            array (
                'id' => 2735,
                'country_id' => 165,
                'name' => 'Dundgovi',
                'code' => 'DU',
                'adm1code' => 'MG08',
            ),
            486 => 
            array (
                'id' => 2736,
                'country_id' => 165,
                'name' => 'Dzavhan',
                'code' => 'DZ',
                'adm1code' => 'MG09',
            ),
            487 => 
            array (
                'id' => 2737,
                'country_id' => 165,
                'name' => 'Govi-Altay',
                'code' => 'GA',
                'adm1code' => 'MG10',
            ),
            488 => 
            array (
                'id' => 2738,
                'country_id' => 165,
                'name' => 'Hentiy',
                'code' => 'HN',
                'adm1code' => 'MG11',
            ),
            489 => 
            array (
                'id' => 2739,
                'country_id' => 165,
                'name' => 'Omnogovi',
                'code' => 'OG',
                'adm1code' => 'MG14',
            ),
            490 => 
            array (
                'id' => 2740,
                'country_id' => 165,
                'name' => 'Ovorhangay',
                'code' => 'OH',
                'adm1code' => 'MG15',
            ),
            491 => 
            array (
                'id' => 2741,
                'country_id' => 165,
                'name' => 'Ulaanbaatar',
                'code' => 'UB',
                'adm1code' => 'MG20',
            ),
            492 => 
            array (
                'id' => 2742,
                'country_id' => 165,
                'name' => 'Orhon',
                'code' => 'ER',
                'adm1code' => 'MG25',
            ),
            493 => 
            array (
                'id' => 2743,
                'country_id' => 167,
                'name' => 'Saint Anthony',
                'code' => 'SA',
                'adm1code' => 'MH01',
            ),
            494 => 
            array (
                'id' => 2744,
                'country_id' => 167,
                'name' => 'Saint Georges',
                'code' => 'SG',
                'adm1code' => 'MH02',
            ),
            495 => 
            array (
                'id' => 2745,
                'country_id' => 167,
                'name' => 'Saint Peter',
                'code' => 'SP',
                'adm1code' => 'MH03',
            ),
            496 => 
            array (
                'id' => 2746,
                'country_id' => 148,
                'name' => 'Chikwawa',
                'code' => 'CK',
                'adm1code' => 'MI02',
            ),
            497 => 
            array (
                'id' => 2747,
                'country_id' => 148,
                'name' => 'Chiradzulu',
                'code' => 'CR',
                'adm1code' => 'MI03',
            ),
            498 => 
            array (
                'id' => 2748,
                'country_id' => 148,
                'name' => 'Chitipa',
                'code' => 'CT',
                'adm1code' => 'MI04',
            ),
            499 => 
            array (
                'id' => 2749,
                'country_id' => 148,
                'name' => 'Thyolo',
                'code' => 'TH',
                'adm1code' => 'MI05',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 2750,
                'country_id' => 148,
                'name' => 'Dedza',
                'code' => 'DE',
                'adm1code' => 'MI06',
            ),
            1 => 
            array (
                'id' => 2751,
                'country_id' => 148,
                'name' => 'Dowa',
                'code' => 'DO',
                'adm1code' => 'MI07',
            ),
            2 => 
            array (
                'id' => 2752,
                'country_id' => 148,
                'name' => 'Karonga',
                'code' => 'KR',
                'adm1code' => 'MI08',
            ),
            3 => 
            array (
                'id' => 2753,
                'country_id' => 148,
                'name' => 'Kasungu',
                'code' => 'KS',
                'adm1code' => 'MI09',
            ),
            4 => 
            array (
                'id' => 2754,
                'country_id' => 148,
            'name' => 'Machinga (Kasupe)',
                'code' => 'MA',
                'adm1code' => 'MI10',
            ),
            5 => 
            array (
                'id' => 2755,
                'country_id' => 148,
                'name' => 'Lilongwe',
                'code' => 'LI',
                'adm1code' => 'MI11',
            ),
            6 => 
            array (
                'id' => 2756,
                'country_id' => 148,
            'name' => 'Mangochi (Fort Johnston)',
                'code' => 'MG',
                'adm1code' => 'MI12',
            ),
            7 => 
            array (
                'id' => 2757,
                'country_id' => 148,
                'name' => 'Mchinji',
                'code' => 'MC',
                'adm1code' => 'MI13',
            ),
            8 => 
            array (
                'id' => 2758,
                'country_id' => 148,
            'name' => 'Mulanje (Mlange)',
                'code' => 'MJ',
                'adm1code' => 'MI14',
            ),
            9 => 
            array (
                'id' => 2759,
                'country_id' => 148,
                'name' => 'Mzimba',
                'code' => 'MZ',
                'adm1code' => 'MI15',
            ),
            10 => 
            array (
                'id' => 2760,
                'country_id' => 148,
                'name' => 'Ntcheu',
                'code' => 'NU',
                'adm1code' => 'MI16',
            ),
            11 => 
            array (
                'id' => 2761,
                'country_id' => 148,
                'name' => 'Nkhata Bay',
                'code' => 'NA',
                'adm1code' => 'MI17',
            ),
            12 => 
            array (
                'id' => 2762,
                'country_id' => 148,
                'name' => 'Nkhotakota',
                'code' => 'NK',
                'adm1code' => 'MI18',
            ),
            13 => 
            array (
                'id' => 2763,
                'country_id' => 148,
                'name' => 'Nsanje',
                'code' => 'NS',
                'adm1code' => 'MI19',
            ),
            14 => 
            array (
                'id' => 2764,
                'country_id' => 148,
            'name' => 'Ntchisi (Nchisi)',
                'code' => 'NI',
                'adm1code' => 'MI20',
            ),
            15 => 
            array (
                'id' => 2765,
                'country_id' => 148,
            'name' => 'Rumphi (Rumpil)',
                'code' => 'RU',
                'adm1code' => 'MI21',
            ),
            16 => 
            array (
                'id' => 2766,
                'country_id' => 148,
                'name' => 'Salima',
                'code' => 'SA',
                'adm1code' => 'MI22',
            ),
            17 => 
            array (
                'id' => 2767,
                'country_id' => 148,
                'name' => 'Zomba',
                'code' => 'ZO',
                'adm1code' => 'MI23',
            ),
            18 => 
            array (
                'id' => 2768,
                'country_id' => 148,
                'name' => 'Blantyre',
                'code' => 'BL',
                'adm1code' => 'MI24',
            ),
            19 => 
            array (
                'id' => 2769,
                'country_id' => 148,
                'name' => 'Mwanza',
                'code' => 'MN',
                'adm1code' => 'MI25',
            ),
            20 => 
            array (
                'id' => 2770,
                'country_id' => 151,
                'name' => 'Bamako',
                'code' => 'BA',
                'adm1code' => 'ML01',
            ),
            21 => 
            array (
                'id' => 2771,
                'country_id' => 151,
                'name' => 'Gao',
                'code' => 'GA',
                'adm1code' => 'ML02',
            ),
            22 => 
            array (
                'id' => 2772,
                'country_id' => 151,
                'name' => 'Kayes',
                'code' => 'KY',
                'adm1code' => 'ML03',
            ),
            23 => 
            array (
                'id' => 2773,
                'country_id' => 151,
                'name' => 'Mopti',
                'code' => 'MO',
                'adm1code' => 'ML04',
            ),
            24 => 
            array (
                'id' => 2774,
                'country_id' => 151,
                'name' => 'Segou',
                'code' => 'SG',
                'adm1code' => 'ML05',
            ),
            25 => 
            array (
                'id' => 2775,
                'country_id' => 151,
                'name' => 'Sikasso',
                'code' => 'SK',
                'adm1code' => 'ML06',
            ),
            26 => 
            array (
                'id' => 2776,
                'country_id' => 151,
                'name' => 'Koulikoro',
                'code' => 'KK',
                'adm1code' => 'ML07',
            ),
            27 => 
            array (
                'id' => 2777,
                'country_id' => 151,
                'name' => 'Tombouctou',
                'code' => 'TB',
                'adm1code' => 'ML08',
            ),
            28 => 
            array (
                'id' => 2781,
                'country_id' => 168,
                'name' => 'Agadir',
                'code' => 'AG',
                'adm1code' => 'MO01',
            ),
            29 => 
            array (
                'id' => 2782,
                'country_id' => 168,
                'name' => 'Al HoceÃ”ma',
                'code' => 'AH',
                'adm1code' => 'MO02',
            ),
            30 => 
            array (
                'id' => 2783,
                'country_id' => 168,
                'name' => 'Azilal',
                'code' => 'AZ',
                'adm1code' => 'MO03',
            ),
            31 => 
            array (
                'id' => 2784,
                'country_id' => 168,
                'name' => 'Ben Slimane',
                'code' => 'BS',
                'adm1code' => 'MO04',
            ),
            32 => 
            array (
                'id' => 2785,
                'country_id' => 168,
                'name' => 'Beni Mellal',
                'code' => 'BM',
                'adm1code' => 'MO05',
            ),
            33 => 
            array (
                'id' => 2786,
                'country_id' => 168,
                'name' => 'Boulemane',
                'code' => 'BO',
                'adm1code' => 'MO06',
            ),
            34 => 
            array (
                'id' => 2787,
                'country_id' => 168,
                'name' => 'Casablanca',
                'code' => 'CA',
                'adm1code' => 'MO07',
            ),
            35 => 
            array (
                'id' => 2788,
                'country_id' => 168,
                'name' => 'Chaouen',
                'code' => 'CH',
                'adm1code' => 'MO08',
            ),
            36 => 
            array (
                'id' => 2789,
                'country_id' => 168,
                'name' => 'El Jadida',
                'code' => 'EJ',
                'adm1code' => 'MO09',
            ),
            37 => 
            array (
                'id' => 2790,
                'country_id' => 168,
                'name' => 'El Kelaa des Sraghna',
                'code' => 'EK',
                'adm1code' => 'MO10',
            ),
            38 => 
            array (
                'id' => 2791,
                'country_id' => 168,
                'name' => 'Er Rachidia',
                'code' => 'ER',
                'adm1code' => 'MO11',
            ),
            39 => 
            array (
                'id' => 2792,
                'country_id' => 168,
                'name' => 'Essaouira',
                'code' => 'ES',
                'adm1code' => 'MO12',
            ),
            40 => 
            array (
                'id' => 2793,
                'country_id' => 168,
                'name' => 'Fes',
                'code' => 'FE',
                'adm1code' => 'MO13',
            ),
            41 => 
            array (
                'id' => 2794,
                'country_id' => 168,
                'name' => 'Figuig',
                'code' => 'FI',
                'adm1code' => 'MO14',
            ),
            42 => 
            array (
                'id' => 2795,
                'country_id' => 168,
                'name' => 'Kenitra',
                'code' => 'KE',
                'adm1code' => 'MO15',
            ),
            43 => 
            array (
                'id' => 2796,
                'country_id' => 168,
                'name' => 'Khemisset',
                'code' => 'KH',
                'adm1code' => 'MO16',
            ),
            44 => 
            array (
                'id' => 2797,
                'country_id' => 168,
                'name' => 'Khenifra',
                'code' => 'KN',
                'adm1code' => 'MO17',
            ),
            45 => 
            array (
                'id' => 2798,
                'country_id' => 168,
                'name' => 'Khouribga',
                'code' => 'KO',
                'adm1code' => 'MO18',
            ),
            46 => 
            array (
                'id' => 2799,
                'country_id' => 168,
                'name' => 'Marrakech',
                'code' => 'MR',
                'adm1code' => 'MO19',
            ),
            47 => 
            array (
                'id' => 2800,
                'country_id' => 168,
                'name' => 'Meknes',
                'code' => 'ME',
                'adm1code' => 'MO20',
            ),
            48 => 
            array (
                'id' => 2801,
                'country_id' => 168,
                'name' => 'Nador',
                'code' => 'NA',
                'adm1code' => 'MO21',
            ),
            49 => 
            array (
                'id' => 2802,
                'country_id' => 168,
                'name' => 'Ouarzazate',
                'code' => 'OU',
                'adm1code' => 'MO22',
            ),
            50 => 
            array (
                'id' => 2803,
                'country_id' => 168,
                'name' => 'Oujda',
                'code' => 'OJ',
                'adm1code' => 'MO23',
            ),
            51 => 
            array (
                'id' => 2804,
                'country_id' => 168,
                'name' => 'Rabat-Sale',
                'code' => 'RA',
                'adm1code' => 'MO24',
            ),
            52 => 
            array (
                'id' => 2805,
                'country_id' => 168,
                'name' => 'Safi',
                'code' => 'SA',
                'adm1code' => 'MO25',
            ),
            53 => 
            array (
                'id' => 2806,
                'country_id' => 168,
                'name' => 'Settat',
                'code' => 'SE',
                'adm1code' => 'MO26',
            ),
            54 => 
            array (
                'id' => 2807,
                'country_id' => 168,
                'name' => 'Tanger',
                'code' => 'TG',
                'adm1code' => 'MO27',
            ),
            55 => 
            array (
                'id' => 2808,
                'country_id' => 168,
                'name' => 'Tata',
                'code' => 'TT',
                'adm1code' => 'MO29',
            ),
            56 => 
            array (
                'id' => 2809,
                'country_id' => 168,
                'name' => 'Taza',
                'code' => 'TZ',
                'adm1code' => 'MO30',
            ),
            57 => 
            array (
                'id' => 2810,
                'country_id' => 168,
                'name' => 'Tiznit',
                'code' => 'TI',
                'adm1code' => 'MO32',
            ),
            58 => 
            array (
                'id' => 2811,
                'country_id' => 168,
                'name' => 'Guelmim',
                'code' => 'GU',
                'adm1code' => 'MO42',
            ),
            59 => 
            array (
                'id' => 2812,
                'country_id' => 168,
                'name' => 'Ifrane',
                'code' => 'IF',
                'adm1code' => 'MO34',
            ),
            60 => 
            array (
                'id' => 2813,
                'country_id' => 168,
                'name' => 'Laayoune',
                'code' => 'LA',
                'adm1code' => 'MO35',
            ),
            61 => 
            array (
                'id' => 2814,
                'country_id' => 168,
                'name' => 'Tan-Tan',
                'code' => 'TN',
                'adm1code' => 'MO36',
            ),
            62 => 
            array (
                'id' => 2815,
                'country_id' => 168,
                'name' => 'Taounate',
                'code' => 'TO',
                'adm1code' => 'MO37',
            ),
            63 => 
            array (
                'id' => 2816,
                'country_id' => 168,
                'name' => 'Sidi Kacem',
                'code' => 'SK',
                'adm1code' => 'MO38',
            ),
            64 => 
            array (
                'id' => 2817,
                'country_id' => 168,
                'name' => 'Taroudannt',
                'code' => 'TA',
                'adm1code' => 'MO39',
            ),
            65 => 
            array (
                'id' => 2818,
                'country_id' => 168,
                'name' => 'Tetouan',
                'code' => 'TE',
                'adm1code' => 'MO40',
            ),
            66 => 
            array (
                'id' => 2819,
                'country_id' => 168,
                'name' => 'Larache',
                'code' => 'LR',
                'adm1code' => 'MO41',
            ),
            67 => 
            array (
                'id' => 2820,
                'country_id' => 168,
                'name' => 'Assa-Zag',
                'code' => 'AS',
                'adm1code' => 'MO43',
            ),
            68 => 
            array (
                'id' => 2821,
                'country_id' => 168,
                'name' => 'Es Smara',
                'code' => 'EM',
                'adm1code' => 'MO44',
            ),
            69 => 
            array (
                'id' => 2822,
                'country_id' => 157,
                'name' => 'Black River',
                'code' => 'BL',
                'adm1code' => 'MP12',
            ),
            70 => 
            array (
                'id' => 2823,
                'country_id' => 157,
                'name' => 'Flacq',
                'code' => 'FL',
                'adm1code' => 'MP13',
            ),
            71 => 
            array (
                'id' => 2824,
                'country_id' => 157,
                'name' => 'Grand Port',
                'code' => 'GP',
                'adm1code' => 'MP14',
            ),
            72 => 
            array (
                'id' => 2825,
                'country_id' => 157,
                'name' => 'Moka',
                'code' => 'MO',
                'adm1code' => 'MP15',
            ),
            73 => 
            array (
                'id' => 2826,
                'country_id' => 157,
                'name' => 'Pamplemousses',
                'code' => 'PA',
                'adm1code' => 'MP16',
            ),
            74 => 
            array (
                'id' => 2827,
                'country_id' => 157,
                'name' => 'Plaines Wilhems',
                'code' => 'PW',
                'adm1code' => 'MP17',
            ),
            75 => 
            array (
                'id' => 2828,
                'country_id' => 157,
                'name' => 'Port Louis',
                'code' => 'PL',
                'adm1code' => 'MP18',
            ),
            76 => 
            array (
                'id' => 2829,
                'country_id' => 157,
                'name' => 'RiviÃ‹re du Rempart',
                'code' => 'RR',
                'adm1code' => 'MP19',
            ),
            77 => 
            array (
                'id' => 2830,
                'country_id' => 157,
                'name' => 'Savanne',
                'code' => 'SA',
                'adm1code' => 'MP20',
            ),
            78 => 
            array (
                'id' => 2831,
                'country_id' => 157,
                'name' => 'Agalega Islands',
                'code' => 'AG',
                'adm1code' => 'MP21',
            ),
            79 => 
            array (
                'id' => 2832,
                'country_id' => 157,
                'name' => 'Cargados Carajos',
                'code' => 'CC',
                'adm1code' => 'MP22',
            ),
            80 => 
            array (
                'id' => 2833,
                'country_id' => 157,
                'name' => 'Rodrigues',
                'code' => 'RO',
                'adm1code' => 'MP23',
            ),
            81 => 
            array (
                'id' => 2834,
                'country_id' => 156,
                'name' => 'Hodh Ech Chargui',
                'code' => 'HC',
                'adm1code' => 'MR01',
            ),
            82 => 
            array (
                'id' => 2835,
                'country_id' => 156,
                'name' => 'Hodh El Gharbi',
                'code' => 'HG',
                'adm1code' => 'MR02',
            ),
            83 => 
            array (
                'id' => 2836,
                'country_id' => 156,
                'name' => 'Assaba',
                'code' => 'AS',
                'adm1code' => 'MR03',
            ),
            84 => 
            array (
                'id' => 2837,
                'country_id' => 156,
                'name' => 'Gorgol',
                'code' => 'GO',
                'adm1code' => 'MR04',
            ),
            85 => 
            array (
                'id' => 2838,
                'country_id' => 156,
                'name' => 'Brakna',
                'code' => 'BR',
                'adm1code' => 'MR05',
            ),
            86 => 
            array (
                'id' => 2839,
                'country_id' => 156,
                'name' => 'Trarza',
                'code' => 'TR',
                'adm1code' => 'MR06',
            ),
            87 => 
            array (
                'id' => 2840,
                'country_id' => 156,
                'name' => 'Adrar',
                'code' => 'AD',
                'adm1code' => 'MR07',
            ),
            88 => 
            array (
                'id' => 2841,
                'country_id' => 156,
                'name' => 'Dakhlet Nouadhibou',
                'code' => 'DN',
                'adm1code' => 'MR08',
            ),
            89 => 
            array (
                'id' => 2842,
                'country_id' => 156,
                'name' => 'Tagant',
                'code' => 'TG',
                'adm1code' => 'MR09',
            ),
            90 => 
            array (
                'id' => 2843,
                'country_id' => 156,
                'name' => 'Guidimaka',
                'code' => 'GD',
                'adm1code' => 'MR10',
            ),
            91 => 
            array (
                'id' => 2844,
                'country_id' => 156,
                'name' => 'Tiris Zemmour',
                'code' => 'TZ',
                'adm1code' => 'MR11',
            ),
            92 => 
            array (
                'id' => 2845,
                'country_id' => 156,
                'name' => 'Inchiri',
                'code' => 'IN',
                'adm1code' => 'MR12',
            ),
            93 => 
            array (
                'id' => 2846,
                'country_id' => 186,
                'name' => 'Ad Dakhiliyah',
                'code' => 'DA',
                'adm1code' => 'MU01',
            ),
            94 => 
            array (
                'id' => 2847,
                'country_id' => 186,
                'name' => 'Al Batinah',
                'code' => 'BA',
                'adm1code' => 'MU02',
            ),
            95 => 
            array (
                'id' => 2848,
                'country_id' => 186,
                'name' => 'Al Wusta',
                'code' => 'WU',
                'adm1code' => 'MU03',
            ),
            96 => 
            array (
                'id' => 2849,
                'country_id' => 186,
                'name' => 'Ash Sharqiyah',
                'code' => 'SH',
                'adm1code' => 'MU04',
            ),
            97 => 
            array (
                'id' => 2850,
                'country_id' => 186,
                'name' => 'Az Zahirah',
                'code' => 'ZA',
                'adm1code' => 'MU05',
            ),
            98 => 
            array (
                'id' => 2851,
                'country_id' => 186,
                'name' => 'Masqat',
                'code' => 'MA',
                'adm1code' => 'MU06',
            ),
            99 => 
            array (
                'id' => 2852,
                'country_id' => 186,
                'name' => 'Musandam',
                'code' => 'MU',
                'adm1code' => 'MU07',
            ),
            100 => 
            array (
                'id' => 2853,
                'country_id' => 186,
                'name' => 'Zufar',
                'code' => 'JA',
                'adm1code' => 'MU08',
            ),
            101 => 
            array (
                'id' => 2854,
                'country_id' => 150,
                'name' => 'Seenu',
                'code' => 'SE',
                'adm1code' => 'MV01',
            ),
            102 => 
            array (
                'id' => 2858,
                'country_id' => 150,
                'name' => 'Laamu',
                'code' => 'LM',
                'adm1code' => 'MV05',
            ),
            103 => 
            array (
                'id' => 2860,
                'country_id' => 150,
                'name' => 'Thaa',
                'code' => 'TH',
                'adm1code' => 'MV46',
            ),
            104 => 
            array (
                'id' => 2862,
                'country_id' => 150,
                'name' => 'Raa',
                'code' => 'RA',
                'adm1code' => 'MV44',
            ),
            105 => 
            array (
                'id' => 2865,
                'country_id' => 150,
                'name' => 'Baa',
                'code' => 'BA',
                'adm1code' => 'MV31',
            ),
            106 => 
            array (
                'id' => 2867,
                'country_id' => 150,
                'name' => 'Shaviyani',
                'code' => 'SH',
                'adm1code' => 'MV45',
            ),
            107 => 
            array (
                'id' => 2868,
                'country_id' => 150,
                'name' => 'Noonu',
                'code' => 'NO',
                'adm1code' => 'MV43',
            ),
            108 => 
            array (
                'id' => 2869,
                'country_id' => 150,
                'name' => 'Kaafu',
                'code' => 'KA',
                'adm1code' => 'MV38',
            ),
            109 => 
            array (
                'id' => 2873,
                'country_id' => 150,
                'name' => 'Alifu',
                'code' => 'AA',
                'adm1code' => 'MV30',
            ),
            110 => 
            array (
                'id' => 2874,
                'country_id' => 150,
                'name' => 'Dhaalu',
                'code' => 'DA',
                'adm1code' => 'MV32',
            ),
            111 => 
            array (
                'id' => 2875,
                'country_id' => 150,
                'name' => 'Faafa',
                'code' => 'FA',
                'adm1code' => 'MV33',
            ),
            112 => 
            array (
                'id' => 2876,
                'country_id' => 150,
                'name' => 'Gaafu Alifu',
                'code' => 'GA',
                'adm1code' => 'MV34',
            ),
            113 => 
            array (
                'id' => 2877,
                'country_id' => 150,
                'name' => 'Gaafu Dhaalu',
                'code' => 'GD',
                'adm1code' => 'MV35',
            ),
            114 => 
            array (
                'id' => 2878,
                'country_id' => 150,
                'name' => 'Haa Alifu',
                'code' => 'HA',
                'adm1code' => 'MV36',
            ),
            115 => 
            array (
                'id' => 2879,
                'country_id' => 150,
                'name' => 'Haa Dhaalu',
                'code' => 'HD',
                'adm1code' => 'MV37',
            ),
            116 => 
            array (
                'id' => 2880,
                'country_id' => 150,
                'name' => 'Lhaviyani',
                'code' => 'LV',
                'adm1code' => 'MV39',
            ),
            117 => 
            array (
                'id' => 2881,
                'country_id' => 150,
                'name' => 'Maale',
                'code' => 'MA',
                'adm1code' => 'MV40',
            ),
            118 => 
            array (
                'id' => 2882,
                'country_id' => 150,
                'name' => 'Meenu',
                'code' => 'ME',
                'adm1code' => 'MV41',
            ),
            119 => 
            array (
                'id' => 2883,
                'country_id' => 150,
                'name' => 'Gnaviyani',
                'code' => 'NA',
                'adm1code' => 'MV42',
            ),
            120 => 
            array (
                'id' => 2884,
                'country_id' => 150,
                'name' => 'Vaavu',
                'code' => 'WA',
                'adm1code' => 'MV47',
            ),
            121 => 
            array (
                'id' => 2885,
                'country_id' => 159,
                'name' => 'Aguascalientes',
                'code' => 'AG',
                'adm1code' => 'MX01',
            ),
            122 => 
            array (
                'id' => 2886,
                'country_id' => 159,
                'name' => 'Campeche',
                'code' => 'CM',
                'adm1code' => 'MX04',
            ),
            123 => 
            array (
                'id' => 2887,
                'country_id' => 159,
                'name' => 'Coahuila de Zaragoza',
                'code' => 'CA',
                'adm1code' => 'MX07',
            ),
            124 => 
            array (
                'id' => 2888,
                'country_id' => 159,
                'name' => 'Distrito Federal',
                'code' => 'DF',
                'adm1code' => 'MX09',
            ),
            125 => 
            array (
                'id' => 2889,
                'country_id' => 159,
                'name' => 'Mexico',
                'code' => 'MX',
                'adm1code' => 'MX15',
            ),
            126 => 
            array (
                'id' => 2890,
                'country_id' => 159,
                'name' => 'Michoacan de Ocampo',
                'code' => 'MC',
                'adm1code' => 'MX16',
            ),
            127 => 
            array (
                'id' => 2891,
                'country_id' => 159,
                'name' => 'Nayarit',
                'code' => 'NA',
                'adm1code' => 'MX18',
            ),
            128 => 
            array (
                'id' => 2892,
                'country_id' => 159,
                'name' => 'Puebla',
                'code' => 'PU',
                'adm1code' => 'MX21',
            ),
            129 => 
            array (
                'id' => 2893,
                'country_id' => 159,
                'name' => 'Queretaro de Arteaga',
                'code' => 'QE',
                'adm1code' => 'MX22',
            ),
            130 => 
            array (
                'id' => 2894,
                'country_id' => 159,
                'name' => 'Sinaloa',
                'code' => 'SI',
                'adm1code' => 'MX25',
            ),
            131 => 
            array (
                'id' => 2895,
                'country_id' => 159,
                'name' => 'Veracruz-Llave',
                'code' => 'VE',
                'adm1code' => 'MX30',
            ),
            132 => 
            array (
                'id' => 2896,
                'country_id' => 159,
                'name' => 'Yucatan',
                'code' => 'YU',
                'adm1code' => 'MX31',
            ),
            133 => 
            array (
                'id' => 2897,
                'country_id' => 149,
                'name' => 'Johor',
                'code' => 'JH',
                'adm1code' => 'MY01',
            ),
            134 => 
            array (
                'id' => 2898,
                'country_id' => 149,
                'name' => 'Kedah',
                'code' => 'KH',
                'adm1code' => 'MY02',
            ),
            135 => 
            array (
                'id' => 2899,
                'country_id' => 149,
                'name' => 'Kelantan',
                'code' => 'KN',
                'adm1code' => 'MY03',
            ),
            136 => 
            array (
                'id' => 2900,
                'country_id' => 149,
                'name' => 'Melaka',
                'code' => 'ME',
                'adm1code' => 'MY04',
            ),
            137 => 
            array (
                'id' => 2901,
                'country_id' => 149,
                'name' => 'Negeri Sembilan',
                'code' => 'NS',
                'adm1code' => 'MY05',
            ),
            138 => 
            array (
                'id' => 2902,
                'country_id' => 149,
                'name' => 'Pahang',
                'code' => 'PH',
                'adm1code' => 'MY06',
            ),
            139 => 
            array (
                'id' => 2903,
                'country_id' => 149,
                'name' => 'Perak',
                'code' => 'PK',
                'adm1code' => 'MY07',
            ),
            140 => 
            array (
                'id' => 2904,
                'country_id' => 149,
                'name' => 'Perlis',
                'code' => 'PL',
                'adm1code' => 'MY08',
            ),
            141 => 
            array (
                'id' => 2905,
                'country_id' => 149,
                'name' => 'Pulau Pinang',
                'code' => 'PG',
                'adm1code' => 'MY09',
            ),
            142 => 
            array (
                'id' => 2906,
                'country_id' => 149,
                'name' => 'Sarawak',
                'code' => 'SK',
                'adm1code' => 'MY11',
            ),
            143 => 
            array (
                'id' => 2907,
                'country_id' => 149,
                'name' => 'Selangor',
                'code' => 'SL',
                'adm1code' => 'MY12',
            ),
            144 => 
            array (
                'id' => 2908,
                'country_id' => 149,
                'name' => 'Terengganu',
                'code' => 'TE',
                'adm1code' => 'MY13',
            ),
            145 => 
            array (
                'id' => 2909,
                'country_id' => 149,
                'name' => 'Wilayah Persekutuan',
                'code' => 'KL',
                'adm1code' => 'MY14',
            ),
            146 => 
            array (
                'id' => 2910,
                'country_id' => 149,
                'name' => 'Labuan',
                'code' => 'LA',
                'adm1code' => 'MY15',
            ),
            147 => 
            array (
                'id' => 2911,
                'country_id' => 149,
                'name' => 'Sabah',
                'code' => 'SA',
                'adm1code' => 'MY16',
            ),
            148 => 
            array (
                'id' => 2912,
                'country_id' => 169,
                'name' => 'Cabo Delgado',
                'code' => 'CD',
                'adm1code' => 'MZ01',
            ),
            149 => 
            array (
                'id' => 2913,
                'country_id' => 169,
                'name' => 'Gaza',
                'code' => 'GA',
                'adm1code' => 'MZ02',
            ),
            150 => 
            array (
                'id' => 2914,
                'country_id' => 169,
                'name' => 'Inhambane',
                'code' => 'IN',
                'adm1code' => 'MZ03',
            ),
            151 => 
            array (
                'id' => 2915,
                'country_id' => 169,
                'name' => 'Maputo',
                'code' => 'MP',
                'adm1code' => 'MZ04',
            ),
            152 => 
            array (
                'id' => 2916,
                'country_id' => 169,
                'name' => 'Sofala',
                'code' => 'SO',
                'adm1code' => 'MZ05',
            ),
            153 => 
            array (
                'id' => 2917,
                'country_id' => 169,
                'name' => 'Nampula',
                'code' => 'NM',
                'adm1code' => 'MZ06',
            ),
            154 => 
            array (
                'id' => 2918,
                'country_id' => 169,
                'name' => 'Niassa',
                'code' => 'NS',
                'adm1code' => 'MZ07',
            ),
            155 => 
            array (
                'id' => 2919,
                'country_id' => 169,
                'name' => 'Tete',
                'code' => 'TE',
                'adm1code' => 'MZ08',
            ),
            156 => 
            array (
                'id' => 2920,
                'country_id' => 169,
                'name' => 'Zambezia',
                'code' => 'ZA',
                'adm1code' => 'MZ09',
            ),
            157 => 
            array (
                'id' => 2921,
                'country_id' => 169,
                'name' => 'Manica',
                'code' => 'MN',
                'adm1code' => 'MZ10',
            ),
            158 => 
            array (
                'id' => 2922,
                'country_id' => 180,
                'name' => 'Agadez',
                'code' => 'AG',
                'adm1code' => 'NG01',
            ),
            159 => 
            array (
                'id' => 2923,
                'country_id' => 180,
                'name' => 'Diffa',
                'code' => 'DF',
                'adm1code' => 'NG02',
            ),
            160 => 
            array (
                'id' => 2924,
                'country_id' => 180,
                'name' => 'Dosso',
                'code' => 'DS',
                'adm1code' => 'NG03',
            ),
            161 => 
            array (
                'id' => 2925,
                'country_id' => 180,
                'name' => 'Maradi',
                'code' => 'MA',
                'adm1code' => 'NG04',
            ),
            162 => 
            array (
                'id' => 2926,
                'country_id' => 180,
                'name' => 'Niamey',
                'code' => 'NI',
                'adm1code' => 'NG08',
            ),
            163 => 
            array (
                'id' => 2927,
                'country_id' => 180,
                'name' => 'Tahoua',
                'code' => 'TH',
                'adm1code' => 'NG06',
            ),
            164 => 
            array (
                'id' => 2928,
                'country_id' => 180,
                'name' => 'Zinder',
                'code' => 'ZI',
                'adm1code' => 'NG07',
            ),
            165 => 
            array (
                'id' => 2929,
                'country_id' => 180,
                'name' => 'Tillaberi',
                'code' => 'TL',
                'adm1code' => 'NG09',
            ),
            166 => 
            array (
                'id' => 2931,
                'country_id' => 258,
                'name' => 'Aoba//Maewo',
                'code' => 'AO',
                'adm1code' => 'NH06',
            ),
            167 => 
            array (
                'id' => 2932,
                'country_id' => 258,
                'name' => 'Torba',
                'code' => 'TR',
                'adm1code' => 'NH07',
            ),
            168 => 
            array (
                'id' => 2938,
                'country_id' => 258,
                'name' => 'Sanma',
                'code' => 'SN',
                'adm1code' => 'NH13',
            ),
            169 => 
            array (
                'id' => 2940,
                'country_id' => 258,
                'name' => 'Tafea',
                'code' => 'TF',
                'adm1code' => 'NH15',
            ),
            170 => 
            array (
                'id' => 2941,
                'country_id' => 181,
                'name' => 'Lagos',
                'code' => 'LA',
                'adm1code' => 'NI05',
            ),
            171 => 
            array (
                'id' => 2942,
                'country_id' => 181,
                'name' => 'Bauchi',
                'code' => 'BA',
                'adm1code' => 'NI46',
            ),
            172 => 
            array (
                'id' => 2943,
                'country_id' => 181,
                'name' => 'Rivers',
                'code' => 'RI',
                'adm1code' => 'NI50',
            ),
            173 => 
            array (
                'id' => 2944,
                'country_id' => 181,
                'name' => 'Abuja Capital Territory',
                'code' => 'FC',
                'adm1code' => 'NI11',
            ),
            174 => 
            array (
                'id' => 2946,
                'country_id' => 181,
                'name' => 'Ogun',
                'code' => 'OG',
                'adm1code' => 'NI16',
            ),
            175 => 
            array (
                'id' => 2947,
                'country_id' => 181,
                'name' => 'Ondo',
                'code' => 'ON',
                'adm1code' => 'NI48',
            ),
            176 => 
            array (
                'id' => 2949,
                'country_id' => 181,
                'name' => 'Plateau',
                'code' => 'PL',
                'adm1code' => 'NI49',
            ),
            177 => 
            array (
                'id' => 2951,
                'country_id' => 181,
                'name' => 'Akwa Ibom',
                'code' => 'AK',
                'adm1code' => 'NI21',
            ),
            178 => 
            array (
                'id' => 2952,
                'country_id' => 181,
                'name' => 'Cross River',
                'code' => 'CR',
                'adm1code' => 'NI22',
            ),
            179 => 
            array (
                'id' => 2953,
                'country_id' => 181,
                'name' => 'Kaduna',
                'code' => 'KD',
                'adm1code' => 'NI23',
            ),
            180 => 
            array (
                'id' => 2955,
                'country_id' => 181,
                'name' => 'Anambra',
                'code' => 'AN',
                'adm1code' => 'NI25',
            ),
            181 => 
            array (
                'id' => 2956,
                'country_id' => 181,
                'name' => 'Benue',
                'code' => 'BE',
                'adm1code' => 'NI26',
            ),
            182 => 
            array (
                'id' => 2957,
                'country_id' => 181,
                'name' => 'Borno',
                'code' => 'BO',
                'adm1code' => 'NI27',
            ),
            183 => 
            array (
                'id' => 2959,
                'country_id' => 181,
                'name' => 'Kano',
                'code' => 'KN',
                'adm1code' => 'NI29',
            ),
            184 => 
            array (
                'id' => 2960,
                'country_id' => 181,
                'name' => 'Kwara',
                'code' => 'KW',
                'adm1code' => 'NI30',
            ),
            185 => 
            array (
                'id' => 2961,
                'country_id' => 181,
                'name' => 'Niger',
                'code' => 'NI',
                'adm1code' => 'NI31',
            ),
            186 => 
            array (
                'id' => 2962,
                'country_id' => 181,
                'name' => 'Oyo',
                'code' => 'OY',
                'adm1code' => 'NI32',
            ),
            187 => 
            array (
                'id' => 2963,
                'country_id' => 181,
                'name' => 'Sokoto',
                'code' => 'SO',
                'adm1code' => 'NI51',
            ),
            188 => 
            array (
                'id' => 2964,
                'country_id' => 181,
                'name' => 'Abia',
                'code' => 'AB',
                'adm1code' => 'NI45',
            ),
            189 => 
            array (
                'id' => 2965,
                'country_id' => 181,
                'name' => 'Adamawa',
                'code' => 'AD',
                'adm1code' => 'NI35',
            ),
            190 => 
            array (
                'id' => 2966,
                'country_id' => 181,
                'name' => 'Delta',
                'code' => 'DE',
                'adm1code' => 'NI36',
            ),
            191 => 
            array (
                'id' => 2967,
                'country_id' => 181,
                'name' => 'Edo',
                'code' => 'ED',
                'adm1code' => 'NI37',
            ),
            192 => 
            array (
                'id' => 2968,
                'country_id' => 181,
                'name' => 'Enugu',
                'code' => 'EN',
                'adm1code' => 'NI47',
            ),
            193 => 
            array (
                'id' => 2969,
                'country_id' => 181,
                'name' => 'Jigawa',
                'code' => 'JI',
                'adm1code' => 'NI39',
            ),
            194 => 
            array (
                'id' => 2970,
                'country_id' => 181,
                'name' => 'Kebbi',
                'code' => 'KE',
                'adm1code' => 'NI40',
            ),
            195 => 
            array (
                'id' => 2971,
                'country_id' => 181,
                'name' => 'Kogi',
                'code' => 'KO',
                'adm1code' => 'NI41',
            ),
            196 => 
            array (
                'id' => 2972,
                'country_id' => 181,
                'name' => 'Osun',
                'code' => 'OS',
                'adm1code' => 'NI42',
            ),
            197 => 
            array (
                'id' => 2973,
                'country_id' => 181,
                'name' => 'Taraba',
                'code' => 'TA',
                'adm1code' => 'NI43',
            ),
            198 => 
            array (
                'id' => 2974,
                'country_id' => 181,
                'name' => 'Yobe',
                'code' => 'YO',
                'adm1code' => 'NI44',
            ),
            199 => 
            array (
                'id' => 2975,
                'country_id' => 175,
                'name' => 'Drenthe',
                'code' => 'DR',
                'adm1code' => 'NL01',
            ),
            200 => 
            array (
                'id' => 2976,
                'country_id' => 175,
                'name' => 'Friesland',
                'code' => 'FR',
                'adm1code' => 'NL02',
            ),
            201 => 
            array (
                'id' => 2977,
                'country_id' => 175,
                'name' => 'Gelderland',
                'code' => 'GE',
                'adm1code' => 'NL03',
            ),
            202 => 
            array (
                'id' => 2978,
                'country_id' => 175,
                'name' => 'Groningen',
                'code' => 'GR',
                'adm1code' => 'NL04',
            ),
            203 => 
            array (
                'id' => 2979,
                'country_id' => 175,
                'name' => 'Limburg',
                'code' => 'LI',
                'adm1code' => 'NL05',
            ),
            204 => 
            array (
                'id' => 2980,
                'country_id' => 175,
                'name' => 'Noord-Brabant',
                'code' => 'NB',
                'adm1code' => 'NL06',
            ),
            205 => 
            array (
                'id' => 2981,
                'country_id' => 175,
                'name' => 'Noord-Holland',
                'code' => 'NH',
                'adm1code' => 'NL07',
            ),
            206 => 
            array (
                'id' => 2982,
                'country_id' => 175,
                'name' => 'Overijssel',
                'code' => 'OV',
                'adm1code' => 'NL15',
            ),
            207 => 
            array (
                'id' => 2983,
                'country_id' => 175,
                'name' => 'Utrecht',
                'code' => 'UT',
                'adm1code' => 'NL09',
            ),
            208 => 
            array (
                'id' => 2984,
                'country_id' => 175,
                'name' => 'Zeeland',
                'code' => 'ZE',
                'adm1code' => 'NL10',
            ),
            209 => 
            array (
                'id' => 2985,
                'country_id' => 175,
                'name' => 'Zuid-Holland',
                'code' => 'ZH',
                'adm1code' => 'NL11',
            ),
            210 => 
            array (
                'id' => 2989,
                'country_id' => 175,
                'name' => 'Flevoland',
                'code' => 'FL',
                'adm1code' => 'NL16',
            ),
            211 => 
            array (
                'id' => 2990,
                'country_id' => 185,
                'name' => 'Akershus',
                'code' => 'AK',
                'adm1code' => 'NO01',
            ),
            212 => 
            array (
                'id' => 2991,
                'country_id' => 185,
                'name' => 'Aust-Agder',
                'code' => 'AA',
                'adm1code' => 'NO02',
            ),
            213 => 
            array (
                'id' => 2992,
                'country_id' => 185,
                'name' => 'Buskerud',
                'code' => 'BU',
                'adm1code' => 'NO04',
            ),
            214 => 
            array (
                'id' => 2993,
                'country_id' => 185,
                'name' => 'Finnmark',
                'code' => 'FI',
                'adm1code' => 'NO05',
            ),
            215 => 
            array (
                'id' => 2994,
                'country_id' => 185,
                'name' => 'Hedmark',
                'code' => 'HE',
                'adm1code' => 'NO06',
            ),
            216 => 
            array (
                'id' => 2995,
                'country_id' => 185,
                'name' => 'Hordaland',
                'code' => 'HO',
                'adm1code' => 'NO07',
            ),
            217 => 
            array (
                'id' => 2996,
                'country_id' => 185,
                'name' => 'More og Romsdal',
                'code' => 'MR',
                'adm1code' => 'NO08',
            ),
            218 => 
            array (
                'id' => 2997,
                'country_id' => 185,
                'name' => 'Nordland',
                'code' => 'NL',
                'adm1code' => 'NO09',
            ),
            219 => 
            array (
                'id' => 2998,
                'country_id' => 185,
                'name' => 'Nord-Trondelag',
                'code' => 'NR',
                'adm1code' => 'NO10',
            ),
            220 => 
            array (
                'id' => 2999,
                'country_id' => 185,
                'name' => 'Oppland',
                'code' => 'OP',
                'adm1code' => 'NO11',
            ),
            221 => 
            array (
                'id' => 3000,
                'country_id' => 185,
                'name' => 'Oslo',
                'code' => 'OS',
                'adm1code' => 'NO12',
            ),
            222 => 
            array (
                'id' => 3001,
                'country_id' => 185,
                'name' => 'Ã¿stfold',
                'code' => 'OF',
                'adm1code' => 'NO13',
            ),
            223 => 
            array (
                'id' => 3002,
                'country_id' => 185,
                'name' => 'Rogaland',
                'code' => 'RO',
                'adm1code' => 'NO14',
            ),
            224 => 
            array (
                'id' => 3003,
                'country_id' => 185,
                'name' => 'Sogn og Fjordane',
                'code' => 'SF',
                'adm1code' => 'NO15',
            ),
            225 => 
            array (
                'id' => 3004,
                'country_id' => 185,
                'name' => 'Sor-Trondelag',
                'code' => 'ST',
                'adm1code' => 'NO16',
            ),
            226 => 
            array (
                'id' => 3005,
                'country_id' => 185,
                'name' => 'Telemark',
                'code' => 'TE',
                'adm1code' => 'NO17',
            ),
            227 => 
            array (
                'id' => 3006,
                'country_id' => 185,
                'name' => 'Troms',
                'code' => 'TR',
                'adm1code' => 'NO18',
            ),
            228 => 
            array (
                'id' => 3007,
                'country_id' => 185,
                'name' => 'Vest-Agder',
                'code' => 'VA',
                'adm1code' => 'NO19',
            ),
            229 => 
            array (
                'id' => 3008,
                'country_id' => 185,
                'name' => 'Vestfold',
                'code' => 'VF',
                'adm1code' => 'NO20',
            ),
            230 => 
            array (
                'id' => 3009,
                'country_id' => 174,
                'name' => 'Bagmati',
                'code' => 'BA',
                'adm1code' => 'NP01',
            ),
            231 => 
            array (
                'id' => 3010,
                'country_id' => 174,
                'name' => 'Bheri',
                'code' => 'BH',
                'adm1code' => 'NP02',
            ),
            232 => 
            array (
                'id' => 3011,
                'country_id' => 174,
                'name' => 'Dhawalagiri',
                'code' => 'DH',
                'adm1code' => 'NP03',
            ),
            233 => 
            array (
                'id' => 3012,
                'country_id' => 174,
                'name' => 'Gandaki',
                'code' => 'GA',
                'adm1code' => 'NP04',
            ),
            234 => 
            array (
                'id' => 3013,
                'country_id' => 174,
                'name' => 'Janakpur',
                'code' => 'JA',
                'adm1code' => 'NP05',
            ),
            235 => 
            array (
                'id' => 3014,
                'country_id' => 174,
                'name' => 'Karnali',
                'code' => 'KA',
                'adm1code' => 'NP06',
            ),
            236 => 
            array (
                'id' => 3015,
                'country_id' => 174,
                'name' => 'Kosi',
                'code' => 'KO',
                'adm1code' => 'NP07',
            ),
            237 => 
            array (
                'id' => 3016,
                'country_id' => 174,
                'name' => 'Lumbini',
                'code' => 'LU',
                'adm1code' => 'NP08',
            ),
            238 => 
            array (
                'id' => 3017,
                'country_id' => 174,
                'name' => 'Mahakali',
                'code' => 'MA',
                'adm1code' => 'NP09',
            ),
            239 => 
            array (
                'id' => 3018,
                'country_id' => 174,
                'name' => 'Mechi',
                'code' => 'ME',
                'adm1code' => 'NP10',
            ),
            240 => 
            array (
                'id' => 3019,
                'country_id' => 174,
                'name' => 'Narayani',
                'code' => 'NA',
                'adm1code' => 'NP11',
            ),
            241 => 
            array (
                'id' => 3020,
                'country_id' => 174,
                'name' => 'Rapti',
                'code' => 'RA',
                'adm1code' => 'NP12',
            ),
            242 => 
            array (
                'id' => 3021,
                'country_id' => 174,
                'name' => 'Sagarmatha',
                'code' => 'SA',
                'adm1code' => 'NP13',
            ),
            243 => 
            array (
                'id' => 3022,
                'country_id' => 174,
                'name' => 'Seti',
                'code' => 'SE',
                'adm1code' => 'NP14',
            ),
            244 => 
            array (
                'id' => 3023,
                'country_id' => 172,
                'name' => 'Aiwo',
                'code' => 'AI',
                'adm1code' => 'NR01',
            ),
            245 => 
            array (
                'id' => 3024,
                'country_id' => 172,
                'name' => 'Anabar',
                'code' => 'AB',
                'adm1code' => 'NR02',
            ),
            246 => 
            array (
                'id' => 3025,
                'country_id' => 172,
                'name' => 'Anetan',
                'code' => 'AT',
                'adm1code' => 'NR03',
            ),
            247 => 
            array (
                'id' => 3026,
                'country_id' => 172,
                'name' => 'Anibare',
                'code' => 'AR',
                'adm1code' => 'NR04',
            ),
            248 => 
            array (
                'id' => 3027,
                'country_id' => 172,
                'name' => 'Baiti',
                'code' => 'BA',
                'adm1code' => 'NR05',
            ),
            249 => 
            array (
                'id' => 3028,
                'country_id' => 172,
                'name' => 'Boe',
                'code' => 'BO',
                'adm1code' => 'NR06',
            ),
            250 => 
            array (
                'id' => 3029,
                'country_id' => 172,
                'name' => 'Buada',
                'code' => 'BU',
                'adm1code' => 'NR07',
            ),
            251 => 
            array (
                'id' => 3030,
                'country_id' => 172,
                'name' => 'Denigomodu',
                'code' => 'DE',
                'adm1code' => 'NR08',
            ),
            252 => 
            array (
                'id' => 3031,
                'country_id' => 172,
                'name' => 'Ewa',
                'code' => 'EW',
                'adm1code' => 'NR09',
            ),
            253 => 
            array (
                'id' => 3032,
                'country_id' => 172,
                'name' => 'Ijuw',
                'code' => 'IJ',
                'adm1code' => 'NR10',
            ),
            254 => 
            array (
                'id' => 3033,
                'country_id' => 172,
                'name' => 'Meneng',
                'code' => 'ME',
                'adm1code' => 'NR11',
            ),
            255 => 
            array (
                'id' => 3034,
                'country_id' => 172,
                'name' => 'Nibok',
                'code' => 'NI',
                'adm1code' => 'NR12',
            ),
            256 => 
            array (
                'id' => 3035,
                'country_id' => 172,
                'name' => 'Uaboe',
                'code' => 'UA',
                'adm1code' => 'NR13',
            ),
            257 => 
            array (
                'id' => 3036,
                'country_id' => 172,
                'name' => 'Yaren',
                'code' => 'YA',
                'adm1code' => 'NR14',
            ),
            258 => 
            array (
                'id' => 3037,
                'country_id' => 230,
                'name' => 'Brokopondo',
                'code' => 'BR',
                'adm1code' => 'NS10',
            ),
            259 => 
            array (
                'id' => 3038,
                'country_id' => 230,
                'name' => 'Commewijne',
                'code' => 'CM',
                'adm1code' => 'NS11',
            ),
            260 => 
            array (
                'id' => 3039,
                'country_id' => 230,
                'name' => 'Coronie',
                'code' => 'CR',
                'adm1code' => 'NS12',
            ),
            261 => 
            array (
                'id' => 3040,
                'country_id' => 230,
                'name' => 'Marowijne',
                'code' => 'MA',
                'adm1code' => 'NS13',
            ),
            262 => 
            array (
                'id' => 3041,
                'country_id' => 230,
                'name' => 'Nickerie',
                'code' => 'NI',
                'adm1code' => 'NS14',
            ),
            263 => 
            array (
                'id' => 3042,
                'country_id' => 230,
                'name' => 'Para',
                'code' => 'PR',
                'adm1code' => 'NS15',
            ),
            264 => 
            array (
                'id' => 3043,
                'country_id' => 230,
                'name' => 'Paramaribo',
                'code' => 'PM',
                'adm1code' => 'NS16',
            ),
            265 => 
            array (
                'id' => 3044,
                'country_id' => 230,
                'name' => 'Saramacca',
                'code' => 'SA',
                'adm1code' => 'NS17',
            ),
            266 => 
            array (
                'id' => 3045,
                'country_id' => 230,
                'name' => 'Sipaliwini',
                'code' => 'SI',
                'adm1code' => 'NS18',
            ),
            267 => 
            array (
                'id' => 3046,
                'country_id' => 230,
                'name' => 'Wanica',
                'code' => 'WA',
                'adm1code' => 'NS19',
            ),
            268 => 
            array (
                'id' => 3047,
                'country_id' => 179,
                'name' => 'Boaco',
                'code' => 'BO',
                'adm1code' => 'NU01',
            ),
            269 => 
            array (
                'id' => 3048,
                'country_id' => 179,
                'name' => 'Carazo',
                'code' => 'CA',
                'adm1code' => 'NU02',
            ),
            270 => 
            array (
                'id' => 3049,
                'country_id' => 179,
                'name' => 'Chinandega',
                'code' => 'CI',
                'adm1code' => 'NU03',
            ),
            271 => 
            array (
                'id' => 3050,
                'country_id' => 179,
                'name' => 'Chontales',
                'code' => 'CO',
                'adm1code' => 'NU04',
            ),
            272 => 
            array (
                'id' => 3051,
                'country_id' => 179,
                'name' => 'Esteli',
                'code' => 'ES',
                'adm1code' => 'NU05',
            ),
            273 => 
            array (
                'id' => 3052,
                'country_id' => 179,
                'name' => 'Granada',
                'code' => 'GR',
                'adm1code' => 'NU06',
            ),
            274 => 
            array (
                'id' => 3053,
                'country_id' => 179,
                'name' => 'Jinotega',
                'code' => 'JI',
                'adm1code' => 'NU07',
            ),
            275 => 
            array (
                'id' => 3054,
                'country_id' => 179,
                'name' => 'Leon',
                'code' => 'LE',
                'adm1code' => 'NU08',
            ),
            276 => 
            array (
                'id' => 3055,
                'country_id' => 179,
                'name' => 'Madriz',
                'code' => 'MD',
                'adm1code' => 'NU09',
            ),
            277 => 
            array (
                'id' => 3056,
                'country_id' => 179,
                'name' => 'Managua',
                'code' => 'MN',
                'adm1code' => 'NU10',
            ),
            278 => 
            array (
                'id' => 3057,
                'country_id' => 179,
                'name' => 'Masaya',
                'code' => 'MS',
                'adm1code' => 'NU11',
            ),
            279 => 
            array (
                'id' => 3058,
                'country_id' => 179,
                'name' => 'Matagalpa',
                'code' => 'MT',
                'adm1code' => 'NU12',
            ),
            280 => 
            array (
                'id' => 3059,
                'country_id' => 179,
                'name' => 'Nueva Segovia',
                'code' => 'NS',
                'adm1code' => 'NU13',
            ),
            281 => 
            array (
                'id' => 3060,
                'country_id' => 179,
                'name' => 'Rio San Juan',
                'code' => 'SJ',
                'adm1code' => 'NU14',
            ),
            282 => 
            array (
                'id' => 3061,
                'country_id' => 179,
                'name' => 'Rivas',
                'code' => 'RI',
                'adm1code' => 'NU15',
            ),
            283 => 
            array (
                'id' => 3063,
                'country_id' => 179,
                'name' => 'Atlantico Norte',
                'code' => 'AN',
                'adm1code' => 'NU17',
            ),
            284 => 
            array (
                'id' => 3064,
                'country_id' => 179,
                'name' => 'Atlantico Sur',
                'code' => 'AS',
                'adm1code' => 'NU18',
            ),
            285 => 
            array (
                'id' => 3089,
                'country_id' => 178,
                'name' => 'Hawke\'s Bay',
                'code' => 'HB',
                'adm1code' => 'NZ31',
            ),
            286 => 
            array (
                'id' => 3106,
                'country_id' => 178,
                'name' => 'Marlborough',
                'code' => 'MA',
                'adm1code' => 'NZ50',
            ),
            287 => 
            array (
                'id' => 3126,
                'country_id' => 178,
                'name' => 'Southland',
                'code' => 'SO',
                'adm1code' => 'NZ72',
            ),
            288 => 
            array (
                'id' => 3129,
                'country_id' => 178,
                'name' => 'Taranaki',
                'code' => 'TK',
                'adm1code' => 'NZ76',
            ),
            289 => 
            array (
                'id' => 3137,
                'country_id' => 178,
                'name' => 'Waikato',
                'code' => 'WK',
                'adm1code' => 'NZ85',
            ),
            290 => 
            array (
                'id' => 3170,
                'country_id' => 193,
                'name' => 'Alto Parana',
                'code' => 'AA',
                'adm1code' => 'PA01',
            ),
            291 => 
            array (
                'id' => 3171,
                'country_id' => 193,
                'name' => 'Amambay',
                'code' => 'AM',
                'adm1code' => 'PA02',
            ),
            292 => 
            array (
                'id' => 3172,
                'country_id' => 193,
                'name' => 'Caaguazu',
                'code' => 'CG',
                'adm1code' => 'PA04',
            ),
            293 => 
            array (
                'id' => 3173,
                'country_id' => 193,
                'name' => 'Caazapa',
                'code' => 'CZ',
                'adm1code' => 'PA05',
            ),
            294 => 
            array (
                'id' => 3174,
                'country_id' => 193,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'PA06',
            ),
            295 => 
            array (
                'id' => 3175,
                'country_id' => 193,
                'name' => 'Concepcion',
                'code' => 'CN',
                'adm1code' => 'PA07',
            ),
            296 => 
            array (
                'id' => 3176,
                'country_id' => 193,
                'name' => 'Cordillera',
                'code' => 'CR',
                'adm1code' => 'PA08',
            ),
            297 => 
            array (
                'id' => 3177,
                'country_id' => 193,
                'name' => 'Guaira',
                'code' => 'GU',
                'adm1code' => 'PA10',
            ),
            298 => 
            array (
                'id' => 3178,
                'country_id' => 193,
                'name' => 'Itapua',
                'code' => 'IT',
                'adm1code' => 'PA11',
            ),
            299 => 
            array (
                'id' => 3179,
                'country_id' => 193,
                'name' => 'Misiones',
                'code' => 'MI',
                'adm1code' => 'PA12',
            ),
            300 => 
            array (
                'id' => 3180,
                'country_id' => 193,
                'name' => 'Neembucu',
                'code' => 'NE',
                'adm1code' => 'PA13',
            ),
            301 => 
            array (
                'id' => 3181,
                'country_id' => 193,
                'name' => 'Paraguari',
                'code' => 'PG',
                'adm1code' => 'PA15',
            ),
            302 => 
            array (
                'id' => 3182,
                'country_id' => 193,
                'name' => 'Presidente Hayes',
                'code' => 'PH',
                'adm1code' => 'PA16',
            ),
            303 => 
            array (
                'id' => 3183,
                'country_id' => 193,
                'name' => 'San Pedro',
                'code' => 'SP',
                'adm1code' => 'PA17',
            ),
            304 => 
            array (
                'id' => 3184,
                'country_id' => 193,
                'name' => 'Canindeyu',
                'code' => 'CY',
                'adm1code' => 'PA19',
            ),
            305 => 
            array (
                'id' => 3185,
                'country_id' => 193,
                'name' => 'Asuncion',
                'code' => 'AS',
                'adm1code' => 'PA22',
            ),
            306 => 
            array (
                'id' => 3186,
                'country_id' => 193,
                'name' => 'Alto Paraguay',
                'code' => 'AG',
                'adm1code' => 'PA23',
            ),
            307 => 
            array (
                'id' => 3187,
                'country_id' => 193,
                'name' => 'Boqueron',
                'code' => 'BQ',
                'adm1code' => 'PA24',
            ),
            308 => 
            array (
                'id' => 3188,
                'country_id' => 194,
                'name' => 'Amazonas',
                'code' => 'AM',
                'adm1code' => 'PE01',
            ),
            309 => 
            array (
                'id' => 3189,
                'country_id' => 194,
                'name' => 'Ancash',
                'code' => 'AN',
                'adm1code' => 'PE02',
            ),
            310 => 
            array (
                'id' => 3190,
                'country_id' => 194,
                'name' => 'Apurimac',
                'code' => 'AP',
                'adm1code' => 'PE03',
            ),
            311 => 
            array (
                'id' => 3191,
                'country_id' => 194,
                'name' => 'Arequipa',
                'code' => 'AR',
                'adm1code' => 'PE04',
            ),
            312 => 
            array (
                'id' => 3192,
                'country_id' => 194,
                'name' => 'Ayacucho',
                'code' => 'AY',
                'adm1code' => 'PE05',
            ),
            313 => 
            array (
                'id' => 3193,
                'country_id' => 194,
                'name' => 'Cajamarca',
                'code' => 'CJ',
                'adm1code' => 'PE06',
            ),
            314 => 
            array (
                'id' => 3194,
                'country_id' => 194,
                'name' => 'Callao',
                'code' => 'CL',
                'adm1code' => 'PE07',
            ),
            315 => 
            array (
                'id' => 3195,
                'country_id' => 194,
                'name' => 'Cusco',
                'code' => 'CS',
                'adm1code' => 'PE08',
            ),
            316 => 
            array (
                'id' => 3196,
                'country_id' => 194,
                'name' => 'Huancavelica',
                'code' => 'HV',
                'adm1code' => 'PE09',
            ),
            317 => 
            array (
                'id' => 3197,
                'country_id' => 194,
                'name' => 'Huanuco',
                'code' => 'HC',
                'adm1code' => 'PE10',
            ),
            318 => 
            array (
                'id' => 3198,
                'country_id' => 194,
                'name' => 'Ica',
                'code' => 'IC',
                'adm1code' => 'PE11',
            ),
            319 => 
            array (
                'id' => 3199,
                'country_id' => 194,
                'name' => 'Junin',
                'code' => 'JU',
                'adm1code' => 'PE12',
            ),
            320 => 
            array (
                'id' => 3200,
                'country_id' => 194,
                'name' => 'La Libertad',
                'code' => 'LL',
                'adm1code' => 'PE13',
            ),
            321 => 
            array (
                'id' => 3201,
                'country_id' => 194,
                'name' => 'Lambayeque',
                'code' => 'LB',
                'adm1code' => 'PE14',
            ),
            322 => 
            array (
                'id' => 3202,
                'country_id' => 194,
                'name' => 'Lima',
                'code' => 'LI',
                'adm1code' => 'PE15',
            ),
            323 => 
            array (
                'id' => 3203,
                'country_id' => 194,
                'name' => 'Loreto',
                'code' => 'LO',
                'adm1code' => 'PE16',
            ),
            324 => 
            array (
                'id' => 3204,
                'country_id' => 194,
                'name' => 'Madre de Dios',
                'code' => 'MD',
                'adm1code' => 'PE17',
            ),
            325 => 
            array (
                'id' => 3205,
                'country_id' => 194,
                'name' => 'Moquegua',
                'code' => 'MQ',
                'adm1code' => 'PE18',
            ),
            326 => 
            array (
                'id' => 3206,
                'country_id' => 194,
                'name' => 'Pasco',
                'code' => 'PA',
                'adm1code' => 'PE19',
            ),
            327 => 
            array (
                'id' => 3207,
                'country_id' => 194,
                'name' => 'Piura',
                'code' => 'PI',
                'adm1code' => 'PE20',
            ),
            328 => 
            array (
                'id' => 3208,
                'country_id' => 194,
                'name' => 'Puno',
                'code' => 'PU',
                'adm1code' => 'PE21',
            ),
            329 => 
            array (
                'id' => 3209,
                'country_id' => 194,
                'name' => 'San Martin',
                'code' => 'SM',
                'adm1code' => 'PE22',
            ),
            330 => 
            array (
                'id' => 3210,
                'country_id' => 194,
                'name' => 'Tacna',
                'code' => 'TA',
                'adm1code' => 'PE23',
            ),
            331 => 
            array (
                'id' => 3211,
                'country_id' => 194,
                'name' => 'Tumbes',
                'code' => 'TU',
                'adm1code' => 'PE24',
            ),
            332 => 
            array (
                'id' => 3212,
                'country_id' => 194,
                'name' => 'Ucayali',
                'code' => 'UC',
                'adm1code' => 'PE25',
            ),
            333 => 
            array (
                'id' => 3216,
                'country_id' => 187,
                'name' => 'Federally Administered Tribal Areas',
                'code' => 'TA',
                'adm1code' => 'PK01',
            ),
            334 => 
            array (
                'id' => 3217,
                'country_id' => 187,
                'name' => 'Balochistan',
                'code' => 'BA',
                'adm1code' => 'PK02',
            ),
            335 => 
            array (
                'id' => 3218,
                'country_id' => 187,
                'name' => 'North-West Frontier',
                'code' => 'NW',
                'adm1code' => 'PK03',
            ),
            336 => 
            array (
                'id' => 3219,
                'country_id' => 187,
                'name' => 'Punjab',
                'code' => 'PB',
                'adm1code' => 'PK04',
            ),
            337 => 
            array (
                'id' => 3220,
                'country_id' => 187,
                'name' => 'Sindh',
                'code' => 'SD',
                'adm1code' => 'PK05',
            ),
            338 => 
            array (
                'id' => 3221,
                'country_id' => 187,
                'name' => 'Azad Kashmir',
                'code' => 'JK',
                'adm1code' => 'PK06',
            ),
            339 => 
            array (
                'id' => 3222,
                'country_id' => 187,
                'name' => 'Northern Areas',
                'code' => 'NA',
                'adm1code' => 'PK07',
            ),
            340 => 
            array (
                'id' => 3223,
                'country_id' => 187,
                'name' => 'Islamabad',
                'code' => 'IS',
                'adm1code' => 'PK08',
            ),
            341 => 
            array (
                'id' => 3274,
                'country_id' => 197,
                'name' => 'Dolnoslaskie',
                'code' => 'DS',
                'adm1code' => 'PL72',
            ),
            342 => 
            array (
                'id' => 3275,
                'country_id' => 197,
                'name' => 'Kujawsko-Pomorskie',
                'code' => 'KP',
                'adm1code' => 'PL73',
            ),
            343 => 
            array (
                'id' => 3276,
                'country_id' => 197,
                'name' => 'Lodzkie',
                'code' => 'LD',
                'adm1code' => 'PL74',
            ),
            344 => 
            array (
                'id' => 3277,
                'country_id' => 197,
                'name' => 'Lubelskie',
                'code' => 'LU',
                'adm1code' => 'PL75',
            ),
            345 => 
            array (
                'id' => 3278,
                'country_id' => 197,
                'name' => 'Lubuskie',
                'code' => 'LB',
                'adm1code' => 'PL76',
            ),
            346 => 
            array (
                'id' => 3279,
                'country_id' => 197,
                'name' => 'Malopolskie',
                'code' => 'MA',
                'adm1code' => 'PL77',
            ),
            347 => 
            array (
                'id' => 3280,
                'country_id' => 197,
                'name' => 'Mazowieckie',
                'code' => 'MZ',
                'adm1code' => 'PL78',
            ),
            348 => 
            array (
                'id' => 3281,
                'country_id' => 197,
                'name' => 'Opolskie',
                'code' => 'OP',
                'adm1code' => 'PL79',
            ),
            349 => 
            array (
                'id' => 3282,
                'country_id' => 197,
                'name' => 'Podkarpackie',
                'code' => 'PK',
                'adm1code' => 'PL80',
            ),
            350 => 
            array (
                'id' => 3283,
                'country_id' => 197,
                'name' => 'Podlaskie',
                'code' => 'PD',
                'adm1code' => 'PL81',
            ),
            351 => 
            array (
                'id' => 3284,
                'country_id' => 197,
                'name' => 'Pomorskie',
                'code' => 'PM',
                'adm1code' => 'PL82',
            ),
            352 => 
            array (
                'id' => 3285,
                'country_id' => 197,
                'name' => 'Slaskie',
                'code' => 'SL',
                'adm1code' => 'PL83',
            ),
            353 => 
            array (
                'id' => 3286,
                'country_id' => 197,
                'name' => 'Swietokrzyskie',
                'code' => 'SK',
                'adm1code' => 'PL84',
            ),
            354 => 
            array (
                'id' => 3287,
                'country_id' => 197,
                'name' => 'Warminsko-Mazurskie',
                'code' => 'WN',
                'adm1code' => 'PL85',
            ),
            355 => 
            array (
                'id' => 3288,
                'country_id' => 197,
                'name' => 'Wielkopolskie',
                'code' => 'WP',
                'adm1code' => 'PL86',
            ),
            356 => 
            array (
                'id' => 3289,
                'country_id' => 197,
                'name' => 'Zachodniopomorskie',
                'code' => 'ZP',
                'adm1code' => 'PL87',
            ),
            357 => 
            array (
                'id' => 3290,
                'country_id' => 190,
                'name' => 'Bocas del Toro',
                'code' => 'BC',
                'adm1code' => 'PM01',
            ),
            358 => 
            array (
                'id' => 3291,
                'country_id' => 190,
                'name' => 'Chiriqui',
                'code' => 'CH',
                'adm1code' => 'PM02',
            ),
            359 => 
            array (
                'id' => 3292,
                'country_id' => 190,
                'name' => 'Cocle',
                'code' => 'CC',
                'adm1code' => 'PM03',
            ),
            360 => 
            array (
                'id' => 3293,
                'country_id' => 190,
                'name' => 'Colon',
                'code' => 'CL',
                'adm1code' => 'PM04',
            ),
            361 => 
            array (
                'id' => 3294,
                'country_id' => 190,
                'name' => 'Darien',
                'code' => 'DR',
                'adm1code' => 'PM05',
            ),
            362 => 
            array (
                'id' => 3295,
                'country_id' => 190,
                'name' => 'Herrera',
                'code' => 'HE',
                'adm1code' => 'PM06',
            ),
            363 => 
            array (
                'id' => 3296,
                'country_id' => 190,
                'name' => 'Los Santos',
                'code' => 'LS',
                'adm1code' => 'PM07',
            ),
            364 => 
            array (
                'id' => 3297,
                'country_id' => 190,
                'name' => 'Panama',
                'code' => 'PN',
                'adm1code' => 'PM08',
            ),
            365 => 
            array (
                'id' => 3298,
                'country_id' => 190,
                'name' => 'San Blas',
                'code' => 'SB',
                'adm1code' => 'PM09',
            ),
            366 => 
            array (
                'id' => 3299,
                'country_id' => 190,
                'name' => 'Veraguas',
                'code' => 'VR',
                'adm1code' => 'PM10',
            ),
            367 => 
            array (
                'id' => 3300,
                'country_id' => 198,
                'name' => 'Aveiro',
                'code' => 'AV',
                'adm1code' => 'PO02',
            ),
            368 => 
            array (
                'id' => 3301,
                'country_id' => 198,
                'name' => 'Beja',
                'code' => 'BE',
                'adm1code' => 'PO03',
            ),
            369 => 
            array (
                'id' => 3302,
                'country_id' => 198,
                'name' => 'Braga',
                'code' => 'BR',
                'adm1code' => 'PO04',
            ),
            370 => 
            array (
                'id' => 3303,
                'country_id' => 198,
                'name' => 'Braganca',
                'code' => 'BA',
                'adm1code' => 'PO05',
            ),
            371 => 
            array (
                'id' => 3304,
                'country_id' => 198,
                'name' => 'Castelo Branco',
                'code' => 'CB',
                'adm1code' => 'PO06',
            ),
            372 => 
            array (
                'id' => 3305,
                'country_id' => 198,
                'name' => 'Coimbra',
                'code' => 'CO',
                'adm1code' => 'PO07',
            ),
            373 => 
            array (
                'id' => 3306,
                'country_id' => 198,
                'name' => 'Evora',
                'code' => 'EV',
                'adm1code' => 'PO08',
            ),
            374 => 
            array (
                'id' => 3307,
                'country_id' => 198,
                'name' => 'Faro',
                'code' => 'FA',
                'adm1code' => 'PO09',
            ),
            375 => 
            array (
                'id' => 3308,
                'country_id' => 198,
                'name' => 'Madeira',
                'code' => 'MA',
                'adm1code' => 'PO10',
            ),
            376 => 
            array (
                'id' => 3309,
                'country_id' => 198,
                'name' => 'Guarda',
                'code' => 'GU',
                'adm1code' => 'PO11',
            ),
            377 => 
            array (
                'id' => 3310,
                'country_id' => 198,
                'name' => 'Leiria',
                'code' => 'LE',
                'adm1code' => 'PO13',
            ),
            378 => 
            array (
                'id' => 3311,
                'country_id' => 198,
                'name' => 'Lisboa',
                'code' => 'LI',
                'adm1code' => 'PO14',
            ),
            379 => 
            array (
                'id' => 3312,
                'country_id' => 198,
                'name' => 'Portalegre',
                'code' => 'PA',
                'adm1code' => 'PO16',
            ),
            380 => 
            array (
                'id' => 3313,
                'country_id' => 198,
                'name' => 'Porto',
                'code' => 'PO',
                'adm1code' => 'PO17',
            ),
            381 => 
            array (
                'id' => 3314,
                'country_id' => 198,
                'name' => 'Santarem',
                'code' => 'SA',
                'adm1code' => 'PO18',
            ),
            382 => 
            array (
                'id' => 3315,
                'country_id' => 198,
                'name' => 'Setubal',
                'code' => 'SE',
                'adm1code' => 'PO19',
            ),
            383 => 
            array (
                'id' => 3316,
                'country_id' => 198,
                'name' => 'Viana do Castelo',
                'code' => 'VC',
                'adm1code' => 'PO20',
            ),
            384 => 
            array (
                'id' => 3317,
                'country_id' => 198,
                'name' => 'Vila Real',
                'code' => 'VR',
                'adm1code' => 'PO21',
            ),
            385 => 
            array (
                'id' => 3318,
                'country_id' => 198,
                'name' => 'Viseu',
                'code' => 'VI',
                'adm1code' => 'PO22',
            ),
            386 => 
            array (
                'id' => 3319,
                'country_id' => 198,
                'name' => 'Azores',
                'code' => 'AC',
                'adm1code' => 'PO23',
            ),
            387 => 
            array (
                'id' => 3320,
                'country_id' => 191,
                'name' => 'Central',
                'code' => 'CE',
                'adm1code' => 'PP01',
            ),
            388 => 
            array (
                'id' => 3321,
                'country_id' => 191,
                'name' => 'Gulf',
                'code' => 'GU',
                'adm1code' => 'PP02',
            ),
            389 => 
            array (
                'id' => 3322,
                'country_id' => 191,
                'name' => 'Milne Bay',
                'code' => 'MB',
                'adm1code' => 'PP03',
            ),
            390 => 
            array (
                'id' => 3323,
                'country_id' => 191,
                'name' => 'Northern',
                'code' => 'NO',
                'adm1code' => 'PP04',
            ),
            391 => 
            array (
                'id' => 3324,
                'country_id' => 191,
                'name' => 'Southern Highlands',
                'code' => 'SH',
                'adm1code' => 'PP05',
            ),
            392 => 
            array (
                'id' => 3325,
                'country_id' => 191,
                'name' => 'Western',
                'code' => 'WE',
                'adm1code' => 'PP06',
            ),
            393 => 
            array (
                'id' => 3326,
                'country_id' => 191,
                'name' => 'Bougainville',
                'code' => 'NS',
                'adm1code' => 'PP07',
            ),
            394 => 
            array (
                'id' => 3327,
                'country_id' => 191,
                'name' => 'Chimbu',
                'code' => 'CH',
                'adm1code' => 'PP08',
            ),
            395 => 
            array (
                'id' => 3328,
                'country_id' => 191,
                'name' => 'Eastern Highlands',
                'code' => 'EH',
                'adm1code' => 'PP09',
            ),
            396 => 
            array (
                'id' => 3329,
                'country_id' => 191,
                'name' => 'East New Britain',
                'code' => 'EN',
                'adm1code' => 'PP10',
            ),
            397 => 
            array (
                'id' => 3330,
                'country_id' => 191,
                'name' => 'East Sepik',
                'code' => 'ES',
                'adm1code' => 'PP11',
            ),
            398 => 
            array (
                'id' => 3331,
                'country_id' => 191,
                'name' => 'Madang',
                'code' => 'MD',
                'adm1code' => 'PP12',
            ),
            399 => 
            array (
                'id' => 3332,
                'country_id' => 191,
                'name' => 'Manus',
                'code' => 'MN',
                'adm1code' => 'PP13',
            ),
            400 => 
            array (
                'id' => 3333,
                'country_id' => 191,
                'name' => 'Morobe',
                'code' => 'MR',
                'adm1code' => 'PP14',
            ),
            401 => 
            array (
                'id' => 3334,
                'country_id' => 191,
                'name' => 'New Ireland',
                'code' => 'NI',
                'adm1code' => 'PP15',
            ),
            402 => 
            array (
                'id' => 3335,
                'country_id' => 191,
                'name' => 'Western Highlands',
                'code' => 'WH',
                'adm1code' => 'PP16',
            ),
            403 => 
            array (
                'id' => 3336,
                'country_id' => 191,
                'name' => 'West New Britain',
                'code' => 'WN',
                'adm1code' => 'PP17',
            ),
            404 => 
            array (
                'id' => 3337,
                'country_id' => 191,
                'name' => 'Sandaun',
                'code' => 'SA',
                'adm1code' => 'PP18',
            ),
            405 => 
            array (
                'id' => 3338,
                'country_id' => 191,
                'name' => 'Enga',
                'code' => 'EG',
                'adm1code' => 'PP19',
            ),
            406 => 
            array (
                'id' => 3339,
                'country_id' => 191,
                'name' => 'National Capital',
                'code' => 'NC',
                'adm1code' => 'PP20',
            ),
            407 => 
            array (
                'id' => 3340,
                'country_id' => 103,
                'name' => 'Bafata',
                'code' => 'BA',
                'adm1code' => 'PU01',
            ),
            408 => 
            array (
                'id' => 3341,
                'country_id' => 103,
                'name' => 'Quinara',
                'code' => 'QU',
                'adm1code' => 'PU02',
            ),
            409 => 
            array (
                'id' => 3342,
                'country_id' => 103,
                'name' => 'Oio',
                'code' => 'OI',
                'adm1code' => 'PU04',
            ),
            410 => 
            array (
                'id' => 3343,
                'country_id' => 103,
                'name' => 'Bolama',
                'code' => 'BL',
                'adm1code' => 'PU05',
            ),
            411 => 
            array (
                'id' => 3344,
                'country_id' => 103,
                'name' => 'Cacheu',
                'code' => 'CA',
                'adm1code' => 'PU06',
            ),
            412 => 
            array (
                'id' => 3345,
                'country_id' => 103,
                'name' => 'Tombali',
                'code' => 'TO',
                'adm1code' => 'PU07',
            ),
            413 => 
            array (
                'id' => 3346,
                'country_id' => 103,
                'name' => 'Gabu',
                'code' => 'GA',
                'adm1code' => 'PU10',
            ),
            414 => 
            array (
                'id' => 3347,
                'country_id' => 103,
                'name' => 'Bissau',
                'code' => 'BS',
                'adm1code' => 'PU11',
            ),
            415 => 
            array (
                'id' => 3348,
                'country_id' => 103,
                'name' => 'Biombo',
                'code' => 'BM',
                'adm1code' => 'PU12',
            ),
            416 => 
            array (
                'id' => 3349,
                'country_id' => 200,
                'name' => 'Ad Dawhah',
                'code' => 'DA',
                'adm1code' => 'QA01',
            ),
            417 => 
            array (
                'id' => 3350,
                'country_id' => 200,
                'name' => 'Al Ghuwayriyah',
                'code' => 'GH',
                'adm1code' => 'QA02',
            ),
            418 => 
            array (
                'id' => 3351,
                'country_id' => 200,
                'name' => 'Al Jumayliyah',
                'code' => 'JU',
                'adm1code' => 'QA03',
            ),
            419 => 
            array (
                'id' => 3352,
                'country_id' => 200,
                'name' => 'Al Khawr',
                'code' => 'KH',
                'adm1code' => 'QA04',
            ),
            420 => 
            array (
                'id' => 3353,
                'country_id' => 200,
                'name' => 'Al Wakrah',
                'code' => 'WA',
                'adm1code' => 'QA05',
            ),
            421 => 
            array (
                'id' => 3354,
                'country_id' => 200,
                'name' => 'Ar Rayyan',
                'code' => 'RA',
                'adm1code' => 'QA06',
            ),
            422 => 
            array (
                'id' => 3355,
                'country_id' => 200,
                'name' => 'Jarayan al Batinah',
                'code' => 'JB',
                'adm1code' => 'QA07',
            ),
            423 => 
            array (
                'id' => 3356,
                'country_id' => 200,
                'name' => 'Madinat ash Shamal',
                'code' => 'MS',
                'adm1code' => 'QA08',
            ),
            424 => 
            array (
                'id' => 3357,
                'country_id' => 200,
                'name' => 'Umm Salal',
                'code' => 'US',
                'adm1code' => 'QA09',
            ),
            425 => 
            array (
                'id' => 3358,
                'country_id' => 202,
                'name' => 'Alba',
                'code' => 'AB',
                'adm1code' => 'RO01',
            ),
            426 => 
            array (
                'id' => 3359,
                'country_id' => 202,
                'name' => 'Arad',
                'code' => 'AR',
                'adm1code' => 'RO02',
            ),
            427 => 
            array (
                'id' => 3360,
                'country_id' => 202,
                'name' => 'Arges',
                'code' => 'AG',
                'adm1code' => 'RO03',
            ),
            428 => 
            array (
                'id' => 3361,
                'country_id' => 202,
                'name' => 'Bacau',
                'code' => 'BC',
                'adm1code' => 'RO04',
            ),
            429 => 
            array (
                'id' => 3362,
                'country_id' => 202,
                'name' => 'Bihor',
                'code' => 'BH',
                'adm1code' => 'RO05',
            ),
            430 => 
            array (
                'id' => 3363,
                'country_id' => 202,
                'name' => 'Bistrita-Nasaud',
                'code' => 'BN',
                'adm1code' => 'RO06',
            ),
            431 => 
            array (
                'id' => 3364,
                'country_id' => 202,
                'name' => 'Botosani',
                'code' => 'BT',
                'adm1code' => 'RO07',
            ),
            432 => 
            array (
                'id' => 3365,
                'country_id' => 202,
                'name' => 'Braila',
                'code' => 'BR',
                'adm1code' => 'RO08',
            ),
            433 => 
            array (
                'id' => 3366,
                'country_id' => 202,
                'name' => 'Brasov',
                'code' => 'BV',
                'adm1code' => 'RO09',
            ),
            434 => 
            array (
                'id' => 3367,
                'country_id' => 202,
                'name' => 'Bucuresti',
                'code' => 'BU',
                'adm1code' => 'RO10',
            ),
            435 => 
            array (
                'id' => 3368,
                'country_id' => 202,
                'name' => 'Buzau',
                'code' => 'BZ',
                'adm1code' => 'RO11',
            ),
            436 => 
            array (
                'id' => 3369,
                'country_id' => 202,
                'name' => 'Caras-Severin',
                'code' => 'CS',
                'adm1code' => 'RO12',
            ),
            437 => 
            array (
                'id' => 3370,
                'country_id' => 202,
                'name' => 'Cluj',
                'code' => 'CJ',
                'adm1code' => 'RO13',
            ),
            438 => 
            array (
                'id' => 3371,
                'country_id' => 202,
                'name' => 'Constanta',
                'code' => 'CT',
                'adm1code' => 'RO14',
            ),
            439 => 
            array (
                'id' => 3372,
                'country_id' => 202,
                'name' => 'Covasna',
                'code' => 'CV',
                'adm1code' => 'RO15',
            ),
            440 => 
            array (
                'id' => 3373,
                'country_id' => 202,
                'name' => 'Dambovita',
                'code' => 'DB',
                'adm1code' => 'RO16',
            ),
            441 => 
            array (
                'id' => 3374,
                'country_id' => 202,
                'name' => 'Dolj',
                'code' => 'DJ',
                'adm1code' => 'RO17',
            ),
            442 => 
            array (
                'id' => 3375,
                'country_id' => 202,
                'name' => 'Galati',
                'code' => 'GL',
                'adm1code' => 'RO18',
            ),
            443 => 
            array (
                'id' => 3376,
                'country_id' => 202,
                'name' => 'Gorj',
                'code' => 'GJ',
                'adm1code' => 'RO19',
            ),
            444 => 
            array (
                'id' => 3377,
                'country_id' => 202,
                'name' => 'Harghita',
                'code' => 'HR',
                'adm1code' => 'RO20',
            ),
            445 => 
            array (
                'id' => 3378,
                'country_id' => 202,
                'name' => 'Hunedoara',
                'code' => 'HD',
                'adm1code' => 'RO21',
            ),
            446 => 
            array (
                'id' => 3379,
                'country_id' => 202,
                'name' => 'Ialomita',
                'code' => 'IL',
                'adm1code' => 'RO22',
            ),
            447 => 
            array (
                'id' => 3380,
                'country_id' => 202,
                'name' => 'Iasi',
                'code' => 'IS',
                'adm1code' => 'RO23',
            ),
            448 => 
            array (
                'id' => 3381,
                'country_id' => 202,
                'name' => 'Maramures',
                'code' => 'MM',
                'adm1code' => 'RO25',
            ),
            449 => 
            array (
                'id' => 3382,
                'country_id' => 202,
                'name' => 'Mehedinti',
                'code' => 'MH',
                'adm1code' => 'RO26',
            ),
            450 => 
            array (
                'id' => 3383,
                'country_id' => 202,
                'name' => 'Mures',
                'code' => 'MS',
                'adm1code' => 'RO27',
            ),
            451 => 
            array (
                'id' => 3384,
                'country_id' => 202,
                'name' => 'Neamt',
                'code' => 'NT',
                'adm1code' => 'RO28',
            ),
            452 => 
            array (
                'id' => 3385,
                'country_id' => 202,
                'name' => 'Olt',
                'code' => 'OT',
                'adm1code' => 'RO29',
            ),
            453 => 
            array (
                'id' => 3386,
                'country_id' => 202,
                'name' => 'Prahova',
                'code' => 'PH',
                'adm1code' => 'RO30',
            ),
            454 => 
            array (
                'id' => 3387,
                'country_id' => 202,
                'name' => 'Salaj',
                'code' => 'SJ',
                'adm1code' => 'RO31',
            ),
            455 => 
            array (
                'id' => 3388,
                'country_id' => 202,
                'name' => 'Satu Mare',
                'code' => 'SM',
                'adm1code' => 'RO32',
            ),
            456 => 
            array (
                'id' => 3389,
                'country_id' => 202,
                'name' => 'Sibiu',
                'code' => 'SB',
                'adm1code' => 'RO33',
            ),
            457 => 
            array (
                'id' => 3390,
                'country_id' => 202,
                'name' => 'Suceava',
                'code' => 'SV',
                'adm1code' => 'RO34',
            ),
            458 => 
            array (
                'id' => 3391,
                'country_id' => 202,
                'name' => 'Teleorman',
                'code' => 'TR',
                'adm1code' => 'RO35',
            ),
            459 => 
            array (
                'id' => 3392,
                'country_id' => 202,
                'name' => 'Timis',
                'code' => 'TM',
                'adm1code' => 'RO36',
            ),
            460 => 
            array (
                'id' => 3393,
                'country_id' => 202,
                'name' => 'Tulcea',
                'code' => 'TL',
                'adm1code' => 'RO37',
            ),
            461 => 
            array (
                'id' => 3394,
                'country_id' => 202,
                'name' => 'Vaslui',
                'code' => 'VS',
                'adm1code' => 'RO38',
            ),
            462 => 
            array (
                'id' => 3395,
                'country_id' => 202,
                'name' => 'Valcea',
                'code' => 'VL',
                'adm1code' => 'RO39',
            ),
            463 => 
            array (
                'id' => 3396,
                'country_id' => 202,
                'name' => 'Vrancea',
                'code' => 'VN',
                'adm1code' => 'RO40',
            ),
            464 => 
            array (
                'id' => 3397,
                'country_id' => 202,
                'name' => 'Calarasi',
                'code' => 'CL',
                'adm1code' => 'RO41',
            ),
            465 => 
            array (
                'id' => 3398,
                'country_id' => 202,
                'name' => 'Giurgiu',
                'code' => 'GR',
                'adm1code' => 'RO42',
            ),
            466 => 
            array (
                'id' => 3399,
                'country_id' => 195,
                'name' => 'Abra',
                'code' => 'AB',
                'adm1code' => 'RP01',
            ),
            467 => 
            array (
                'id' => 3400,
                'country_id' => 195,
                'name' => 'Agusan del Norte',
                'code' => 'AN',
                'adm1code' => 'RP02',
            ),
            468 => 
            array (
                'id' => 3401,
                'country_id' => 195,
                'name' => 'Agusan del Sur',
                'code' => 'AS',
                'adm1code' => 'RP03',
            ),
            469 => 
            array (
                'id' => 3402,
                'country_id' => 195,
                'name' => 'Aklan',
                'code' => 'AK',
                'adm1code' => 'RP04',
            ),
            470 => 
            array (
                'id' => 3403,
                'country_id' => 195,
                'name' => 'Albay',
                'code' => 'AL',
                'adm1code' => 'RP05',
            ),
            471 => 
            array (
                'id' => 3404,
                'country_id' => 195,
                'name' => 'Antique',
                'code' => 'AQ',
                'adm1code' => 'RP06',
            ),
            472 => 
            array (
                'id' => 3405,
                'country_id' => 195,
                'name' => 'Bataan',
                'code' => 'BA',
                'adm1code' => 'RP07',
            ),
            473 => 
            array (
                'id' => 3406,
                'country_id' => 195,
                'name' => 'Batanes',
                'code' => 'BN',
                'adm1code' => 'RP08',
            ),
            474 => 
            array (
                'id' => 3407,
                'country_id' => 195,
                'name' => 'Batangas',
                'code' => 'BT',
                'adm1code' => 'RP09',
            ),
            475 => 
            array (
                'id' => 3408,
                'country_id' => 195,
                'name' => 'Benguet',
                'code' => 'BG',
                'adm1code' => 'RP10',
            ),
            476 => 
            array (
                'id' => 3409,
                'country_id' => 195,
                'name' => 'Bohol',
                'code' => 'BO',
                'adm1code' => 'RP11',
            ),
            477 => 
            array (
                'id' => 3410,
                'country_id' => 195,
                'name' => 'Bukidnon',
                'code' => 'BK',
                'adm1code' => 'RP12',
            ),
            478 => 
            array (
                'id' => 3411,
                'country_id' => 195,
                'name' => 'Bulacan',
                'code' => 'BU',
                'adm1code' => 'RP13',
            ),
            479 => 
            array (
                'id' => 3412,
                'country_id' => 195,
                'name' => 'Cagayan',
                'code' => 'CG',
                'adm1code' => 'RP14',
            ),
            480 => 
            array (
                'id' => 3413,
                'country_id' => 195,
                'name' => 'Camarines Norte',
                'code' => 'CN',
                'adm1code' => 'RP15',
            ),
            481 => 
            array (
                'id' => 3414,
                'country_id' => 195,
                'name' => 'Camarines Sur',
                'code' => 'CS',
                'adm1code' => 'RP16',
            ),
            482 => 
            array (
                'id' => 3415,
                'country_id' => 195,
                'name' => 'Camiguin',
                'code' => 'CM',
                'adm1code' => 'RP17',
            ),
            483 => 
            array (
                'id' => 3416,
                'country_id' => 195,
                'name' => 'Capiz',
                'code' => 'CP',
                'adm1code' => 'RP18',
            ),
            484 => 
            array (
                'id' => 3417,
                'country_id' => 195,
                'name' => 'Catanduanes',
                'code' => 'CT',
                'adm1code' => 'RP19',
            ),
            485 => 
            array (
                'id' => 3418,
                'country_id' => 195,
                'name' => 'Cavite',
                'code' => 'CV',
                'adm1code' => 'RP20',
            ),
            486 => 
            array (
                'id' => 3419,
                'country_id' => 195,
                'name' => 'Cebu',
                'code' => 'CB',
                'adm1code' => 'RP21',
            ),
            487 => 
            array (
                'id' => 3420,
                'country_id' => 195,
                'name' => 'Basilan',
                'code' => 'BS',
                'adm1code' => 'RP22',
            ),
            488 => 
            array (
                'id' => 3421,
                'country_id' => 195,
                'name' => 'Eastern Samar',
                'code' => 'ES',
                'adm1code' => 'RP23',
            ),
            489 => 
            array (
                'id' => 3422,
                'country_id' => 195,
                'name' => 'Davao del Norte',
                'code' => 'DV',
                'adm1code' => 'RP24',
            ),
            490 => 
            array (
                'id' => 3423,
                'country_id' => 195,
                'name' => 'Davao del Sur',
                'code' => 'DS',
                'adm1code' => 'RP25',
            ),
            491 => 
            array (
                'id' => 3424,
                'country_id' => 195,
                'name' => 'Davao Oriental',
                'code' => 'DO',
                'adm1code' => 'RP26',
            ),
            492 => 
            array (
                'id' => 3425,
                'country_id' => 195,
                'name' => 'Ifugao',
                'code' => 'IF',
                'adm1code' => 'RP27',
            ),
            493 => 
            array (
                'id' => 3426,
                'country_id' => 195,
                'name' => 'Ilocos Norte',
                'code' => 'IN',
                'adm1code' => 'RP28',
            ),
            494 => 
            array (
                'id' => 3427,
                'country_id' => 195,
                'name' => 'Ilocos Sur',
                'code' => 'IS',
                'adm1code' => 'RP29',
            ),
            495 => 
            array (
                'id' => 3428,
                'country_id' => 195,
                'name' => 'Iloilo',
                'code' => 'II',
                'adm1code' => 'RP30',
            ),
            496 => 
            array (
                'id' => 3429,
                'country_id' => 195,
                'name' => 'Isabela',
                'code' => 'IB',
                'adm1code' => 'RP31',
            ),
            497 => 
            array (
                'id' => 3430,
                'country_id' => 195,
                'name' => 'Kalinga-Apayao',
                'code' => 'KA',
                'adm1code' => 'RP32',
            ),
            498 => 
            array (
                'id' => 3431,
                'country_id' => 195,
                'name' => 'Laguna',
                'code' => 'LG',
                'adm1code' => 'RP33',
            ),
            499 => 
            array (
                'id' => 3432,
                'country_id' => 195,
                'name' => 'Lanao del Norte',
                'code' => 'LN',
                'adm1code' => 'RP34',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 3433,
                'country_id' => 195,
                'name' => 'Lanao del Sur',
                'code' => 'LS',
                'adm1code' => 'RP35',
            ),
            1 => 
            array (
                'id' => 3434,
                'country_id' => 195,
                'name' => 'La Union',
                'code' => 'LB',
                'adm1code' => 'RP36',
            ),
            2 => 
            array (
                'id' => 3435,
                'country_id' => 195,
                'name' => 'Leyte',
                'code' => 'LY',
                'adm1code' => 'RP37',
            ),
            3 => 
            array (
                'id' => 3436,
                'country_id' => 195,
                'name' => 'Marinduque',
                'code' => 'MQ',
                'adm1code' => 'RP38',
            ),
            4 => 
            array (
                'id' => 3437,
                'country_id' => 195,
                'name' => 'Masbate',
                'code' => 'MB',
                'adm1code' => 'RP39',
            ),
            5 => 
            array (
                'id' => 3438,
                'country_id' => 195,
                'name' => 'Mindoro Occidental',
                'code' => 'MC',
                'adm1code' => 'RP40',
            ),
            6 => 
            array (
                'id' => 3439,
                'country_id' => 195,
                'name' => 'Mindoro Oriental',
                'code' => 'MR',
                'adm1code' => 'RP41',
            ),
            7 => 
            array (
                'id' => 3440,
                'country_id' => 195,
                'name' => 'Misamis Occidental',
                'code' => 'MD',
                'adm1code' => 'RP42',
            ),
            8 => 
            array (
                'id' => 3441,
                'country_id' => 195,
                'name' => 'Misamis Oriental',
                'code' => 'MN',
                'adm1code' => 'RP43',
            ),
            9 => 
            array (
                'id' => 3442,
                'country_id' => 195,
                'name' => 'Mountain',
                'code' => 'MT',
                'adm1code' => 'RP44',
            ),
            10 => 
            array (
                'id' => 3443,
                'country_id' => 195,
                'name' => 'RP45',
                'code' => 'RP',
                'adm1code' => 'RP45',
            ),
            11 => 
            array (
                'id' => 3444,
                'country_id' => 195,
                'name' => 'Negros Oriental',
                'code' => 'NR',
                'adm1code' => 'RP46',
            ),
            12 => 
            array (
                'id' => 3445,
                'country_id' => 195,
                'name' => 'Nueva Ecija',
                'code' => 'NE',
                'adm1code' => 'RP47',
            ),
            13 => 
            array (
                'id' => 3446,
                'country_id' => 195,
                'name' => 'Nueva Vizcaya',
                'code' => 'NV',
                'adm1code' => 'RP48',
            ),
            14 => 
            array (
                'id' => 3447,
                'country_id' => 195,
                'name' => 'Palawan',
                'code' => 'PL',
                'adm1code' => 'RP49',
            ),
            15 => 
            array (
                'id' => 3448,
                'country_id' => 195,
                'name' => 'Pampanga',
                'code' => 'PM',
                'adm1code' => 'RP50',
            ),
            16 => 
            array (
                'id' => 3449,
                'country_id' => 195,
                'name' => 'Pangasinan',
                'code' => 'PN',
                'adm1code' => 'RP51',
            ),
            17 => 
            array (
                'id' => 3450,
                'country_id' => 195,
                'name' => 'Rizal',
                'code' => 'RI',
                'adm1code' => 'RP53',
            ),
            18 => 
            array (
                'id' => 3451,
                'country_id' => 195,
                'name' => 'Romblon',
                'code' => 'RM',
                'adm1code' => 'RP54',
            ),
            19 => 
            array (
                'id' => 3452,
                'country_id' => 195,
                'name' => 'Samar',
                'code' => 'SM',
                'adm1code' => 'RP55',
            ),
            20 => 
            array (
                'id' => 3453,
                'country_id' => 195,
                'name' => 'Maguindanao',
                'code' => 'MG',
                'adm1code' => 'RP56',
            ),
            21 => 
            array (
                'id' => 3454,
                'country_id' => 195,
                'name' => 'North Cotabato',
                'code' => 'NC',
                'adm1code' => 'RP57',
            ),
            22 => 
            array (
                'id' => 3455,
                'country_id' => 195,
                'name' => 'Sorsogon',
                'code' => 'SR',
                'adm1code' => 'RP58',
            ),
            23 => 
            array (
                'id' => 3456,
                'country_id' => 195,
                'name' => 'Southern Leyte',
                'code' => 'SL',
                'adm1code' => 'RP59',
            ),
            24 => 
            array (
                'id' => 3457,
                'country_id' => 195,
                'name' => 'Sulu',
                'code' => 'SU',
                'adm1code' => 'RP60',
            ),
            25 => 
            array (
                'id' => 3458,
                'country_id' => 195,
                'name' => 'Surigao del Norte',
                'code' => 'SN',
                'adm1code' => 'RP61',
            ),
            26 => 
            array (
                'id' => 3459,
                'country_id' => 195,
                'name' => 'Surigao del Sur',
                'code' => 'SS',
                'adm1code' => 'RP62',
            ),
            27 => 
            array (
                'id' => 3460,
                'country_id' => 195,
                'name' => 'Tarlac',
                'code' => 'TR',
                'adm1code' => 'RP63',
            ),
            28 => 
            array (
                'id' => 3461,
                'country_id' => 195,
                'name' => 'Zambales',
                'code' => 'ZM',
                'adm1code' => 'RP64',
            ),
            29 => 
            array (
                'id' => 3462,
                'country_id' => 195,
                'name' => 'Zamboanga del Norte',
                'code' => 'ZN',
                'adm1code' => 'RP65',
            ),
            30 => 
            array (
                'id' => 3463,
                'country_id' => 195,
                'name' => 'Zamboanga del Sur',
                'code' => 'ZS',
                'adm1code' => 'RP66',
            ),
            31 => 
            array (
                'id' => 3464,
                'country_id' => 195,
                'name' => 'Northern Samar',
                'code' => 'NS',
                'adm1code' => 'RP67',
            ),
            32 => 
            array (
                'id' => 3465,
                'country_id' => 195,
                'name' => 'Quirino',
                'code' => 'QR',
                'adm1code' => 'RP68',
            ),
            33 => 
            array (
                'id' => 3466,
                'country_id' => 195,
                'name' => 'Siquijor',
                'code' => 'SQ',
                'adm1code' => 'RP69',
            ),
            34 => 
            array (
                'id' => 3467,
                'country_id' => 195,
                'name' => 'South Cotabato',
                'code' => 'SC',
                'adm1code' => 'RP70',
            ),
            35 => 
            array (
                'id' => 3468,
                'country_id' => 195,
                'name' => 'Sultan Kudarat',
                'code' => 'SK',
                'adm1code' => 'RP71',
            ),
            36 => 
            array (
                'id' => 3469,
                'country_id' => 195,
                'name' => 'Tawi-Tawi',
                'code' => 'TT',
                'adm1code' => 'RP72',
            ),
            37 => 
            array (
                'id' => 3470,
                'country_id' => 195,
                'name' => 'Angeles',
                'code' => 'AG',
                'adm1code' => 'RPA1',
            ),
            38 => 
            array (
                'id' => 3471,
                'country_id' => 195,
                'name' => 'Bacolod',
                'code' => 'BL',
                'adm1code' => 'RPA2',
            ),
            39 => 
            array (
                'id' => 3472,
                'country_id' => 195,
                'name' => 'Bago',
                'code' => 'BB',
                'adm1code' => 'RPA3',
            ),
            40 => 
            array (
                'id' => 3473,
                'country_id' => 195,
                'name' => 'Baguio',
                'code' => 'BI',
                'adm1code' => 'RPA4',
            ),
            41 => 
            array (
                'id' => 3474,
                'country_id' => 195,
                'name' => 'Bais',
                'code' => 'BD',
                'adm1code' => 'RPA5',
            ),
            42 => 
            array (
                'id' => 3475,
                'country_id' => 195,
                'name' => 'Basilan City',
                'code' => 'BC',
                'adm1code' => 'RPA6',
            ),
            43 => 
            array (
                'id' => 3476,
                'country_id' => 195,
                'name' => 'Batangas City',
                'code' => 'BY',
                'adm1code' => 'RPA7',
            ),
            44 => 
            array (
                'id' => 3477,
                'country_id' => 195,
                'name' => 'Butuan',
                'code' => 'BV',
                'adm1code' => 'RPA8',
            ),
            45 => 
            array (
                'id' => 3478,
                'country_id' => 195,
                'name' => 'Cabanatuan',
                'code' => 'CA',
                'adm1code' => 'RPA9',
            ),
            46 => 
            array (
                'id' => 3479,
                'country_id' => 195,
                'name' => 'Cadiz',
                'code' => 'CI',
                'adm1code' => 'RPB1',
            ),
            47 => 
            array (
                'id' => 3480,
                'country_id' => 195,
                'name' => 'Cagayan de Oro',
                'code' => 'CD',
                'adm1code' => 'RPB2',
            ),
            48 => 
            array (
                'id' => 3481,
                'country_id' => 195,
                'name' => 'Calbayog',
                'code' => 'CL',
                'adm1code' => 'RPB3',
            ),
            49 => 
            array (
                'id' => 3482,
                'country_id' => 195,
                'name' => 'Caloocan',
                'code' => 'CF',
                'adm1code' => 'RPB4',
            ),
            50 => 
            array (
                'id' => 3483,
                'country_id' => 195,
                'name' => 'Canlaon',
                'code' => 'CH',
                'adm1code' => 'RPB5',
            ),
            51 => 
            array (
                'id' => 3484,
                'country_id' => 195,
                'name' => 'Cavite City',
                'code' => 'CE',
                'adm1code' => 'RPB6',
            ),
            52 => 
            array (
                'id' => 3485,
                'country_id' => 195,
                'name' => 'Cebu City',
                'code' => 'CU',
                'adm1code' => 'RPB7',
            ),
            53 => 
            array (
                'id' => 3486,
                'country_id' => 195,
                'name' => 'Cotabato',
                'code' => 'CO',
                'adm1code' => 'RPB8',
            ),
            54 => 
            array (
                'id' => 3487,
                'country_id' => 195,
                'name' => 'Dagupan',
                'code' => 'DA',
                'adm1code' => 'RPB9',
            ),
            55 => 
            array (
                'id' => 3488,
                'country_id' => 195,
                'name' => 'Danao',
                'code' => 'DN',
                'adm1code' => 'RPC1',
            ),
            56 => 
            array (
                'id' => 3489,
                'country_id' => 195,
                'name' => 'Dapitane',
                'code' => 'DP',
                'adm1code' => 'RPC2',
            ),
            57 => 
            array (
                'id' => 3490,
                'country_id' => 195,
                'name' => 'Davao City',
                'code' => 'DC',
                'adm1code' => 'RPC3',
            ),
            58 => 
            array (
                'id' => 3491,
                'country_id' => 195,
                'name' => 'Dipolog',
                'code' => 'DI',
                'adm1code' => 'RPC4',
            ),
            59 => 
            array (
                'id' => 3492,
                'country_id' => 195,
                'name' => 'Dumaguete',
                'code' => 'DU',
                'adm1code' => 'RPC5',
            ),
            60 => 
            array (
                'id' => 3493,
                'country_id' => 195,
                'name' => 'General Santos',
                'code' => 'GS',
                'adm1code' => 'RPC6',
            ),
            61 => 
            array (
                'id' => 3494,
                'country_id' => 195,
                'name' => 'Gingoog',
                'code' => 'GI',
                'adm1code' => 'RPC7',
            ),
            62 => 
            array (
                'id' => 3495,
                'country_id' => 195,
                'name' => 'Iligan',
                'code' => 'IL',
                'adm1code' => 'RPC8',
            ),
            63 => 
            array (
                'id' => 3496,
                'country_id' => 195,
                'name' => 'Iloilo City',
                'code' => 'IC',
                'adm1code' => 'RPC9',
            ),
            64 => 
            array (
                'id' => 3497,
                'country_id' => 195,
                'name' => 'Iriga',
                'code' => 'IR',
                'adm1code' => 'RPD1',
            ),
            65 => 
            array (
                'id' => 3498,
                'country_id' => 195,
                'name' => 'La Carlota',
                'code' => 'LC',
                'adm1code' => 'RPD2',
            ),
            66 => 
            array (
                'id' => 3499,
                'country_id' => 195,
                'name' => 'Laoag',
                'code' => 'LO',
                'adm1code' => 'RPD3',
            ),
            67 => 
            array (
                'id' => 3500,
                'country_id' => 195,
                'name' => 'LapuLapu',
                'code' => 'LA',
                'adm1code' => 'RPD4',
            ),
            68 => 
            array (
                'id' => 3501,
                'country_id' => 195,
                'name' => 'Legaspi',
                'code' => 'LE',
                'adm1code' => 'RPD5',
            ),
            69 => 
            array (
                'id' => 3502,
                'country_id' => 195,
                'name' => 'Lipa',
                'code' => 'LI',
                'adm1code' => 'RPD6',
            ),
            70 => 
            array (
                'id' => 3503,
                'country_id' => 195,
                'name' => 'Lucena',
                'code' => 'LU',
                'adm1code' => 'RPD7',
            ),
            71 => 
            array (
                'id' => 3504,
                'country_id' => 195,
                'name' => 'Mandaue',
                'code' => 'MU',
                'adm1code' => 'RPD8',
            ),
            72 => 
            array (
                'id' => 3505,
                'country_id' => 195,
                'name' => 'Manila',
                'code' => 'MM',
                'adm1code' => 'RPD9',
            ),
            73 => 
            array (
                'id' => 3506,
                'country_id' => 195,
                'name' => 'Marawi',
                'code' => 'MA',
                'adm1code' => 'RPE1',
            ),
            74 => 
            array (
                'id' => 3507,
                'country_id' => 195,
                'name' => 'Naga',
                'code' => 'NA',
                'adm1code' => 'RPE2',
            ),
            75 => 
            array (
                'id' => 3508,
                'country_id' => 195,
                'name' => 'Olongapo',
                'code' => 'OL',
                'adm1code' => 'RPE3',
            ),
            76 => 
            array (
                'id' => 3509,
                'country_id' => 195,
                'name' => 'Ormoc',
                'code' => 'OM',
                'adm1code' => 'RPE4',
            ),
            77 => 
            array (
                'id' => 3510,
                'country_id' => 195,
                'name' => 'Oroquieta',
                'code' => 'OR',
                'adm1code' => 'RPE5',
            ),
            78 => 
            array (
                'id' => 3511,
                'country_id' => 195,
                'name' => 'Ozamis',
                'code' => 'OZ',
                'adm1code' => 'RPE6',
            ),
            79 => 
            array (
                'id' => 3512,
                'country_id' => 195,
                'name' => 'Pagadiane',
                'code' => 'PG',
                'adm1code' => 'RPE7',
            ),
            80 => 
            array (
                'id' => 3513,
                'country_id' => 195,
                'name' => 'Palayan',
                'code' => 'PY',
                'adm1code' => 'RPE8',
            ),
            81 => 
            array (
                'id' => 3514,
                'country_id' => 195,
                'name' => 'Pasay',
                'code' => 'PA',
                'adm1code' => 'RPE9',
            ),
            82 => 
            array (
                'id' => 3515,
                'country_id' => 195,
                'name' => 'Puerto Princesa',
                'code' => 'PP',
                'adm1code' => 'RPF1',
            ),
            83 => 
            array (
                'id' => 3516,
                'country_id' => 195,
                'name' => 'Quezon City',
                'code' => 'QC',
                'adm1code' => 'RPF2',
            ),
            84 => 
            array (
                'id' => 3517,
                'country_id' => 195,
                'name' => 'Roxas',
                'code' => 'RO',
                'adm1code' => 'RPF3',
            ),
            85 => 
            array (
                'id' => 3518,
                'country_id' => 195,
                'name' => 'Negros Occidental San Carlos',
                'code' => 'SA',
                'adm1code' => 'RPF4',
            ),
            86 => 
            array (
                'id' => 3519,
                'country_id' => 195,
                'name' => 'Pangasinan San Carlos',
                'code' => 'SO',
                'adm1code' => 'RPF5',
            ),
            87 => 
            array (
                'id' => 3520,
                'country_id' => 195,
                'name' => 'San Jose',
                'code' => 'SJ',
                'adm1code' => 'RPF6',
            ),
            88 => 
            array (
                'id' => 3521,
                'country_id' => 195,
                'name' => 'San Pablo',
                'code' => 'SP',
                'adm1code' => 'RPF7',
            ),
            89 => 
            array (
                'id' => 3522,
                'country_id' => 195,
                'name' => 'Silay',
                'code' => 'SI',
                'adm1code' => 'RPF8',
            ),
            90 => 
            array (
                'id' => 3523,
                'country_id' => 195,
                'name' => 'Surigao',
                'code' => 'SG',
                'adm1code' => 'RPF9',
            ),
            91 => 
            array (
                'id' => 3524,
                'country_id' => 195,
                'name' => 'Tacloban',
                'code' => 'TC',
                'adm1code' => 'RPG1',
            ),
            92 => 
            array (
                'id' => 3525,
                'country_id' => 195,
                'name' => 'Tagaytay',
                'code' => 'TG',
                'adm1code' => 'RPG2',
            ),
            93 => 
            array (
                'id' => 3526,
                'country_id' => 195,
                'name' => 'Tagbilaran',
                'code' => 'TB',
                'adm1code' => 'RPG3',
            ),
            94 => 
            array (
                'id' => 3527,
                'country_id' => 195,
                'name' => 'Tangub',
                'code' => 'TA',
                'adm1code' => 'RPG4',
            ),
            95 => 
            array (
                'id' => 3528,
                'country_id' => 195,
                'name' => 'Toledo',
                'code' => 'TO',
                'adm1code' => 'RPG5',
            ),
            96 => 
            array (
                'id' => 3529,
                'country_id' => 195,
                'name' => 'Trece Martires',
                'code' => 'TM',
                'adm1code' => 'RPG6',
            ),
            97 => 
            array (
                'id' => 3530,
                'country_id' => 195,
                'name' => 'Zamboanga',
                'code' => 'ZA',
                'adm1code' => 'RPG7',
            ),
            98 => 
            array (
                'id' => 3531,
                'country_id' => 195,
                'name' => 'Aurora',
                'code' => 'AU',
                'adm1code' => 'RPG8',
            ),
            99 => 
            array (
                'id' => 3532,
                'country_id' => 195,
                'name' => 'Quezon',
                'code' => 'QZ',
                'adm1code' => 'RPH2',
            ),
            100 => 
            array (
                'id' => 3533,
                'country_id' => 195,
                'name' => 'Negros Occidental',
                'code' => 'ND',
                'adm1code' => 'RPH3',
            ),
            101 => 
            array (
                'id' => 3534,
                'country_id' => 203,
                'name' => 'Adygeya',
                'code' => 'AD',
                'adm1code' => 'RS01',
            ),
            102 => 
            array (
                'id' => 3535,
                'country_id' => 203,
                'name' => 'Aginskiy Buryatskiy Avtonomnyy Okrug',
                'code' => 'AB',
                'adm1code' => 'RS02',
            ),
            103 => 
            array (
                'id' => 3536,
                'country_id' => 203,
                'name' => 'Altay',
                'code' => 'GA',
                'adm1code' => 'RS03',
            ),
            104 => 
            array (
                'id' => 3537,
                'country_id' => 203,
                'name' => 'Altayskiy Kray',
                'code' => 'AL',
                'adm1code' => 'RS04',
            ),
            105 => 
            array (
                'id' => 3538,
                'country_id' => 203,
                'name' => 'Amurskaya Oblast\'',
                'code' => 'AM',
                'adm1code' => 'RS05',
            ),
            106 => 
            array (
                'id' => 3539,
                'country_id' => 203,
                'name' => 'Arkhangel\'skaya Oblast\'',
                'code' => 'AR',
                'adm1code' => 'RS06',
            ),
            107 => 
            array (
                'id' => 3540,
                'country_id' => 203,
                'name' => 'Astrakhanskaya Oblast\'',
                'code' => 'AS',
                'adm1code' => 'RS07',
            ),
            108 => 
            array (
                'id' => 3541,
                'country_id' => 203,
                'name' => 'Bashkortostan',
                'code' => 'BK',
                'adm1code' => 'RS08',
            ),
            109 => 
            array (
                'id' => 3542,
                'country_id' => 203,
                'name' => 'Belgorodskaya Oblast\'',
                'code' => 'BL',
                'adm1code' => 'RS09',
            ),
            110 => 
            array (
                'id' => 3543,
                'country_id' => 203,
                'name' => 'Bryanskaya Oblast\'',
                'code' => 'BR',
                'adm1code' => 'RS10',
            ),
            111 => 
            array (
                'id' => 3544,
                'country_id' => 203,
                'name' => 'Buryatiya',
                'code' => 'BU',
                'adm1code' => 'RS11',
            ),
            112 => 
            array (
                'id' => 3545,
                'country_id' => 203,
                'name' => 'Chechnya',
                'code' => 'CN',
                'adm1code' => 'RS12',
            ),
            113 => 
            array (
                'id' => 3546,
                'country_id' => 203,
                'name' => 'Chelyabinskaya Oblast\'',
                'code' => 'CL',
                'adm1code' => 'RS13',
            ),
            114 => 
            array (
                'id' => 3547,
                'country_id' => 203,
                'name' => 'Chitinskaya Oblast\'',
                'code' => 'CT',
                'adm1code' => 'RS14',
            ),
            115 => 
            array (
                'id' => 3548,
                'country_id' => 203,
                'name' => 'Chukotskiy Avtonomnyy Okrug',
                'code' => 'CK',
                'adm1code' => 'RS15',
            ),
            116 => 
            array (
                'id' => 3549,
                'country_id' => 203,
                'name' => 'Chuvashiya',
                'code' => 'CV',
                'adm1code' => 'RS16',
            ),
            117 => 
            array (
                'id' => 3550,
                'country_id' => 203,
                'name' => 'Evenkiyskiy Avtonomnyy Okrug',
                'code' => 'EN',
                'adm1code' => 'RS18',
            ),
            118 => 
            array (
                'id' => 3551,
                'country_id' => 203,
                'name' => 'Ingushetiya',
                'code' => 'IN',
                'adm1code' => 'RS19',
            ),
            119 => 
            array (
                'id' => 3552,
                'country_id' => 203,
                'name' => 'Irkutskaya Oblast\'',
                'code' => 'IR',
                'adm1code' => 'RS20',
            ),
            120 => 
            array (
                'id' => 3553,
                'country_id' => 203,
                'name' => 'Ivanovskaya Oblast\'',
                'code' => 'IV',
                'adm1code' => 'RS21',
            ),
            121 => 
            array (
                'id' => 3554,
                'country_id' => 203,
                'name' => 'Kabardino-Balkariya',
                'code' => 'KB',
                'adm1code' => 'RS22',
            ),
            122 => 
            array (
                'id' => 3555,
                'country_id' => 203,
                'name' => 'Kaliningradskaya Oblast\'',
                'code' => 'KN',
                'adm1code' => 'RS23',
            ),
            123 => 
            array (
                'id' => 3556,
                'country_id' => 203,
                'name' => 'Kalmykiya',
                'code' => 'KL',
                'adm1code' => 'RS24',
            ),
            124 => 
            array (
                'id' => 3557,
                'country_id' => 203,
                'name' => 'Kaluzhskaya Oblast\'',
                'code' => 'KG',
                'adm1code' => 'RS25',
            ),
            125 => 
            array (
                'id' => 3558,
                'country_id' => 203,
                'name' => 'Kamchatskaya Oblast\'',
                'code' => 'KA',
                'adm1code' => 'RS26',
            ),
            126 => 
            array (
                'id' => 3559,
                'country_id' => 203,
                'name' => 'Karachayevo-Cherkesiya',
                'code' => 'KC',
                'adm1code' => 'RS27',
            ),
            127 => 
            array (
                'id' => 3560,
                'country_id' => 203,
                'name' => 'Kareliya',
                'code' => 'KI',
                'adm1code' => 'RS28',
            ),
            128 => 
            array (
                'id' => 3561,
                'country_id' => 203,
                'name' => 'Kemerovskaya Oblast\'',
                'code' => 'KE',
                'adm1code' => 'RS29',
            ),
            129 => 
            array (
                'id' => 3562,
                'country_id' => 203,
                'name' => 'Khabarovskiy Kray',
                'code' => 'KH',
                'adm1code' => 'RS30',
            ),
            130 => 
            array (
                'id' => 3563,
                'country_id' => 203,
                'name' => 'Khakasiya',
                'code' => 'KK',
                'adm1code' => 'RS31',
            ),
            131 => 
            array (
                'id' => 3564,
                'country_id' => 203,
                'name' => 'Khanty-Mansiyskiy Avtonomnyy Okrug',
                'code' => 'KM',
                'adm1code' => 'RS32',
            ),
            132 => 
            array (
                'id' => 3565,
                'country_id' => 203,
                'name' => 'Kirovskaya Oblast\'',
                'code' => 'KV',
                'adm1code' => 'RS33',
            ),
            133 => 
            array (
                'id' => 3566,
                'country_id' => 203,
                'name' => 'Komi-Permyatskiy Avtonomnyy Okrug',
                'code' => 'KP',
                'adm1code' => 'RS35',
            ),
            134 => 
            array (
                'id' => 3567,
                'country_id' => 203,
                'name' => 'Koryakskiy Avtonomnyy Okrug',
                'code' => 'KR',
                'adm1code' => 'RS36',
            ),
            135 => 
            array (
                'id' => 3568,
                'country_id' => 203,
                'name' => 'Kostromskaya Oblast\'',
                'code' => 'KT',
                'adm1code' => 'RS37',
            ),
            136 => 
            array (
                'id' => 3569,
                'country_id' => 203,
                'name' => 'Krasnodarskiy Kray',
                'code' => 'KD',
                'adm1code' => 'RS38',
            ),
            137 => 
            array (
                'id' => 3570,
                'country_id' => 203,
                'name' => 'Krasnoyarskiy Kray',
                'code' => 'KY',
                'adm1code' => 'RS39',
            ),
            138 => 
            array (
                'id' => 3571,
                'country_id' => 203,
                'name' => 'Kurganskaya Oblast\'',
                'code' => 'KU',
                'adm1code' => 'RS40',
            ),
            139 => 
            array (
                'id' => 3572,
                'country_id' => 203,
                'name' => 'Kurskaya Oblast\'',
                'code' => 'KS',
                'adm1code' => 'RS41',
            ),
            140 => 
            array (
                'id' => 3573,
                'country_id' => 203,
                'name' => 'Leningradskaya Oblast\'',
                'code' => 'LN',
                'adm1code' => 'RS42',
            ),
            141 => 
            array (
                'id' => 3574,
                'country_id' => 203,
                'name' => 'Lipetskaya Oblast\'',
                'code' => 'LP',
                'adm1code' => 'RS43',
            ),
            142 => 
            array (
                'id' => 3575,
                'country_id' => 203,
                'name' => 'Magadanskaya Oblast\'',
                'code' => 'MG',
                'adm1code' => 'RS44',
            ),
            143 => 
            array (
                'id' => 3576,
                'country_id' => 203,
                'name' => 'Mordoviya',
                'code' => 'MR',
                'adm1code' => 'RS46',
            ),
            144 => 
            array (
                'id' => 3577,
                'country_id' => 203,
                'name' => 'Moskovskaya Oblast\'',
                'code' => 'MS',
                'adm1code' => 'RS47',
            ),
            145 => 
            array (
                'id' => 3578,
                'country_id' => 203,
                'name' => 'Moskva',
                'code' => 'MC',
                'adm1code' => 'RS48',
            ),
            146 => 
            array (
                'id' => 3579,
                'country_id' => 203,
                'name' => 'Murmanskaya Oblast\'',
                'code' => 'MM',
                'adm1code' => 'RS49',
            ),
            147 => 
            array (
                'id' => 3580,
                'country_id' => 203,
                'name' => 'Nenetskiy Avtonomnyy Okrug',
                'code' => 'NN',
                'adm1code' => 'RS50',
            ),
            148 => 
            array (
                'id' => 3581,
                'country_id' => 203,
                'name' => 'Nizhegorodskaya Oblast\'',
                'code' => 'NZ',
                'adm1code' => 'RS51',
            ),
            149 => 
            array (
                'id' => 3582,
                'country_id' => 203,
                'name' => 'Novgorodskaya Oblast\'',
                'code' => 'NG',
                'adm1code' => 'RS52',
            ),
            150 => 
            array (
                'id' => 3583,
                'country_id' => 203,
                'name' => 'Novosibirskaya Oblast\'',
                'code' => 'NS',
                'adm1code' => 'RS53',
            ),
            151 => 
            array (
                'id' => 3584,
                'country_id' => 203,
                'name' => 'Omskaya Oblast\'',
                'code' => 'OM',
                'adm1code' => 'RS54',
            ),
            152 => 
            array (
                'id' => 3585,
                'country_id' => 203,
                'name' => 'Orenburgskaya Oblast\'',
                'code' => 'OB',
                'adm1code' => 'RS55',
            ),
            153 => 
            array (
                'id' => 3586,
                'country_id' => 203,
                'name' => 'Orlovskaya Oblast\'',
                'code' => 'OL',
                'adm1code' => 'RS56',
            ),
            154 => 
            array (
                'id' => 3587,
                'country_id' => 203,
                'name' => 'Penzenskaya Oblast\'',
                'code' => 'PZ',
                'adm1code' => 'RS57',
            ),
            155 => 
            array (
                'id' => 3588,
                'country_id' => 203,
                'name' => 'Permskaya Oblast\'',
                'code' => 'PM',
                'adm1code' => 'RS58',
            ),
            156 => 
            array (
                'id' => 3589,
                'country_id' => 203,
                'name' => 'Primorskiy Kray',
                'code' => 'PR',
                'adm1code' => 'RS59',
            ),
            157 => 
            array (
                'id' => 3590,
                'country_id' => 203,
                'name' => 'Pskovskaya Oblast\'',
                'code' => 'PS',
                'adm1code' => 'RS60',
            ),
            158 => 
            array (
                'id' => 3591,
                'country_id' => 203,
                'name' => 'Rostovskaya Oblast\'',
                'code' => 'RO',
                'adm1code' => 'RS61',
            ),
            159 => 
            array (
                'id' => 3592,
                'country_id' => 203,
                'name' => 'Ryazanskaya Oblast\'',
                'code' => 'RZ',
                'adm1code' => 'RS62',
            ),
            160 => 
            array (
                'id' => 3593,
                'country_id' => 203,
            'name' => 'Sakha (Yakutiya)',
                'code' => 'SK',
                'adm1code' => 'RS63',
            ),
            161 => 
            array (
                'id' => 3594,
                'country_id' => 203,
                'name' => 'Sakhalinskaya Oblast\'',
                'code' => 'SL',
                'adm1code' => 'RS64',
            ),
            162 => 
            array (
                'id' => 3595,
                'country_id' => 203,
                'name' => 'Samarskaya Oblast\'',
                'code' => 'SA',
                'adm1code' => 'RS65',
            ),
            163 => 
            array (
                'id' => 3596,
                'country_id' => 203,
                'name' => 'Sankt-Peterburg',
                'code' => 'SP',
                'adm1code' => 'RS66',
            ),
            164 => 
            array (
                'id' => 3597,
                'country_id' => 203,
                'name' => 'Saratovskaya Oblast\'',
                'code' => 'SR',
                'adm1code' => 'RS67',
            ),
            165 => 
            array (
                'id' => 3598,
                'country_id' => 203,
                'name' => 'Severnaya Osetiya-Alaniya',
                'code' => 'NO',
                'adm1code' => 'RS68',
            ),
            166 => 
            array (
                'id' => 3599,
                'country_id' => 203,
                'name' => 'Smolenskaya Oblast\'',
                'code' => 'SM',
                'adm1code' => 'RS69',
            ),
            167 => 
            array (
                'id' => 3600,
                'country_id' => 203,
                'name' => 'Stavropol\'skiy Kray',
                'code' => 'ST',
                'adm1code' => 'RS70',
            ),
            168 => 
            array (
                'id' => 3601,
                'country_id' => 203,
                'name' => 'Sverdlovskaya Oblast\'',
                'code' => 'SV',
                'adm1code' => 'RS71',
            ),
            169 => 
            array (
                'id' => 3602,
                'country_id' => 203,
                'name' => 'Tambovskaya Oblast\'',
                'code' => 'TB',
                'adm1code' => 'RS72',
            ),
            170 => 
            array (
                'id' => 3603,
                'country_id' => 203,
                'name' => 'Taymyrskiy Dolgano-Nenetskiy Avtonomnyy Okrug',
                'code' => 'TM',
                'adm1code' => 'RS74',
            ),
            171 => 
            array (
                'id' => 3604,
                'country_id' => 203,
                'name' => 'Tomskaya Oblast\'',
                'code' => 'TO',
                'adm1code' => 'RS75',
            ),
            172 => 
            array (
                'id' => 3605,
                'country_id' => 203,
                'name' => 'Tul\'skaya Oblast\'',
                'code' => 'TL',
                'adm1code' => 'RS76',
            ),
            173 => 
            array (
                'id' => 3606,
                'country_id' => 203,
                'name' => 'Tverskaya Oblast\'',
                'code' => 'TV',
                'adm1code' => 'RS77',
            ),
            174 => 
            array (
                'id' => 3607,
                'country_id' => 203,
                'name' => 'Tyumenskaya Oblast\'',
                'code' => 'TY',
                'adm1code' => 'RS78',
            ),
            175 => 
            array (
                'id' => 3608,
                'country_id' => 203,
                'name' => 'Udmurtiya',
                'code' => 'UD',
                'adm1code' => 'RS80',
            ),
            176 => 
            array (
                'id' => 3609,
                'country_id' => 203,
                'name' => 'Ul\'yanovskaya Oblast\'',
                'code' => 'UL',
                'adm1code' => 'RS81',
            ),
            177 => 
            array (
                'id' => 3610,
                'country_id' => 203,
                'name' => 'Ust\'-Ordynskiy Buryatskiy Avtonomnyy Okrug',
                'code' => 'UB',
                'adm1code' => 'RS82',
            ),
            178 => 
            array (
                'id' => 3611,
                'country_id' => 203,
                'name' => 'Vladimirskaya Oblast\'',
                'code' => 'VL',
                'adm1code' => 'RS83',
            ),
            179 => 
            array (
                'id' => 3612,
                'country_id' => 203,
                'name' => 'Volgogradskaya Oblast\'',
                'code' => 'VG',
                'adm1code' => 'RS84',
            ),
            180 => 
            array (
                'id' => 3613,
                'country_id' => 203,
                'name' => 'Vologodskaya oblast\'',
                'code' => 'VO',
                'adm1code' => 'RS85',
            ),
            181 => 
            array (
                'id' => 3614,
                'country_id' => 203,
                'name' => 'Voronezhskaya Oblast\'',
                'code' => 'VR',
                'adm1code' => 'RS86',
            ),
            182 => 
            array (
                'id' => 3615,
                'country_id' => 203,
                'name' => 'Yamalo-Nenetskiy Avtonomnyy Okrug',
                'code' => 'YN',
                'adm1code' => 'RS87',
            ),
            183 => 
            array (
                'id' => 3616,
                'country_id' => 203,
                'name' => 'Yaroslavskaya Oblast\'',
                'code' => 'YS',
                'adm1code' => 'RS88',
            ),
            184 => 
            array (
                'id' => 3617,
                'country_id' => 203,
                'name' => 'Yevreyskaya Avtonomnyy Oblast\'',
                'code' => 'YV',
                'adm1code' => 'RS89',
            ),
            185 => 
            array (
                'id' => 3619,
                'country_id' => 204,
                'name' => 'Butare',
                'code' => 'BT',
                'adm1code' => 'RW01',
            ),
            186 => 
            array (
                'id' => 3620,
                'country_id' => 204,
                'name' => 'Byumba',
                'code' => 'BM',
                'adm1code' => 'RW02',
            ),
            187 => 
            array (
                'id' => 3621,
                'country_id' => 204,
                'name' => 'Cyangugu',
                'code' => 'CY',
                'adm1code' => 'RW03',
            ),
            188 => 
            array (
                'id' => 3622,
                'country_id' => 204,
                'name' => 'Gikongoro',
                'code' => 'GK',
                'adm1code' => 'RW04',
            ),
            189 => 
            array (
                'id' => 3623,
                'country_id' => 204,
                'name' => 'Gisenyi',
                'code' => 'GS',
                'adm1code' => 'RW05',
            ),
            190 => 
            array (
                'id' => 3624,
                'country_id' => 204,
                'name' => 'Gitarama',
                'code' => 'GT',
                'adm1code' => 'RW06',
            ),
            191 => 
            array (
                'id' => 3625,
                'country_id' => 204,
                'name' => 'Kibungo',
                'code' => 'KN',
                'adm1code' => 'RW07',
            ),
            192 => 
            array (
                'id' => 3626,
                'country_id' => 204,
                'name' => 'Kibuye',
                'code' => 'KY',
                'adm1code' => 'RW08',
            ),
            193 => 
            array (
                'id' => 3627,
                'country_id' => 204,
                'name' => 'Kigali-Rural',
                'code' => 'KR',
                'adm1code' => 'RW09',
            ),
            194 => 
            array (
                'id' => 3628,
                'country_id' => 204,
                'name' => 'Ruhengeri',
                'code' => 'RU',
                'adm1code' => 'RW10',
            ),
            195 => 
            array (
                'id' => 3629,
                'country_id' => 213,
                'name' => 'Al Bahah',
                'code' => 'BA',
                'adm1code' => 'SA02',
            ),
            196 => 
            array (
                'id' => 3630,
                'country_id' => 213,
                'name' => 'Al Madinah',
                'code' => 'MD',
                'adm1code' => 'SA05',
            ),
            197 => 
            array (
                'id' => 3631,
                'country_id' => 213,
                'name' => 'Ash Sharqiyah',
                'code' => 'SH',
                'adm1code' => 'SA06',
            ),
            198 => 
            array (
                'id' => 3632,
                'country_id' => 213,
                'name' => 'Al Qasim',
                'code' => 'QS',
                'adm1code' => 'SA08',
            ),
            199 => 
            array (
                'id' => 3633,
                'country_id' => 213,
                'name' => 'Ar Riyad',
                'code' => 'RI',
                'adm1code' => 'SA10',
            ),
            200 => 
            array (
                'id' => 3634,
                'country_id' => 213,
                'name' => '\'Asir',
                'code' => 'AS',
                'adm1code' => 'SA11',
            ),
            201 => 
            array (
                'id' => 3635,
                'country_id' => 213,
                'name' => 'Ha\'il',
                'code' => 'HA',
                'adm1code' => 'SA13',
            ),
            202 => 
            array (
                'id' => 3636,
                'country_id' => 213,
                'name' => 'Makkah',
                'code' => 'MK',
                'adm1code' => 'SA14',
            ),
            203 => 
            array (
                'id' => 3637,
                'country_id' => 213,
                'name' => 'Al Hudud ash Shamaliyah',
                'code' => 'HS',
                'adm1code' => 'SA15',
            ),
            204 => 
            array (
                'id' => 3638,
                'country_id' => 213,
                'name' => 'Najran',
                'code' => 'NJ',
                'adm1code' => 'SA16',
            ),
            205 => 
            array (
                'id' => 3639,
                'country_id' => 213,
                'name' => 'Jizan',
                'code' => 'JZ',
                'adm1code' => 'SA17',
            ),
            206 => 
            array (
                'id' => 3640,
                'country_id' => 213,
                'name' => 'Tabuk',
                'code' => 'TB',
                'adm1code' => 'SA19',
            ),
            207 => 
            array (
                'id' => 3641,
                'country_id' => 213,
                'name' => 'Al Jawf',
                'code' => 'JF',
                'adm1code' => 'SA20',
            ),
            208 => 
            array (
                'id' => 3643,
                'country_id' => 206,
                'name' => 'Christ Church Nicholatown',
                'code' => 'CC',
                'adm1code' => 'SC01',
            ),
            209 => 
            array (
                'id' => 3644,
                'country_id' => 206,
                'name' => 'Saint Anne Sandy Point',
                'code' => 'AS',
                'adm1code' => 'SC02',
            ),
            210 => 
            array (
                'id' => 3645,
                'country_id' => 206,
                'name' => 'Saint George Basseterre',
                'code' => 'GB',
                'adm1code' => 'SC03',
            ),
            211 => 
            array (
                'id' => 3646,
                'country_id' => 206,
                'name' => 'Saint George Gingerland',
                'code' => 'GG',
                'adm1code' => 'SC04',
            ),
            212 => 
            array (
                'id' => 3647,
                'country_id' => 206,
                'name' => 'Saint James Windward',
                'code' => 'JW',
                'adm1code' => 'SC05',
            ),
            213 => 
            array (
                'id' => 3648,
                'country_id' => 206,
                'name' => 'Saint John Capesterre',
                'code' => 'JC',
                'adm1code' => 'SC06',
            ),
            214 => 
            array (
                'id' => 3649,
                'country_id' => 206,
                'name' => 'Saint John Figtree',
                'code' => 'JF',
                'adm1code' => 'SC07',
            ),
            215 => 
            array (
                'id' => 3650,
                'country_id' => 206,
                'name' => 'Saint Mary Cayon',
                'code' => 'MC',
                'adm1code' => 'SC08',
            ),
            216 => 
            array (
                'id' => 3651,
                'country_id' => 206,
                'name' => 'Saint Paul Capesterre',
                'code' => 'PP',
                'adm1code' => 'SC09',
            ),
            217 => 
            array (
                'id' => 3652,
                'country_id' => 206,
                'name' => 'Saint Paul Charlestown',
                'code' => 'PL',
                'adm1code' => 'SC10',
            ),
            218 => 
            array (
                'id' => 3653,
                'country_id' => 206,
                'name' => 'Saint Peter Basseterre',
                'code' => 'PB',
                'adm1code' => 'SC11',
            ),
            219 => 
            array (
                'id' => 3654,
                'country_id' => 206,
                'name' => 'Saint Thomas Lowland',
                'code' => 'TL',
                'adm1code' => 'SC12',
            ),
            220 => 
            array (
                'id' => 3655,
                'country_id' => 206,
                'name' => 'Saint Thomas Middle Island',
                'code' => 'TM',
                'adm1code' => 'SC13',
            ),
            221 => 
            array (
                'id' => 3656,
                'country_id' => 206,
                'name' => 'Trinity Palmetto Point',
                'code' => 'TP',
                'adm1code' => 'SC15',
            ),
            222 => 
            array (
                'id' => 3657,
                'country_id' => 217,
                'name' => 'Anse aux Pins',
                'code' => 'PI',
                'adm1code' => 'SE01',
            ),
            223 => 
            array (
                'id' => 3658,
                'country_id' => 217,
                'name' => 'Anse Boileau',
                'code' => 'AB',
                'adm1code' => 'SE02',
            ),
            224 => 
            array (
                'id' => 3659,
                'country_id' => 217,
                'name' => 'Anse Etoile',
                'code' => 'ET',
                'adm1code' => 'SE03',
            ),
            225 => 
            array (
                'id' => 3660,
                'country_id' => 217,
                'name' => 'Anse Louis',
                'code' => 'LO',
                'adm1code' => 'SE04',
            ),
            226 => 
            array (
                'id' => 3661,
                'country_id' => 217,
                'name' => 'Anse Royale',
                'code' => 'RO',
                'adm1code' => 'SE05',
            ),
            227 => 
            array (
                'id' => 3662,
                'country_id' => 217,
                'name' => 'Baie Lazare',
                'code' => 'BL',
                'adm1code' => 'SE06',
            ),
            228 => 
            array (
                'id' => 3663,
                'country_id' => 217,
                'name' => 'Baie Sainte Anne',
                'code' => 'BS',
                'adm1code' => 'SE07',
            ),
            229 => 
            array (
                'id' => 3664,
                'country_id' => 217,
                'name' => 'Beau Vallon',
                'code' => 'BV',
                'adm1code' => 'SE08',
            ),
            230 => 
            array (
                'id' => 3665,
                'country_id' => 217,
                'name' => 'Bel Air',
                'code' => 'BA',
                'adm1code' => 'SE09',
            ),
            231 => 
            array (
                'id' => 3666,
                'country_id' => 217,
                'name' => 'Bel Ombre',
                'code' => 'BO',
                'adm1code' => 'SE10',
            ),
            232 => 
            array (
                'id' => 3667,
                'country_id' => 217,
                'name' => 'Cascade',
                'code' => 'CA',
                'adm1code' => 'SE11',
            ),
            233 => 
            array (
                'id' => 3668,
                'country_id' => 217,
                'name' => 'Glacis',
                'code' => 'GL',
                'adm1code' => 'SE12',
            ),
            234 => 
            array (
                'id' => 3669,
                'country_id' => 217,
                'name' => 'Grand\' Anse',
                'code' => 'GP',
                'adm1code' => 'SE14',
            ),
            235 => 
            array (
                'id' => 3670,
                'country_id' => 217,
                'name' => 'La Digue',
                'code' => 'DI',
                'adm1code' => 'SE15',
            ),
            236 => 
            array (
                'id' => 3671,
                'country_id' => 217,
                'name' => 'La Riviere Anglaise',
                'code' => 'RA',
                'adm1code' => 'SE16',
            ),
            237 => 
            array (
                'id' => 3672,
                'country_id' => 217,
                'name' => 'Mont Buxton',
                'code' => 'MB',
                'adm1code' => 'SE17',
            ),
            238 => 
            array (
                'id' => 3673,
                'country_id' => 217,
                'name' => 'Mont Fleuri',
                'code' => 'MF',
                'adm1code' => 'SE18',
            ),
            239 => 
            array (
                'id' => 3674,
                'country_id' => 217,
                'name' => 'Plaisance',
                'code' => 'PL',
                'adm1code' => 'SE19',
            ),
            240 => 
            array (
                'id' => 3675,
                'country_id' => 217,
                'name' => 'Pointe La Rue',
                'code' => 'PR',
                'adm1code' => 'SE20',
            ),
            241 => 
            array (
                'id' => 3676,
                'country_id' => 217,
                'name' => 'Port Glaud',
                'code' => 'PG',
                'adm1code' => 'SE21',
            ),
            242 => 
            array (
                'id' => 3677,
                'country_id' => 217,
                'name' => 'Saint Louis',
                'code' => 'SL',
                'adm1code' => 'SE22',
            ),
            243 => 
            array (
                'id' => 3678,
                'country_id' => 217,
                'name' => 'Takamaka',
                'code' => 'TA',
                'adm1code' => 'SE23',
            ),
            244 => 
            array (
                'id' => 3680,
                'country_id' => 224,
                'name' => 'KwaZulu-Natal',
                'code' => 'NL',
                'adm1code' => 'SF02',
            ),
            245 => 
            array (
                'id' => 3681,
                'country_id' => 224,
                'name' => 'Free State',
                'code' => 'FS',
                'adm1code' => 'SF03',
            ),
            246 => 
            array (
                'id' => 3683,
                'country_id' => 224,
                'name' => 'Eastern Cape',
                'code' => 'EC',
                'adm1code' => 'SF05',
            ),
            247 => 
            array (
                'id' => 3684,
                'country_id' => 224,
                'name' => 'Gauteng',
                'code' => 'GT',
                'adm1code' => 'SF06',
            ),
            248 => 
            array (
                'id' => 3685,
                'country_id' => 224,
                'name' => 'Mpumalanga',
                'code' => 'MP',
                'adm1code' => 'SF07',
            ),
            249 => 
            array (
                'id' => 3686,
                'country_id' => 224,
                'name' => 'Northern Cape',
                'code' => 'NC',
                'adm1code' => 'SF08',
            ),
            250 => 
            array (
                'id' => 3687,
                'country_id' => 224,
                'name' => 'Northern Province',
                'code' => 'NP',
                'adm1code' => 'SF09',
            ),
            251 => 
            array (
                'id' => 3688,
                'country_id' => 224,
                'name' => 'North-West',
                'code' => 'NW',
                'adm1code' => 'SF10',
            ),
            252 => 
            array (
                'id' => 3689,
                'country_id' => 224,
                'name' => 'Western Cape',
                'code' => 'WC',
                'adm1code' => 'SF11',
            ),
            253 => 
            array (
                'id' => 3690,
                'country_id' => 214,
                'name' => 'Dakar',
                'code' => 'DK',
                'adm1code' => 'SG01',
            ),
            254 => 
            array (
                'id' => 3691,
                'country_id' => 214,
                'name' => 'Diourbel',
                'code' => 'DB',
                'adm1code' => 'SG03',
            ),
            255 => 
            array (
                'id' => 3692,
                'country_id' => 214,
                'name' => 'Saint-Louis',
                'code' => 'SL',
                'adm1code' => 'SG04',
            ),
            256 => 
            array (
                'id' => 3693,
                'country_id' => 214,
                'name' => 'Tambacounda',
                'code' => 'TC',
                'adm1code' => 'SG05',
            ),
            257 => 
            array (
                'id' => 3694,
                'country_id' => 214,
                'name' => 'Thies',
                'code' => 'TH',
                'adm1code' => 'SG07',
            ),
            258 => 
            array (
                'id' => 3695,
                'country_id' => 214,
                'name' => 'Louga',
                'code' => 'LG',
                'adm1code' => 'SG08',
            ),
            259 => 
            array (
                'id' => 3696,
                'country_id' => 214,
                'name' => 'Fatick',
                'code' => 'FK',
                'adm1code' => 'SG09',
            ),
            260 => 
            array (
                'id' => 3697,
                'country_id' => 214,
                'name' => 'Kaolack',
                'code' => 'KL',
                'adm1code' => 'SG10',
            ),
            261 => 
            array (
                'id' => 3698,
                'country_id' => 214,
                'name' => 'Kolda',
                'code' => 'KD',
                'adm1code' => 'SG11',
            ),
            262 => 
            array (
                'id' => 3699,
                'country_id' => 214,
                'name' => 'Ziguinchor',
                'code' => 'ZG',
                'adm1code' => 'SG12',
            ),
            263 => 
            array (
                'id' => 3700,
                'country_id' => 205,
                'name' => 'Ascension',
                'code' => 'AC',
                'adm1code' => 'SH01',
            ),
            264 => 
            array (
                'id' => 3701,
                'country_id' => 205,
                'name' => 'Saint Helena',
                'code' => 'SH',
                'adm1code' => 'SH02',
            ),
            265 => 
            array (
                'id' => 3702,
                'country_id' => 205,
                'name' => 'Tristan da Cunha',
                'code' => 'TA',
                'adm1code' => 'SH03',
            ),
            266 => 
            array (
                'id' => 3703,
                'country_id' => 221,
                'name' => 'Ajdovscina',
                'code' => 'AJ',
                'adm1code' => 'SI01',
            ),
            267 => 
            array (
                'id' => 3704,
                'country_id' => 221,
                'name' => 'Beltinci',
                'code' => 'BE',
                'adm1code' => 'SI02',
            ),
            268 => 
            array (
                'id' => 3705,
                'country_id' => 221,
                'name' => 'Bled',
                'code' => 'BL',
                'adm1code' => 'SI03',
            ),
            269 => 
            array (
                'id' => 3706,
                'country_id' => 221,
                'name' => 'Bohinj',
                'code' => 'BH',
                'adm1code' => 'SI04',
            ),
            270 => 
            array (
                'id' => 3707,
                'country_id' => 221,
                'name' => 'Borovnica',
                'code' => 'BO',
                'adm1code' => 'SI05',
            ),
            271 => 
            array (
                'id' => 3708,
                'country_id' => 221,
                'name' => 'Bovec',
                'code' => 'BC',
                'adm1code' => 'SI06',
            ),
            272 => 
            array (
                'id' => 3709,
                'country_id' => 221,
                'name' => 'Brda',
                'code' => 'BR',
                'adm1code' => 'SI07',
            ),
            273 => 
            array (
                'id' => 3710,
                'country_id' => 221,
                'name' => 'Brezice',
                'code' => 'BZ',
                'adm1code' => 'SI08',
            ),
            274 => 
            array (
                'id' => 3711,
                'country_id' => 221,
                'name' => 'Brezovica',
                'code' => 'BV',
                'adm1code' => 'SI09',
            ),
            275 => 
            array (
                'id' => 3712,
                'country_id' => 221,
                'name' => 'Cankova-Tisina',
                'code' => 'CA',
                'adm1code' => 'SI10',
            ),
            276 => 
            array (
                'id' => 3713,
                'country_id' => 221,
                'name' => 'Celje',
                'code' => 'CL',
                'adm1code' => 'SI11',
            ),
            277 => 
            array (
                'id' => 3714,
                'country_id' => 221,
                'name' => 'Cerklje Na Gorenjskem',
                'code' => 'CG',
                'adm1code' => 'SI12',
            ),
            278 => 
            array (
                'id' => 3715,
                'country_id' => 221,
                'name' => 'Cerknica',
                'code' => 'CK',
                'adm1code' => 'SI13',
            ),
            279 => 
            array (
                'id' => 3716,
                'country_id' => 221,
                'name' => 'Cerkno',
                'code' => 'CE',
                'adm1code' => 'SI14',
            ),
            280 => 
            array (
                'id' => 3717,
                'country_id' => 221,
                'name' => 'Crensovci',
                'code' => 'CR',
                'adm1code' => 'SI15',
            ),
            281 => 
            array (
                'id' => 3718,
                'country_id' => 221,
                'name' => 'Crna na Koroskem',
                'code' => 'CN',
                'adm1code' => 'SI16',
            ),
            282 => 
            array (
                'id' => 3719,
                'country_id' => 221,
                'name' => 'Crnomelj',
                'code' => 'CO',
                'adm1code' => 'SI17',
            ),
            283 => 
            array (
                'id' => 3720,
                'country_id' => 221,
                'name' => 'Destrnik-Trnovska Vas',
                'code' => 'DV',
                'adm1code' => 'SI18',
            ),
            284 => 
            array (
                'id' => 3721,
                'country_id' => 221,
                'name' => 'Divaca',
                'code' => 'DI',
                'adm1code' => 'SI19',
            ),
            285 => 
            array (
                'id' => 3722,
                'country_id' => 221,
                'name' => 'Dobrepolje',
                'code' => 'DB',
                'adm1code' => 'SI20',
            ),
            286 => 
            array (
                'id' => 3723,
                'country_id' => 221,
                'name' => 'Dobrova-Horjul-Polhov Gradec',
                'code' => 'DG',
                'adm1code' => 'SI21',
            ),
            287 => 
            array (
                'id' => 3724,
                'country_id' => 221,
                'name' => 'Dol pri Ljubljani',
                'code' => 'DP',
                'adm1code' => 'SI22',
            ),
            288 => 
            array (
                'id' => 3725,
                'country_id' => 221,
                'name' => 'Domzale',
                'code' => 'DM',
                'adm1code' => 'SI23',
            ),
            289 => 
            array (
                'id' => 3726,
                'country_id' => 221,
                'name' => 'Dornava',
                'code' => 'DO',
                'adm1code' => 'SI24',
            ),
            290 => 
            array (
                'id' => 3727,
                'country_id' => 221,
                'name' => 'Dravograd',
                'code' => 'DR',
                'adm1code' => 'SI25',
            ),
            291 => 
            array (
                'id' => 3728,
                'country_id' => 221,
                'name' => 'Duplek',
                'code' => 'DU',
                'adm1code' => 'SI26',
            ),
            292 => 
            array (
                'id' => 3729,
                'country_id' => 221,
                'name' => 'Gorenja Vas-Poljane',
                'code' => 'GV',
                'adm1code' => 'SI27',
            ),
            293 => 
            array (
                'id' => 3730,
                'country_id' => 221,
                'name' => 'Gorisnica',
                'code' => 'GO',
                'adm1code' => 'SI28',
            ),
            294 => 
            array (
                'id' => 3731,
                'country_id' => 221,
                'name' => 'Gornja Radgona',
                'code' => 'GR',
                'adm1code' => 'SI29',
            ),
            295 => 
            array (
                'id' => 3732,
                'country_id' => 221,
                'name' => 'Gornji Grad',
                'code' => 'GG',
                'adm1code' => 'SI30',
            ),
            296 => 
            array (
                'id' => 3733,
                'country_id' => 221,
                'name' => 'Gornji Petrovci',
                'code' => 'GP',
                'adm1code' => 'SI31',
            ),
            297 => 
            array (
                'id' => 3734,
                'country_id' => 221,
                'name' => 'Grosuplje',
                'code' => 'GS',
                'adm1code' => 'SI32',
            ),
            298 => 
            array (
                'id' => 3735,
                'country_id' => 221,
                'name' => 'HodosSalovci',
                'code' => 'HO',
                'adm1code' => 'SI33',
            ),
            299 => 
            array (
                'id' => 3736,
                'country_id' => 221,
                'name' => 'Hrastnik',
                'code' => 'HR',
                'adm1code' => 'SI34',
            ),
            300 => 
            array (
                'id' => 3737,
                'country_id' => 221,
                'name' => 'Hrpelje-Kozina',
                'code' => 'HK',
                'adm1code' => 'SI35',
            ),
            301 => 
            array (
                'id' => 3738,
                'country_id' => 221,
                'name' => 'Idrija',
                'code' => 'ID',
                'adm1code' => 'SI36',
            ),
            302 => 
            array (
                'id' => 3739,
                'country_id' => 221,
                'name' => 'Ig',
                'code' => 'IG',
                'adm1code' => 'SI37',
            ),
            303 => 
            array (
                'id' => 3740,
                'country_id' => 221,
                'name' => 'Ilirska Bistrica',
                'code' => 'IB',
                'adm1code' => 'SI38',
            ),
            304 => 
            array (
                'id' => 3741,
                'country_id' => 221,
                'name' => 'Ivancna Gorica',
                'code' => 'IV',
                'adm1code' => 'SI39',
            ),
            305 => 
            array (
                'id' => 3742,
                'country_id' => 221,
                'name' => 'Izola',
                'code' => 'IZ',
                'adm1code' => 'SI40',
            ),
            306 => 
            array (
                'id' => 3743,
                'country_id' => 221,
                'name' => 'Jesenice',
                'code' => 'JE',
                'adm1code' => 'SI41',
            ),
            307 => 
            array (
                'id' => 3744,
                'country_id' => 221,
                'name' => 'Jursinci',
                'code' => 'JU',
                'adm1code' => 'SI42',
            ),
            308 => 
            array (
                'id' => 3745,
                'country_id' => 221,
                'name' => 'Kamnik',
                'code' => 'KA',
                'adm1code' => 'SI43',
            ),
            309 => 
            array (
                'id' => 3746,
                'country_id' => 221,
                'name' => 'Kanal',
                'code' => 'KN',
                'adm1code' => 'SI44',
            ),
            310 => 
            array (
                'id' => 3747,
                'country_id' => 221,
                'name' => 'Kidricevo',
                'code' => 'KI',
                'adm1code' => 'SI45',
            ),
            311 => 
            array (
                'id' => 3748,
                'country_id' => 221,
                'name' => 'Kobarid',
                'code' => 'KO',
                'adm1code' => 'SI46',
            ),
            312 => 
            array (
                'id' => 3749,
                'country_id' => 221,
                'name' => 'Kobilje',
                'code' => 'KB',
                'adm1code' => 'SI47',
            ),
            313 => 
            array (
                'id' => 3750,
                'country_id' => 221,
                'name' => 'Kocevje',
                'code' => 'KC',
                'adm1code' => 'SI48',
            ),
            314 => 
            array (
                'id' => 3751,
                'country_id' => 221,
                'name' => 'Komen',
                'code' => 'KM',
                'adm1code' => 'SI49',
            ),
            315 => 
            array (
                'id' => 3752,
                'country_id' => 221,
                'name' => 'Koper',
                'code' => 'KP',
                'adm1code' => 'SI50',
            ),
            316 => 
            array (
                'id' => 3753,
                'country_id' => 221,
                'name' => 'Kozje',
                'code' => 'KJ',
                'adm1code' => 'SI51',
            ),
            317 => 
            array (
                'id' => 3754,
                'country_id' => 221,
                'name' => 'Kranj',
                'code' => 'KR',
                'adm1code' => 'SI52',
            ),
            318 => 
            array (
                'id' => 3755,
                'country_id' => 221,
                'name' => 'Kranjska Gora',
                'code' => 'KG',
                'adm1code' => 'SI53',
            ),
            319 => 
            array (
                'id' => 3756,
                'country_id' => 221,
                'name' => 'Krsko',
                'code' => 'KS',
                'adm1code' => 'SI54',
            ),
            320 => 
            array (
                'id' => 3757,
                'country_id' => 221,
                'name' => 'Kungota',
                'code' => 'KZ',
                'adm1code' => 'SI55',
            ),
            321 => 
            array (
                'id' => 3758,
                'country_id' => 221,
                'name' => 'Kuzma',
                'code' => 'KU',
                'adm1code' => 'SI56',
            ),
            322 => 
            array (
                'id' => 3759,
                'country_id' => 221,
                'name' => 'Lasko',
                'code' => 'LA',
                'adm1code' => 'SI57',
            ),
            323 => 
            array (
                'id' => 3760,
                'country_id' => 221,
                'name' => 'Lenart',
                'code' => 'LE',
                'adm1code' => 'SI58',
            ),
            324 => 
            array (
                'id' => 3761,
                'country_id' => 221,
                'name' => 'Lendava',
                'code' => 'LN',
                'adm1code' => 'SI59',
            ),
            325 => 
            array (
                'id' => 3762,
                'country_id' => 221,
                'name' => 'Litija',
                'code' => 'LI',
                'adm1code' => 'SI60',
            ),
            326 => 
            array (
                'id' => 3763,
                'country_id' => 221,
                'name' => 'Ljubljana',
                'code' => 'LB',
                'adm1code' => 'SI61',
            ),
            327 => 
            array (
                'id' => 3764,
                'country_id' => 221,
                'name' => 'Ljubno',
                'code' => 'LC',
                'adm1code' => 'SI62',
            ),
            328 => 
            array (
                'id' => 3765,
                'country_id' => 221,
                'name' => 'Ljutomer',
                'code' => 'LJ',
                'adm1code' => 'SI63',
            ),
            329 => 
            array (
                'id' => 3766,
                'country_id' => 221,
                'name' => 'Logatec',
                'code' => 'LO',
                'adm1code' => 'SI64',
            ),
            330 => 
            array (
                'id' => 3767,
                'country_id' => 221,
                'name' => 'Loska Dolina',
                'code' => 'LD',
                'adm1code' => 'SI65',
            ),
            331 => 
            array (
                'id' => 3768,
                'country_id' => 221,
                'name' => 'Loski Potok',
                'code' => 'LP',
                'adm1code' => 'SI66',
            ),
            332 => 
            array (
                'id' => 3769,
                'country_id' => 221,
                'name' => 'Luce',
                'code' => 'LU',
                'adm1code' => 'SI67',
            ),
            333 => 
            array (
                'id' => 3770,
                'country_id' => 221,
                'name' => 'Lukovica',
                'code' => 'LK',
                'adm1code' => 'SI68',
            ),
            334 => 
            array (
                'id' => 3771,
                'country_id' => 221,
                'name' => 'Majsperk',
                'code' => 'MJ',
                'adm1code' => 'SI69',
            ),
            335 => 
            array (
                'id' => 3772,
                'country_id' => 221,
                'name' => 'Maribor',
                'code' => 'MA',
                'adm1code' => 'SI70',
            ),
            336 => 
            array (
                'id' => 3773,
                'country_id' => 221,
                'name' => 'Medvode',
                'code' => 'MD',
                'adm1code' => 'SI71',
            ),
            337 => 
            array (
                'id' => 3774,
                'country_id' => 221,
                'name' => 'Menges',
                'code' => 'MN',
                'adm1code' => 'SI72',
            ),
            338 => 
            array (
                'id' => 3775,
                'country_id' => 221,
                'name' => 'Metlika',
                'code' => 'ME',
                'adm1code' => 'SI73',
            ),
            339 => 
            array (
                'id' => 3776,
                'country_id' => 221,
                'name' => 'Mezica',
                'code' => 'MZ',
                'adm1code' => 'SI74',
            ),
            340 => 
            array (
                'id' => 3777,
                'country_id' => 221,
                'name' => 'Miren-Kostanjevica',
                'code' => 'MI',
                'adm1code' => 'SI75',
            ),
            341 => 
            array (
                'id' => 3778,
                'country_id' => 221,
                'name' => 'Mislinja',
                'code' => 'ML',
                'adm1code' => 'SI76',
            ),
            342 => 
            array (
                'id' => 3779,
                'country_id' => 221,
                'name' => 'Moravce',
                'code' => 'MV',
                'adm1code' => 'SI77',
            ),
            343 => 
            array (
                'id' => 3780,
                'country_id' => 221,
                'name' => 'Moravske Toplice',
                'code' => 'MT',
                'adm1code' => 'SI78',
            ),
            344 => 
            array (
                'id' => 3781,
                'country_id' => 221,
                'name' => 'Mozirje',
                'code' => 'MO',
                'adm1code' => 'SI79',
            ),
            345 => 
            array (
                'id' => 3782,
                'country_id' => 221,
                'name' => 'Murska Sobota',
                'code' => 'MS',
                'adm1code' => 'SI80',
            ),
            346 => 
            array (
                'id' => 3783,
                'country_id' => 221,
                'name' => 'Muta',
                'code' => 'MU',
                'adm1code' => 'SI81',
            ),
            347 => 
            array (
                'id' => 3784,
                'country_id' => 221,
                'name' => 'Naklo',
                'code' => 'NA',
                'adm1code' => 'SI82',
            ),
            348 => 
            array (
                'id' => 3785,
                'country_id' => 221,
                'name' => 'Nazarje',
                'code' => 'NZ',
                'adm1code' => 'SI83',
            ),
            349 => 
            array (
                'id' => 3786,
                'country_id' => 221,
                'name' => 'Nova Gorica',
                'code' => 'NG',
                'adm1code' => 'SI84',
            ),
            350 => 
            array (
                'id' => 3787,
                'country_id' => 221,
                'name' => 'Novo Mesto',
                'code' => 'NM',
                'adm1code' => 'SI85',
            ),
            351 => 
            array (
                'id' => 3788,
                'country_id' => 221,
                'name' => 'Odranci',
                'code' => 'OD',
                'adm1code' => 'SI86',
            ),
            352 => 
            array (
                'id' => 3789,
                'country_id' => 221,
                'name' => 'Ormoz',
                'code' => 'OR',
                'adm1code' => 'SI87',
            ),
            353 => 
            array (
                'id' => 3790,
                'country_id' => 221,
                'name' => 'Osilnica',
                'code' => 'OS',
                'adm1code' => 'SI88',
            ),
            354 => 
            array (
                'id' => 3791,
                'country_id' => 221,
                'name' => 'Pesnica',
                'code' => 'PE',
                'adm1code' => 'SI89',
            ),
            355 => 
            array (
                'id' => 3792,
                'country_id' => 221,
                'name' => 'Piran',
                'code' => 'PA',
                'adm1code' => 'SI90',
            ),
            356 => 
            array (
                'id' => 3793,
                'country_id' => 221,
                'name' => 'Pivka',
                'code' => 'PI',
                'adm1code' => 'SI91',
            ),
            357 => 
            array (
                'id' => 3794,
                'country_id' => 221,
                'name' => 'Podcetrtek',
                'code' => 'PD',
                'adm1code' => 'SI92',
            ),
            358 => 
            array (
                'id' => 3795,
                'country_id' => 221,
                'name' => 'Podvelka-Ribnica',
                'code' => 'PV',
                'adm1code' => 'SI93',
            ),
            359 => 
            array (
                'id' => 3796,
                'country_id' => 221,
                'name' => 'Postojna',
                'code' => 'PO',
                'adm1code' => 'SI94',
            ),
            360 => 
            array (
                'id' => 3797,
                'country_id' => 221,
                'name' => 'Preddvor',
                'code' => 'PR',
                'adm1code' => 'SI95',
            ),
            361 => 
            array (
                'id' => 3798,
                'country_id' => 221,
                'name' => 'Ptuj',
                'code' => 'PT',
                'adm1code' => 'SI96',
            ),
            362 => 
            array (
                'id' => 3799,
                'country_id' => 221,
                'name' => 'Puconci',
                'code' => 'PU',
                'adm1code' => 'SI97',
            ),
            363 => 
            array (
                'id' => 3800,
                'country_id' => 221,
                'name' => 'Race-Fram',
                'code' => 'RF',
                'adm1code' => 'SI98',
            ),
            364 => 
            array (
                'id' => 3801,
                'country_id' => 221,
                'name' => 'Radece',
                'code' => 'RA',
                'adm1code' => 'SI99',
            ),
            365 => 
            array (
                'id' => 3802,
                'country_id' => 221,
                'name' => 'Radenci',
                'code' => 'RD',
                'adm1code' => 'SIA1',
            ),
            366 => 
            array (
                'id' => 3803,
                'country_id' => 221,
                'name' => 'Radlje ob Dravi',
                'code' => 'RL',
                'adm1code' => 'SIA2',
            ),
            367 => 
            array (
                'id' => 3804,
                'country_id' => 221,
                'name' => 'Radovljica',
                'code' => 'RV',
                'adm1code' => 'SIA3',
            ),
            368 => 
            array (
                'id' => 3805,
                'country_id' => 221,
                'name' => 'Ravne-Prevalje',
                'code' => 'RN',
                'adm1code' => 'SIA4',
            ),
            369 => 
            array (
                'id' => 3806,
                'country_id' => 221,
                'name' => 'Ribnica',
                'code' => 'RI',
                'adm1code' => 'SIA5',
            ),
            370 => 
            array (
                'id' => 3807,
                'country_id' => 221,
                'name' => 'Rogasevci',
                'code' => 'RO',
                'adm1code' => 'SIA6',
            ),
            371 => 
            array (
                'id' => 3808,
                'country_id' => 221,
                'name' => 'Rogaska Slatina',
                'code' => 'RS',
                'adm1code' => 'SIA7',
            ),
            372 => 
            array (
                'id' => 3809,
                'country_id' => 221,
                'name' => 'Rogatec',
                'code' => 'RT',
                'adm1code' => 'SIA8',
            ),
            373 => 
            array (
                'id' => 3810,
                'country_id' => 221,
                'name' => 'Ruse',
                'code' => 'RU',
                'adm1code' => 'SIA9',
            ),
            374 => 
            array (
                'id' => 3811,
                'country_id' => 221,
                'name' => 'Semic',
                'code' => 'SM',
                'adm1code' => 'SIB1',
            ),
            375 => 
            array (
                'id' => 3812,
                'country_id' => 221,
                'name' => 'Sencur',
                'code' => 'SN',
                'adm1code' => 'SIB2',
            ),
            376 => 
            array (
                'id' => 3813,
                'country_id' => 221,
                'name' => 'Sentilj',
                'code' => 'SE',
                'adm1code' => 'SIB3',
            ),
            377 => 
            array (
                'id' => 3814,
                'country_id' => 221,
                'name' => 'Sentjernej',
                'code' => 'SR',
                'adm1code' => 'SIB4',
            ),
            378 => 
            array (
                'id' => 3815,
                'country_id' => 221,
                'name' => 'Sentjur pri Celju',
                'code' => 'SU',
                'adm1code' => 'SIB5',
            ),
            379 => 
            array (
                'id' => 3816,
                'country_id' => 221,
                'name' => 'Sevnica',
                'code' => 'SV',
                'adm1code' => 'SIB6',
            ),
            380 => 
            array (
                'id' => 3817,
                'country_id' => 221,
                'name' => 'Sezana',
                'code' => 'SZ',
                'adm1code' => 'SIB7',
            ),
            381 => 
            array (
                'id' => 3818,
                'country_id' => 221,
                'name' => 'Skocjan',
                'code' => 'SC',
                'adm1code' => 'SIB8',
            ),
            382 => 
            array (
                'id' => 3819,
                'country_id' => 221,
                'name' => 'Skofja Loka',
                'code' => 'SL',
                'adm1code' => 'SIB9',
            ),
            383 => 
            array (
                'id' => 3820,
                'country_id' => 221,
                'name' => 'Skofljica',
                'code' => 'SK',
                'adm1code' => 'SIC1',
            ),
            384 => 
            array (
                'id' => 3821,
                'country_id' => 221,
                'name' => 'Slovenj Gradec',
                'code' => 'SG',
                'adm1code' => 'SIC2',
            ),
            385 => 
            array (
                'id' => 3822,
                'country_id' => 221,
                'name' => 'Slovenska Bistrica',
                'code' => 'SB',
                'adm1code' => 'SIC3',
            ),
            386 => 
            array (
                'id' => 3823,
                'country_id' => 221,
                'name' => 'Slovenske Konjice',
                'code' => 'SS',
                'adm1code' => 'SIC4',
            ),
            387 => 
            array (
                'id' => 3824,
                'country_id' => 221,
                'name' => 'Smarje pri Jelsah',
                'code' => 'SP',
                'adm1code' => 'SIC5',
            ),
            388 => 
            array (
                'id' => 3825,
                'country_id' => 221,
                'name' => 'Smartno ob Paki',
                'code' => 'SA',
                'adm1code' => 'SIC6',
            ),
            389 => 
            array (
                'id' => 3826,
                'country_id' => 221,
                'name' => 'Sostanj',
                'code' => 'SO',
                'adm1code' => 'SIC7',
            ),
            390 => 
            array (
                'id' => 3827,
                'country_id' => 221,
                'name' => 'Starse',
                'code' => 'SH',
                'adm1code' => 'SIC8',
            ),
            391 => 
            array (
                'id' => 3828,
                'country_id' => 221,
                'name' => 'Store',
                'code' => 'ST',
                'adm1code' => 'SIC9',
            ),
            392 => 
            array (
                'id' => 3829,
                'country_id' => 221,
                'name' => 'Sveti Jurij',
                'code' => 'SJ',
                'adm1code' => 'SID1',
            ),
            393 => 
            array (
                'id' => 3830,
                'country_id' => 221,
                'name' => 'Tolmin',
                'code' => 'TO',
                'adm1code' => 'SID2',
            ),
            394 => 
            array (
                'id' => 3831,
                'country_id' => 221,
                'name' => 'Trbovlje',
                'code' => 'TB',
                'adm1code' => 'SID3',
            ),
            395 => 
            array (
                'id' => 3832,
                'country_id' => 221,
                'name' => 'Trebnje',
                'code' => 'TE',
                'adm1code' => 'SID4',
            ),
            396 => 
            array (
                'id' => 3833,
                'country_id' => 221,
                'name' => 'Trzic',
                'code' => 'TR',
                'adm1code' => 'SID5',
            ),
            397 => 
            array (
                'id' => 3834,
                'country_id' => 221,
                'name' => 'Turnisce',
                'code' => 'TU',
                'adm1code' => 'SID6',
            ),
            398 => 
            array (
                'id' => 3835,
                'country_id' => 221,
                'name' => 'Velenje',
                'code' => 'VE',
                'adm1code' => 'SID7',
            ),
            399 => 
            array (
                'id' => 3836,
                'country_id' => 221,
                'name' => 'Velike Lasce',
                'code' => 'VL',
                'adm1code' => 'SID8',
            ),
            400 => 
            array (
                'id' => 3837,
                'country_id' => 221,
                'name' => 'Videm',
                'code' => 'VI',
                'adm1code' => 'SID9',
            ),
            401 => 
            array (
                'id' => 3838,
                'country_id' => 221,
                'name' => 'Vipava',
                'code' => 'VP',
                'adm1code' => 'SIE1',
            ),
            402 => 
            array (
                'id' => 3839,
                'country_id' => 221,
                'name' => 'Vitanje',
                'code' => 'VT',
                'adm1code' => 'SIE2',
            ),
            403 => 
            array (
                'id' => 3840,
                'country_id' => 221,
                'name' => 'Vodice',
                'code' => 'VO',
                'adm1code' => 'SIE3',
            ),
            404 => 
            array (
                'id' => 3841,
                'country_id' => 221,
                'name' => 'Vojnik',
                'code' => 'VJ',
                'adm1code' => 'SIE4',
            ),
            405 => 
            array (
                'id' => 3842,
                'country_id' => 221,
                'name' => 'Vrhnika',
                'code' => 'VR',
                'adm1code' => 'SIE5',
            ),
            406 => 
            array (
                'id' => 3843,
                'country_id' => 221,
                'name' => 'Vuzenica',
                'code' => 'VU',
                'adm1code' => 'SIE6',
            ),
            407 => 
            array (
                'id' => 3844,
                'country_id' => 221,
                'name' => 'Zagorje ob Savi',
                'code' => 'ZO',
                'adm1code' => 'SIE7',
            ),
            408 => 
            array (
                'id' => 3845,
                'country_id' => 221,
                'name' => 'Zalec',
                'code' => 'ZA',
                'adm1code' => 'SIE8',
            ),
            409 => 
            array (
                'id' => 3846,
                'country_id' => 221,
                'name' => 'Zavrc',
                'code' => 'ZV',
                'adm1code' => 'SIE9',
            ),
            410 => 
            array (
                'id' => 3847,
                'country_id' => 221,
                'name' => 'Zelezniki',
                'code' => 'ZE',
                'adm1code' => 'SIF1',
            ),
            411 => 
            array (
                'id' => 3848,
                'country_id' => 221,
                'name' => 'Ziri',
                'code' => 'ZI',
                'adm1code' => 'SIF2',
            ),
            412 => 
            array (
                'id' => 3849,
                'country_id' => 221,
                'name' => 'Zrece',
                'code' => 'ZR',
                'adm1code' => 'SIF3',
            ),
            413 => 
            array (
                'id' => 3850,
                'country_id' => 218,
                'name' => 'Eastern',
                'code' => 'EA',
                'adm1code' => 'SL01',
            ),
            414 => 
            array (
                'id' => 3851,
                'country_id' => 218,
                'name' => 'Northern',
                'code' => 'NO',
                'adm1code' => 'SL02',
            ),
            415 => 
            array (
                'id' => 3852,
                'country_id' => 218,
                'name' => 'Southern',
                'code' => 'SO',
                'adm1code' => 'SL03',
            ),
            416 => 
            array (
                'id' => 3853,
                'country_id' => 218,
                'name' => 'Western Area',
                'code' => 'WE',
                'adm1code' => 'SL04',
            ),
            417 => 
            array (
                'id' => 3854,
                'country_id' => 211,
                'name' => 'Acquaviva',
                'code' => 'AC',
                'adm1code' => 'SM01',
            ),
            418 => 
            array (
                'id' => 3855,
                'country_id' => 211,
                'name' => 'Chiesanuova',
                'code' => 'CH',
                'adm1code' => 'SM02',
            ),
            419 => 
            array (
                'id' => 3856,
                'country_id' => 211,
                'name' => 'Domagnano',
                'code' => 'DO',
                'adm1code' => 'SM03',
            ),
            420 => 
            array (
                'id' => 3857,
                'country_id' => 211,
                'name' => 'Faetano',
                'code' => 'FA',
                'adm1code' => 'SM04',
            ),
            421 => 
            array (
                'id' => 3858,
                'country_id' => 211,
                'name' => 'Fiorentino',
                'code' => 'FI',
                'adm1code' => 'SM05',
            ),
            422 => 
            array (
                'id' => 3859,
                'country_id' => 211,
                'name' => 'Borgo Maaggiore',
                'code' => 'BM',
                'adm1code' => 'SM06',
            ),
            423 => 
            array (
                'id' => 3860,
                'country_id' => 211,
                'name' => 'San Marino',
                'code' => 'SM',
                'adm1code' => 'SM07',
            ),
            424 => 
            array (
                'id' => 3861,
                'country_id' => 211,
                'name' => 'Monte Giardino',
                'code' => 'MG',
                'adm1code' => 'SM08',
            ),
            425 => 
            array (
                'id' => 3862,
                'country_id' => 211,
                'name' => 'Serravalle',
                'code' => 'SE',
                'adm1code' => 'SM09',
            ),
            426 => 
            array (
                'id' => 3863,
                'country_id' => 223,
                'name' => 'Bakool',
                'code' => 'BK',
                'adm1code' => 'SO01',
            ),
            427 => 
            array (
                'id' => 3864,
                'country_id' => 223,
                'name' => 'Banaadir',
                'code' => 'BN',
                'adm1code' => 'SO02',
            ),
            428 => 
            array (
                'id' => 3865,
                'country_id' => 223,
                'name' => 'Bari',
                'code' => 'BR',
                'adm1code' => 'SO03',
            ),
            429 => 
            array (
                'id' => 3866,
                'country_id' => 223,
                'name' => 'Bay',
                'code' => 'BY',
                'adm1code' => 'SO04',
            ),
            430 => 
            array (
                'id' => 3867,
                'country_id' => 223,
                'name' => 'Galguduud',
                'code' => 'GA',
                'adm1code' => 'SO05',
            ),
            431 => 
            array (
                'id' => 3868,
                'country_id' => 223,
                'name' => 'Gedo',
                'code' => 'GE',
                'adm1code' => 'SO06',
            ),
            432 => 
            array (
                'id' => 3869,
                'country_id' => 223,
                'name' => 'Hiiraan',
                'code' => 'HI',
                'adm1code' => 'SO07',
            ),
            433 => 
            array (
                'id' => 3870,
                'country_id' => 223,
                'name' => 'Jubbada Dhexe',
                'code' => 'JD',
                'adm1code' => 'SO08',
            ),
            434 => 
            array (
                'id' => 3871,
                'country_id' => 223,
                'name' => 'Jubbada Hoose',
                'code' => 'JH',
                'adm1code' => 'SO09',
            ),
            435 => 
            array (
                'id' => 3872,
                'country_id' => 223,
                'name' => 'Mudug',
                'code' => 'MU',
                'adm1code' => 'SO10',
            ),
            436 => 
            array (
                'id' => 3873,
                'country_id' => 223,
                'name' => 'Nugaal',
                'code' => 'NU',
                'adm1code' => 'SO11',
            ),
            437 => 
            array (
                'id' => 3874,
                'country_id' => 223,
                'name' => 'Sanaag',
                'code' => 'SA',
                'adm1code' => 'SO12',
            ),
            438 => 
            array (
                'id' => 3875,
                'country_id' => 223,
                'name' => 'Shabeellaha Dhexe',
                'code' => 'SD',
                'adm1code' => 'SO13',
            ),
            439 => 
            array (
                'id' => 3876,
                'country_id' => 223,
                'name' => 'Shabeellaha Hoose',
                'code' => 'SH',
                'adm1code' => 'SO14',
            ),
            440 => 
            array (
                'id' => 3877,
                'country_id' => 223,
                'name' => 'Togdheer',
                'code' => 'TO',
                'adm1code' => 'SO15',
            ),
            441 => 
            array (
                'id' => 3878,
                'country_id' => 223,
                'name' => 'Woqooyi Galbeed',
                'code' => 'WO',
                'adm1code' => 'SO16',
            ),
            442 => 
            array (
                'id' => 3886,
                'country_id' => 226,
                'name' => 'Islas Baleares',
                'code' => 'PM',
                'adm1code' => 'SP07',
            ),
            443 => 
            array (
                'id' => 3906,
                'country_id' => 226,
                'name' => 'La Rioja',
                'code' => 'LO',
                'adm1code' => 'SP27',
            ),
            444 => 
            array (
                'id' => 3908,
                'country_id' => 226,
                'name' => 'Madrid',
                'code' => 'MD',
                'adm1code' => 'SP29',
            ),
            445 => 
            array (
                'id' => 3910,
                'country_id' => 226,
                'name' => 'Murcia',
                'code' => 'MU',
                'adm1code' => 'SP31',
            ),
            446 => 
            array (
                'id' => 3911,
                'country_id' => 226,
                'name' => 'Navarra',
                'code' => 'NA',
                'adm1code' => 'SP32',
            ),
            447 => 
            array (
                'id' => 3913,
                'country_id' => 226,
                'name' => 'Asturias',
                'code' => 'AS',
                'adm1code' => 'SP34',
            ),
            448 => 
            array (
                'id' => 3918,
                'country_id' => 226,
                'name' => 'Cantabria',
                'code' => 'CB',
                'adm1code' => 'SP39',
            ),
            449 => 
            array (
                'id' => 3930,
                'country_id' => 226,
                'name' => 'Andalucia',
                'code' => 'AN',
                'adm1code' => 'SP51',
            ),
            450 => 
            array (
                'id' => 3931,
                'country_id' => 226,
                'name' => 'Aragon',
                'code' => 'AR',
                'adm1code' => 'SP52',
            ),
            451 => 
            array (
                'id' => 3932,
                'country_id' => 226,
                'name' => 'Canarias',
                'code' => 'CN',
                'adm1code' => 'SP53',
            ),
            452 => 
            array (
                'id' => 3933,
                'country_id' => 226,
                'name' => 'Castilla-La Mancha',
                'code' => 'CM',
                'adm1code' => 'SP54',
            ),
            453 => 
            array (
                'id' => 3934,
                'country_id' => 226,
                'name' => 'Castilla y Leon',
                'code' => 'CL',
                'adm1code' => 'SP55',
            ),
            454 => 
            array (
                'id' => 3935,
                'country_id' => 226,
                'name' => 'CataluÃ±a',
                'code' => 'CT',
                'adm1code' => 'SP56',
            ),
            455 => 
            array (
                'id' => 3936,
                'country_id' => 226,
                'name' => 'Extremadura',
                'code' => 'EX',
                'adm1code' => 'SP57',
            ),
            456 => 
            array (
                'id' => 3937,
                'country_id' => 226,
                'name' => 'Galicia',
                'code' => 'GA',
                'adm1code' => 'SP58',
            ),
            457 => 
            array (
                'id' => 3938,
                'country_id' => 226,
                'name' => 'Pais Vasco',
                'code' => 'PV',
                'adm1code' => 'SP59',
            ),
            458 => 
            array (
                'id' => 3939,
                'country_id' => 226,
                'name' => 'Valenciana',
                'code' => 'VC',
                'adm1code' => 'SP60',
            ),
            459 => 
            array (
                'id' => 3941,
                'country_id' => 271,
                'name' => 'Vojvodina',
                'code' => 'VO',
                'adm1code' => '',
            ),
            460 => 
            array (
                'id' => 3942,
                'country_id' => 207,
                'name' => 'Anse-la-Raye',
                'code' => 'AR',
                'adm1code' => 'ST01',
            ),
            461 => 
            array (
                'id' => 3943,
                'country_id' => 207,
                'name' => 'Dauphin',
                'code' => 'DA',
                'adm1code' => 'ST02',
            ),
            462 => 
            array (
                'id' => 3944,
                'country_id' => 207,
                'name' => 'Castries',
                'code' => 'CS',
                'adm1code' => 'ST03',
            ),
            463 => 
            array (
                'id' => 3945,
                'country_id' => 207,
                'name' => 'Choiseul',
                'code' => 'CH',
                'adm1code' => 'ST04',
            ),
            464 => 
            array (
                'id' => 3946,
                'country_id' => 207,
                'name' => 'Dennery',
                'code' => 'DE',
                'adm1code' => 'ST05',
            ),
            465 => 
            array (
                'id' => 3947,
                'country_id' => 207,
                'name' => 'Gros-Islet',
                'code' => 'GI',
                'adm1code' => 'ST06',
            ),
            466 => 
            array (
                'id' => 3948,
                'country_id' => 207,
                'name' => 'Laborie',
                'code' => 'LB',
                'adm1code' => 'ST07',
            ),
            467 => 
            array (
                'id' => 3949,
                'country_id' => 207,
                'name' => 'Micoud',
                'code' => 'MI',
                'adm1code' => 'ST08',
            ),
            468 => 
            array (
                'id' => 3950,
                'country_id' => 207,
                'name' => 'Soufriere',
                'code' => 'CO',
                'adm1code' => 'ST09',
            ),
            469 => 
            array (
                'id' => 3951,
                'country_id' => 207,
                'name' => 'Vieux-Fort',
                'code' => 'VF',
                'adm1code' => 'ST10',
            ),
            470 => 
            array (
                'id' => 3952,
                'country_id' => 207,
                'name' => 'Praslin',
                'code' => 'PR',
                'adm1code' => 'ST11',
            ),
            471 => 
            array (
                'id' => 3953,
                'country_id' => 229,
                'name' => 'A\'ali an Nil',
                'code' => 'UN',
                'adm1code' => 'SU35',
            ),
            472 => 
            array (
                'id' => 3956,
                'country_id' => 229,
                'name' => 'Al Khartum',
                'code' => 'KH',
                'adm1code' => 'SU29',
            ),
            473 => 
            array (
                'id' => 3957,
                'country_id' => 229,
                'name' => 'Ash Shamaliyah',
                'code' => 'NO',
                'adm1code' => 'SU43',
            ),
            474 => 
            array (
                'id' => 3962,
                'country_id' => 229,
                'name' => 'Al Babr al Ahmar',
                'code' => 'RS',
                'adm1code' => 'SU36',
            ),
            475 => 
            array (
                'id' => 3963,
                'country_id' => 229,
                'name' => 'Al Buhayrat',
                'code' => 'EB',
                'adm1code' => 'SU37',
            ),
            476 => 
            array (
                'id' => 3964,
                'country_id' => 229,
                'name' => 'Al Jazirah',
                'code' => 'GZ',
                'adm1code' => 'SU38',
            ),
            477 => 
            array (
                'id' => 3965,
                'country_id' => 229,
                'name' => 'Al Qadarif',
                'code' => 'GD',
                'adm1code' => 'SU39',
            ),
            478 => 
            array (
                'id' => 3966,
                'country_id' => 229,
                'name' => 'Al Wahdah',
                'code' => 'WH',
                'adm1code' => 'SU40',
            ),
            479 => 
            array (
                'id' => 3967,
                'country_id' => 229,
                'name' => 'An Nil al Abyad',
                'code' => 'WN',
                'adm1code' => 'SU41',
            ),
            480 => 
            array (
                'id' => 3968,
                'country_id' => 229,
                'name' => 'An Nil al Azraq',
                'code' => 'BN',
                'adm1code' => 'SU42',
            ),
            481 => 
            array (
                'id' => 3969,
                'country_id' => 229,
                'name' => 'Bahr al Jabal',
                'code' => 'BG',
                'adm1code' => 'SU44',
            ),
            482 => 
            array (
                'id' => 3970,
                'country_id' => 229,
                'name' => 'Gharb al Istiwa\'iyah',
                'code' => 'WE',
                'adm1code' => 'SU45',
            ),
            483 => 
            array (
                'id' => 3971,
                'country_id' => 229,
                'name' => 'Gharb Bahr al Ghazal',
                'code' => 'WB',
                'adm1code' => 'SU46',
            ),
            484 => 
            array (
                'id' => 3972,
                'country_id' => 229,
                'name' => 'Gharb Darfur',
                'code' => 'WD',
                'adm1code' => 'SU47',
            ),
            485 => 
            array (
                'id' => 3973,
                'country_id' => 229,
                'name' => 'Gharb Kurdufan',
                'code' => 'WK',
                'adm1code' => 'SU48',
            ),
            486 => 
            array (
                'id' => 3974,
                'country_id' => 229,
                'name' => 'Janub Darfur',
                'code' => 'JD',
                'adm1code' => 'SU49',
            ),
            487 => 
            array (
                'id' => 3975,
                'country_id' => 229,
                'name' => 'Janub Kurdufan',
                'code' => 'SK',
                'adm1code' => 'SU50',
            ),
            488 => 
            array (
                'id' => 3976,
                'country_id' => 229,
                'name' => 'Junqali',
                'code' => 'JG',
                'adm1code' => 'SU51',
            ),
            489 => 
            array (
                'id' => 3977,
                'country_id' => 229,
                'name' => 'Kassala',
                'code' => 'KA',
                'adm1code' => 'SU52',
            ),
            490 => 
            array (
                'id' => 3978,
                'country_id' => 229,
                'name' => 'Nahr an Nil',
                'code' => 'RN',
                'adm1code' => 'SU53',
            ),
            491 => 
            array (
                'id' => 3979,
                'country_id' => 229,
                'name' => 'Shamal Bahr al Ghazal',
                'code' => 'NB',
                'adm1code' => 'SU54',
            ),
            492 => 
            array (
                'id' => 3980,
                'country_id' => 229,
                'name' => 'Shamal Darfur',
                'code' => 'ND',
                'adm1code' => 'SU55',
            ),
            493 => 
            array (
                'id' => 3981,
                'country_id' => 229,
                'name' => 'Shamal Kurdufan',
                'code' => 'NK',
                'adm1code' => 'SU56',
            ),
            494 => 
            array (
                'id' => 3982,
                'country_id' => 229,
                'name' => 'Sharq al Istiwa\'iyah',
                'code' => 'EE',
                'adm1code' => 'SU57',
            ),
            495 => 
            array (
                'id' => 3983,
                'country_id' => 229,
                'name' => 'Sinnar',
                'code' => 'SI',
                'adm1code' => 'SU58',
            ),
            496 => 
            array (
                'id' => 3984,
                'country_id' => 229,
                'name' => 'Warab',
                'code' => 'WR',
                'adm1code' => 'SU59',
            ),
            497 => 
            array (
                'id' => 3986,
                'country_id' => 233,
                'name' => 'Blekinge Lan',
                'code' => 'BL',
                'adm1code' => 'SW02',
            ),
            498 => 
            array (
                'id' => 3987,
                'country_id' => 233,
                'name' => 'Gavleborgs Lan',
                'code' => 'GV',
                'adm1code' => 'SW03',
            ),
            499 => 
            array (
                'id' => 3989,
                'country_id' => 233,
                'name' => 'Gotlands Lan',
                'code' => 'GT',
                'adm1code' => 'SW05',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 3990,
                'country_id' => 233,
                'name' => 'Hallands Lan',
                'code' => 'HA',
                'adm1code' => 'SW06',
            ),
            1 => 
            array (
                'id' => 3991,
                'country_id' => 233,
                'name' => 'Jamtlands Lan',
                'code' => 'JA',
                'adm1code' => 'SW07',
            ),
            2 => 
            array (
                'id' => 3992,
                'country_id' => 233,
                'name' => 'Jonkopings Lan',
                'code' => 'JO',
                'adm1code' => 'SW08',
            ),
            3 => 
            array (
                'id' => 3993,
                'country_id' => 233,
                'name' => 'Kalmar Lan',
                'code' => 'KA',
                'adm1code' => 'SW09',
            ),
            4 => 
            array (
                'id' => 3994,
                'country_id' => 233,
                'name' => 'Dalarnas Lan',
                'code' => 'KO',
                'adm1code' => 'SW10',
            ),
            5 => 
            array (
                'id' => 3996,
                'country_id' => 233,
                'name' => 'Kronobergs Lan',
                'code' => 'KR',
                'adm1code' => 'SW12',
            ),
            6 => 
            array (
                'id' => 3998,
                'country_id' => 233,
                'name' => 'Norrbottens Lan',
                'code' => 'NB',
                'adm1code' => 'SW14',
            ),
            7 => 
            array (
                'id' => 3999,
                'country_id' => 233,
                'name' => 'Orebro Lan',
                'code' => 'OR',
                'adm1code' => 'SW15',
            ),
            8 => 
            array (
                'id' => 4000,
                'country_id' => 233,
                'name' => 'Ostergotlands Lan',
                'code' => 'OG',
                'adm1code' => 'SW16',
            ),
            9 => 
            array (
                'id' => 4002,
                'country_id' => 233,
                'name' => 'Sodermanlands Lan',
                'code' => 'SD',
                'adm1code' => 'SW18',
            ),
            10 => 
            array (
                'id' => 4003,
                'country_id' => 233,
                'name' => 'Uppsala Lan',
                'code' => 'UP',
                'adm1code' => 'SW21',
            ),
            11 => 
            array (
                'id' => 4004,
                'country_id' => 233,
                'name' => 'Varmlands Lan',
                'code' => 'VR',
                'adm1code' => 'SW22',
            ),
            12 => 
            array (
                'id' => 4005,
                'country_id' => 233,
                'name' => 'Vasterbottens Lan',
                'code' => 'VB',
                'adm1code' => 'SW23',
            ),
            13 => 
            array (
                'id' => 4006,
                'country_id' => 233,
                'name' => 'Vasternorrlands Lan',
                'code' => 'VN',
                'adm1code' => 'SW24',
            ),
            14 => 
            array (
                'id' => 4007,
                'country_id' => 233,
                'name' => 'Vastmanlands Lan',
                'code' => 'VM',
                'adm1code' => 'SW25',
            ),
            15 => 
            array (
                'id' => 4008,
                'country_id' => 233,
                'name' => 'Stockholms Lan',
                'code' => 'ST',
                'adm1code' => 'SW26',
            ),
            16 => 
            array (
                'id' => 4009,
                'country_id' => 233,
                'name' => 'Skane Lan',
                'code' => 'SN',
                'adm1code' => 'SW27',
            ),
            17 => 
            array (
                'id' => 4010,
                'country_id' => 233,
                'name' => 'Vastra Gotaland',
                'code' => 'VG',
                'adm1code' => 'SW28',
            ),
            18 => 
            array (
                'id' => 4011,
                'country_id' => 235,
                'name' => 'Al Hasakah',
                'code' => 'HA',
                'adm1code' => 'SY01',
            ),
            19 => 
            array (
                'id' => 4012,
                'country_id' => 235,
                'name' => 'Al Ladhiqiyah',
                'code' => 'LA',
                'adm1code' => 'SY02',
            ),
            20 => 
            array (
                'id' => 4013,
                'country_id' => 235,
                'name' => 'Al Qunaytirah',
                'code' => 'QU',
                'adm1code' => 'SY03',
            ),
            21 => 
            array (
                'id' => 4014,
                'country_id' => 235,
                'name' => 'Ar Raqqah',
                'code' => 'RA',
                'adm1code' => 'SY04',
            ),
            22 => 
            array (
                'id' => 4015,
                'country_id' => 235,
                'name' => 'As Suwayda\'',
                'code' => 'SU',
                'adm1code' => 'SY05',
            ),
            23 => 
            array (
                'id' => 4016,
                'country_id' => 235,
                'name' => 'Dar\'a',
                'code' => 'DR',
                'adm1code' => 'SY06',
            ),
            24 => 
            array (
                'id' => 4017,
                'country_id' => 235,
                'name' => 'Dayr az Zawr',
                'code' => 'DY',
                'adm1code' => 'SY07',
            ),
            25 => 
            array (
                'id' => 4018,
                'country_id' => 235,
                'name' => 'Rif Dimashq',
                'code' => 'RD',
                'adm1code' => 'SY08',
            ),
            26 => 
            array (
                'id' => 4019,
                'country_id' => 235,
                'name' => 'Halab',
                'code' => 'HL',
                'adm1code' => 'SY09',
            ),
            27 => 
            array (
                'id' => 4020,
                'country_id' => 235,
                'name' => 'Hamah',
                'code' => 'HM',
                'adm1code' => 'SY10',
            ),
            28 => 
            array (
                'id' => 4021,
                'country_id' => 235,
                'name' => 'Hims',
                'code' => 'HI',
                'adm1code' => 'SY11',
            ),
            29 => 
            array (
                'id' => 4022,
                'country_id' => 235,
                'name' => 'Idlib',
                'code' => 'ID',
                'adm1code' => 'SY12',
            ),
            30 => 
            array (
                'id' => 4023,
                'country_id' => 235,
                'name' => 'Dimashq',
                'code' => 'DI',
                'adm1code' => 'SY13',
            ),
            31 => 
            array (
                'id' => 4024,
                'country_id' => 235,
                'name' => 'Tartus',
                'code' => 'TA',
                'adm1code' => 'SY14',
            ),
            32 => 
            array (
                'id' => 4025,
                'country_id' => 234,
                'name' => 'Aargau',
                'code' => 'AG',
                'adm1code' => 'SZ01',
            ),
            33 => 
            array (
                'id' => 4026,
                'country_id' => 234,
                'name' => 'Ausser-Rhoden',
                'code' => 'AR',
                'adm1code' => 'SZ02',
            ),
            34 => 
            array (
                'id' => 4027,
                'country_id' => 234,
                'name' => 'Basel-Landschaft',
                'code' => 'BL',
                'adm1code' => 'SZ03',
            ),
            35 => 
            array (
                'id' => 4028,
                'country_id' => 234,
                'name' => 'Basel-Stadt',
                'code' => 'BS',
                'adm1code' => 'SZ04',
            ),
            36 => 
            array (
                'id' => 4029,
                'country_id' => 234,
                'name' => 'Bern',
                'code' => 'BE',
                'adm1code' => 'SZ05',
            ),
            37 => 
            array (
                'id' => 4030,
                'country_id' => 234,
                'name' => 'Fribourg',
                'code' => 'FR',
                'adm1code' => 'SZ06',
            ),
            38 => 
            array (
                'id' => 4031,
                'country_id' => 234,
                'name' => 'Geneve',
                'code' => 'GE',
                'adm1code' => 'SZ07',
            ),
            39 => 
            array (
                'id' => 4032,
                'country_id' => 234,
                'name' => 'Glarus',
                'code' => 'GL',
                'adm1code' => 'SZ08',
            ),
            40 => 
            array (
                'id' => 4033,
                'country_id' => 234,
                'name' => 'Graubunden',
                'code' => 'GR',
                'adm1code' => 'SZ09',
            ),
            41 => 
            array (
                'id' => 4034,
                'country_id' => 234,
                'name' => 'Inner-Rhoden',
                'code' => 'AI',
                'adm1code' => 'SZ10',
            ),
            42 => 
            array (
                'id' => 4035,
                'country_id' => 234,
                'name' => 'Luzern',
                'code' => 'LU',
                'adm1code' => 'SZ11',
            ),
            43 => 
            array (
                'id' => 4036,
                'country_id' => 234,
                'name' => 'Neuchatel',
                'code' => 'NE',
                'adm1code' => 'SZ12',
            ),
            44 => 
            array (
                'id' => 4037,
                'country_id' => 234,
                'name' => 'Nidwalden',
                'code' => 'NW',
                'adm1code' => 'SZ13',
            ),
            45 => 
            array (
                'id' => 4038,
                'country_id' => 234,
                'name' => 'Obwalden',
                'code' => 'OW',
                'adm1code' => 'SZ14',
            ),
            46 => 
            array (
                'id' => 4039,
                'country_id' => 234,
                'name' => 'Sankt Gallen',
                'code' => 'SG',
                'adm1code' => 'SZ15',
            ),
            47 => 
            array (
                'id' => 4040,
                'country_id' => 234,
                'name' => 'Schaffhausen',
                'code' => 'SH',
                'adm1code' => 'SZ16',
            ),
            48 => 
            array (
                'id' => 4041,
                'country_id' => 234,
                'name' => 'Schwyz',
                'code' => 'SZ',
                'adm1code' => 'SZ17',
            ),
            49 => 
            array (
                'id' => 4042,
                'country_id' => 234,
                'name' => 'Solothurn',
                'code' => 'SO',
                'adm1code' => 'SZ18',
            ),
            50 => 
            array (
                'id' => 4043,
                'country_id' => 234,
                'name' => 'Thurgau',
                'code' => 'TG',
                'adm1code' => 'SZ19',
            ),
            51 => 
            array (
                'id' => 4044,
                'country_id' => 234,
                'name' => 'Ticino',
                'code' => 'TI',
                'adm1code' => 'SZ20',
            ),
            52 => 
            array (
                'id' => 4045,
                'country_id' => 234,
                'name' => 'Uri',
                'code' => 'UR',
                'adm1code' => 'SZ21',
            ),
            53 => 
            array (
                'id' => 4046,
                'country_id' => 234,
                'name' => 'Valais',
                'code' => 'VS',
                'adm1code' => 'SZ22',
            ),
            54 => 
            array (
                'id' => 4047,
                'country_id' => 234,
                'name' => 'Vaud',
                'code' => 'VD',
                'adm1code' => 'SZ23',
            ),
            55 => 
            array (
                'id' => 4048,
                'country_id' => 234,
                'name' => 'Zug',
                'code' => 'ZG',
                'adm1code' => 'SZ24',
            ),
            56 => 
            array (
                'id' => 4049,
                'country_id' => 234,
                'name' => 'Zurich',
                'code' => 'ZH',
                'adm1code' => 'SZ25',
            ),
            57 => 
            array (
                'id' => 4050,
                'country_id' => 234,
                'name' => 'Jura',
                'code' => 'JU',
                'adm1code' => 'SZ26',
            ),
            58 => 
            array (
                'id' => 4051,
                'country_id' => 243,
                'name' => 'Arima',
                'code' => 'AR',
                'adm1code' => 'TD01',
            ),
            59 => 
            array (
                'id' => 4052,
                'country_id' => 243,
                'name' => 'Caroni',
                'code' => 'CA',
                'adm1code' => 'TD02',
            ),
            60 => 
            array (
                'id' => 4053,
                'country_id' => 243,
                'name' => 'Mayaro',
                'code' => 'MA',
                'adm1code' => 'TD03',
            ),
            61 => 
            array (
                'id' => 4054,
                'country_id' => 243,
                'name' => 'Nariva',
                'code' => 'NA',
                'adm1code' => 'TD04',
            ),
            62 => 
            array (
                'id' => 4055,
                'country_id' => 243,
                'name' => 'Port-of-Spain',
                'code' => 'PO',
                'adm1code' => 'TD05',
            ),
            63 => 
            array (
                'id' => 4056,
                'country_id' => 243,
                'name' => 'Saint Andrew',
                'code' => 'SA',
                'adm1code' => 'TD06',
            ),
            64 => 
            array (
                'id' => 4057,
                'country_id' => 243,
                'name' => 'Saint David',
                'code' => 'SD',
                'adm1code' => 'TD07',
            ),
            65 => 
            array (
                'id' => 4058,
                'country_id' => 243,
                'name' => 'Saint George',
                'code' => 'SG',
                'adm1code' => 'TD08',
            ),
            66 => 
            array (
                'id' => 4059,
                'country_id' => 243,
                'name' => 'Saint Patrick',
                'code' => 'SP',
                'adm1code' => 'TD09',
            ),
            67 => 
            array (
                'id' => 4060,
                'country_id' => 243,
                'name' => 'San Fernando',
                'code' => 'SF',
                'adm1code' => 'TD10',
            ),
            68 => 
            array (
                'id' => 4061,
                'country_id' => 243,
                'name' => 'Tobago',
                'code' => 'TO',
                'adm1code' => 'TD11',
            ),
            69 => 
            array (
                'id' => 4062,
                'country_id' => 243,
                'name' => 'Victoria',
                'code' => 'VI',
                'adm1code' => 'TD12',
            ),
            70 => 
            array (
                'id' => 4063,
                'country_id' => 239,
                'name' => 'Mae Hong Son',
                'code' => 'MH',
                'adm1code' => 'TH01',
            ),
            71 => 
            array (
                'id' => 4064,
                'country_id' => 239,
                'name' => 'Chiang Mai',
                'code' => 'CM',
                'adm1code' => 'TH02',
            ),
            72 => 
            array (
                'id' => 4065,
                'country_id' => 239,
                'name' => 'Chiang Rai',
                'code' => 'CR',
                'adm1code' => 'TH03',
            ),
            73 => 
            array (
                'id' => 4066,
                'country_id' => 239,
                'name' => 'Nan',
                'code' => 'NA',
                'adm1code' => 'TH04',
            ),
            74 => 
            array (
                'id' => 4067,
                'country_id' => 239,
                'name' => 'Lamphun',
                'code' => 'LN',
                'adm1code' => 'TH05',
            ),
            75 => 
            array (
                'id' => 4068,
                'country_id' => 239,
                'name' => 'Lampang',
                'code' => 'LG',
                'adm1code' => 'TH06',
            ),
            76 => 
            array (
                'id' => 4069,
                'country_id' => 239,
                'name' => 'Phrae',
                'code' => 'PR',
                'adm1code' => 'TH07',
            ),
            77 => 
            array (
                'id' => 4070,
                'country_id' => 239,
                'name' => 'Tak',
                'code' => 'TK',
                'adm1code' => 'TH08',
            ),
            78 => 
            array (
                'id' => 4071,
                'country_id' => 239,
                'name' => 'Sukhothai',
                'code' => 'SO',
                'adm1code' => 'TH09',
            ),
            79 => 
            array (
                'id' => 4072,
                'country_id' => 239,
                'name' => 'Uttaradit',
                'code' => 'UD',
                'adm1code' => 'TH10',
            ),
            80 => 
            array (
                'id' => 4073,
                'country_id' => 239,
                'name' => 'Kamphaeng Phet',
                'code' => 'KP',
                'adm1code' => 'TH11',
            ),
            81 => 
            array (
                'id' => 4074,
                'country_id' => 239,
                'name' => 'Phitsanulok',
                'code' => 'PS',
                'adm1code' => 'TH12',
            ),
            82 => 
            array (
                'id' => 4075,
                'country_id' => 239,
                'name' => 'Phichit',
                'code' => 'PC',
                'adm1code' => 'TH13',
            ),
            83 => 
            array (
                'id' => 4076,
                'country_id' => 239,
                'name' => 'Phetchabun',
                'code' => 'PH',
                'adm1code' => 'TH14',
            ),
            84 => 
            array (
                'id' => 4077,
                'country_id' => 239,
                'name' => 'Uthai Thani',
                'code' => 'UT',
                'adm1code' => 'TH15',
            ),
            85 => 
            array (
                'id' => 4078,
                'country_id' => 239,
                'name' => 'Nakhon Sawan',
                'code' => 'NS',
                'adm1code' => 'TH16',
            ),
            86 => 
            array (
                'id' => 4079,
                'country_id' => 239,
                'name' => 'Nong Khai',
                'code' => 'NK',
                'adm1code' => 'TH17',
            ),
            87 => 
            array (
                'id' => 4080,
                'country_id' => 239,
                'name' => 'Loei',
                'code' => 'LE',
                'adm1code' => 'TH18',
            ),
            88 => 
            array (
                'id' => 4081,
                'country_id' => 239,
                'name' => 'Udon Thani',
                'code' => 'UN',
                'adm1code' => 'TH76',
            ),
            89 => 
            array (
                'id' => 4082,
                'country_id' => 239,
                'name' => 'Sakon Nakhon',
                'code' => 'SN',
                'adm1code' => 'TH20',
            ),
            90 => 
            array (
                'id' => 4083,
                'country_id' => 239,
                'name' => 'Nakhon Phanom',
                'code' => 'NF',
                'adm1code' => 'TH73',
            ),
            91 => 
            array (
                'id' => 4084,
                'country_id' => 239,
                'name' => 'Khon Kaen',
                'code' => 'KK',
                'adm1code' => 'TH22',
            ),
            92 => 
            array (
                'id' => 4085,
                'country_id' => 239,
                'name' => 'Kalasin',
                'code' => 'KL',
                'adm1code' => 'TH23',
            ),
            93 => 
            array (
                'id' => 4086,
                'country_id' => 239,
                'name' => 'Maha Sarakham',
                'code' => 'MS',
                'adm1code' => 'TH24',
            ),
            94 => 
            array (
                'id' => 4087,
                'country_id' => 239,
                'name' => 'Roi Et',
                'code' => 'RE',
                'adm1code' => 'TH25',
            ),
            95 => 
            array (
                'id' => 4088,
                'country_id' => 239,
                'name' => 'Chaiyaphum',
                'code' => 'CY',
                'adm1code' => 'TH26',
            ),
            96 => 
            array (
                'id' => 4089,
                'country_id' => 239,
                'name' => 'Nakhon Ratchasima',
                'code' => 'NR',
                'adm1code' => 'TH27',
            ),
            97 => 
            array (
                'id' => 4090,
                'country_id' => 239,
                'name' => 'Buriram',
                'code' => 'BR',
                'adm1code' => 'TH28',
            ),
            98 => 
            array (
                'id' => 4091,
                'country_id' => 239,
                'name' => 'Surin',
                'code' => 'SU',
                'adm1code' => 'TH29',
            ),
            99 => 
            array (
                'id' => 4092,
                'country_id' => 239,
                'name' => 'Sisaket',
                'code' => 'SI',
                'adm1code' => 'TH30',
            ),
            100 => 
            array (
                'id' => 4093,
                'country_id' => 239,
                'name' => 'Narathiwat',
                'code' => 'NW',
                'adm1code' => 'TH31',
            ),
            101 => 
            array (
                'id' => 4094,
                'country_id' => 239,
                'name' => 'Chai Nat',
                'code' => 'CN',
                'adm1code' => 'TH32',
            ),
            102 => 
            array (
                'id' => 4095,
                'country_id' => 239,
                'name' => 'Sing Buri',
                'code' => 'SB',
                'adm1code' => 'TH33',
            ),
            103 => 
            array (
                'id' => 4096,
                'country_id' => 239,
                'name' => 'Lop Buri',
                'code' => 'LB',
                'adm1code' => 'TH34',
            ),
            104 => 
            array (
                'id' => 4097,
                'country_id' => 239,
                'name' => 'Ang Thong',
                'code' => 'AT',
                'adm1code' => 'TH35',
            ),
            105 => 
            array (
                'id' => 4098,
                'country_id' => 239,
                'name' => 'Phra Nakhon Si Ayutthaya',
                'code' => 'PA',
                'adm1code' => 'TH36',
            ),
            106 => 
            array (
                'id' => 4099,
                'country_id' => 239,
                'name' => 'Sara Buri',
                'code' => 'SR',
                'adm1code' => 'TH37',
            ),
            107 => 
            array (
                'id' => 4100,
                'country_id' => 239,
                'name' => 'Nonthaburi',
                'code' => 'NO',
                'adm1code' => 'TH38',
            ),
            108 => 
            array (
                'id' => 4101,
                'country_id' => 239,
                'name' => 'Pathum Thani',
                'code' => 'PT',
                'adm1code' => 'TH39',
            ),
            109 => 
            array (
                'id' => 4102,
                'country_id' => 239,
                'name' => 'Krung Thep Mahanakhon',
                'code' => 'BM',
                'adm1code' => 'TH40',
            ),
            110 => 
            array (
                'id' => 4103,
                'country_id' => 239,
                'name' => 'Phayao',
                'code' => 'PY',
                'adm1code' => 'TH41',
            ),
            111 => 
            array (
                'id' => 4104,
                'country_id' => 239,
                'name' => 'Samut Prakan',
                'code' => 'SP',
                'adm1code' => 'TH42',
            ),
            112 => 
            array (
                'id' => 4105,
                'country_id' => 239,
                'name' => 'Nakhon Nayok',
                'code' => 'NN',
                'adm1code' => 'TH43',
            ),
            113 => 
            array (
                'id' => 4106,
                'country_id' => 239,
                'name' => 'Chachoengsao',
                'code' => 'CC',
                'adm1code' => 'TH44',
            ),
            114 => 
            array (
                'id' => 4107,
                'country_id' => 239,
                'name' => 'Prachin Buri',
                'code' => 'PB',
                'adm1code' => 'TH74',
            ),
            115 => 
            array (
                'id' => 4108,
                'country_id' => 239,
                'name' => 'Chon Buri',
                'code' => 'CB',
                'adm1code' => 'TH46',
            ),
            116 => 
            array (
                'id' => 4109,
                'country_id' => 239,
                'name' => 'Rayong',
                'code' => 'RY',
                'adm1code' => 'TH47',
            ),
            117 => 
            array (
                'id' => 4110,
                'country_id' => 239,
                'name' => 'Chanthaburi',
                'code' => 'CT',
                'adm1code' => 'TH48',
            ),
            118 => 
            array (
                'id' => 4111,
                'country_id' => 239,
                'name' => 'Trat',
                'code' => 'TT',
                'adm1code' => 'TH49',
            ),
            119 => 
            array (
                'id' => 4112,
                'country_id' => 239,
                'name' => 'Kanchanaburi',
                'code' => 'KN',
                'adm1code' => 'TH50',
            ),
            120 => 
            array (
                'id' => 4113,
                'country_id' => 239,
                'name' => 'Suphan Buri',
                'code' => 'SH',
                'adm1code' => 'TH51',
            ),
            121 => 
            array (
                'id' => 4114,
                'country_id' => 239,
                'name' => 'Ratchaburi',
                'code' => 'RT',
                'adm1code' => 'TH52',
            ),
            122 => 
            array (
                'id' => 4115,
                'country_id' => 239,
                'name' => 'Nakhon Pathom',
                'code' => 'NP',
                'adm1code' => 'TH53',
            ),
            123 => 
            array (
                'id' => 4116,
                'country_id' => 239,
                'name' => 'Samut Songkhram',
                'code' => 'SM',
                'adm1code' => 'TH54',
            ),
            124 => 
            array (
                'id' => 4117,
                'country_id' => 239,
                'name' => 'Samut Sakhon',
                'code' => 'SS',
                'adm1code' => 'TH55',
            ),
            125 => 
            array (
                'id' => 4118,
                'country_id' => 239,
                'name' => 'Phetchaburi',
                'code' => 'PE',
                'adm1code' => 'TH56',
            ),
            126 => 
            array (
                'id' => 4119,
                'country_id' => 239,
                'name' => 'Prachuap Khiri Khan',
                'code' => 'PK',
                'adm1code' => 'TH57',
            ),
            127 => 
            array (
                'id' => 4120,
                'country_id' => 239,
                'name' => 'Chumphon',
                'code' => 'CP',
                'adm1code' => 'TH58',
            ),
            128 => 
            array (
                'id' => 4121,
                'country_id' => 239,
                'name' => 'Ranong',
                'code' => 'RN',
                'adm1code' => 'TH59',
            ),
            129 => 
            array (
                'id' => 4122,
                'country_id' => 239,
                'name' => 'Surat Thani',
                'code' => 'ST',
                'adm1code' => 'TH60',
            ),
            130 => 
            array (
                'id' => 4123,
                'country_id' => 239,
                'name' => 'Phangnga',
                'code' => 'PG',
                'adm1code' => 'TH61',
            ),
            131 => 
            array (
                'id' => 4124,
                'country_id' => 239,
                'name' => 'Phuket',
                'code' => 'PU',
                'adm1code' => 'TH62',
            ),
            132 => 
            array (
                'id' => 4125,
                'country_id' => 239,
                'name' => 'Krabi',
                'code' => 'KR',
                'adm1code' => 'TH63',
            ),
            133 => 
            array (
                'id' => 4126,
                'country_id' => 239,
                'name' => 'Nakon Si Thammarat',
                'code' => 'NT',
                'adm1code' => 'TH64',
            ),
            134 => 
            array (
                'id' => 4127,
                'country_id' => 239,
                'name' => 'Trang',
                'code' => 'TG',
                'adm1code' => 'TH65',
            ),
            135 => 
            array (
                'id' => 4128,
                'country_id' => 239,
                'name' => 'Phatthalung',
                'code' => 'PL',
                'adm1code' => 'TH66',
            ),
            136 => 
            array (
                'id' => 4129,
                'country_id' => 239,
                'name' => 'Satun',
                'code' => 'SA',
                'adm1code' => 'TH67',
            ),
            137 => 
            array (
                'id' => 4130,
                'country_id' => 239,
                'name' => 'Songkhla',
                'code' => 'SG',
                'adm1code' => 'TH68',
            ),
            138 => 
            array (
                'id' => 4131,
                'country_id' => 239,
                'name' => 'Pattani',
                'code' => 'PI',
                'adm1code' => 'TH69',
            ),
            139 => 
            array (
                'id' => 4132,
                'country_id' => 239,
                'name' => 'Yala',
                'code' => 'YL',
                'adm1code' => 'TH70',
            ),
            140 => 
            array (
                'id' => 4134,
                'country_id' => 239,
                'name' => 'Yasothon',
                'code' => 'YS',
                'adm1code' => 'TH72',
            ),
            141 => 
            array (
                'id' => 4135,
                'country_id' => 239,
                'name' => 'Ubon Ratchanthani',
                'code' => 'UR',
                'adm1code' => 'TH75',
            ),
            142 => 
            array (
                'id' => 4136,
                'country_id' => 239,
                'name' => 'Amnat Charoen',
                'code' => 'AC',
                'adm1code' => 'TH77',
            ),
            143 => 
            array (
                'id' => 4137,
                'country_id' => 239,
                'name' => 'Mukdahan',
                'code' => 'MD',
                'adm1code' => 'TH78',
            ),
            144 => 
            array (
                'id' => 4138,
                'country_id' => 239,
                'name' => 'Nong Bua Lamphu',
                'code' => 'NB',
                'adm1code' => 'TH79',
            ),
            145 => 
            array (
                'id' => 4139,
                'country_id' => 239,
                'name' => 'Sa Kaeo',
                'code' => 'SK',
                'adm1code' => 'TH80',
            ),
            146 => 
            array (
                'id' => 4140,
                'country_id' => 237,
                'name' => 'Kuhistoni Badakhshon',
                'code' => 'BK',
                'adm1code' => 'TI01',
            ),
            147 => 
            array (
                'id' => 4141,
                'country_id' => 237,
                'name' => 'Khatlon',
                'code' => 'KL',
                'adm1code' => 'TI02',
            ),
            148 => 
            array (
                'id' => 4142,
                'country_id' => 237,
                'name' => 'Leninobod',
                'code' => 'LE',
                'adm1code' => 'TI03',
            ),
            149 => 
            array (
                'id' => 4143,
                'country_id' => 242,
                'name' => 'Ha\'apai',
                'code' => 'HA',
                'adm1code' => 'TN01',
            ),
            150 => 
            array (
                'id' => 4144,
                'country_id' => 242,
                'name' => 'Tongatapu',
                'code' => 'TT',
                'adm1code' => 'TN02',
            ),
            151 => 
            array (
                'id' => 4145,
                'country_id' => 242,
                'name' => 'Vava\'u',
                'code' => 'VA',
                'adm1code' => 'TN03',
            ),
            152 => 
            array (
                'id' => 4167,
                'country_id' => 212,
                'name' => 'Principe',
                'code' => 'PR',
                'adm1code' => 'TP01',
            ),
            153 => 
            array (
                'id' => 4168,
                'country_id' => 212,
                'name' => 'Sao Tome',
                'code' => 'ST',
                'adm1code' => 'TP02',
            ),
            154 => 
            array (
                'id' => 4169,
                'country_id' => 245,
                'name' => 'Al Qasrayn',
                'code' => 'KS',
                'adm1code' => 'TS02',
            ),
            155 => 
            array (
                'id' => 4170,
                'country_id' => 245,
                'name' => 'Al Qayrawan',
                'code' => 'KR',
                'adm1code' => 'TS03',
            ),
            156 => 
            array (
                'id' => 4171,
                'country_id' => 245,
                'name' => 'Jundubah',
                'code' => 'JE',
                'adm1code' => 'TS06',
            ),
            157 => 
            array (
                'id' => 4172,
                'country_id' => 245,
                'name' => 'Al Kaf',
                'code' => 'KF',
                'adm1code' => 'TS14',
            ),
            158 => 
            array (
                'id' => 4173,
                'country_id' => 245,
                'name' => 'Al Mahdiyah',
                'code' => 'MH',
                'adm1code' => 'TS15',
            ),
            159 => 
            array (
                'id' => 4174,
                'country_id' => 245,
                'name' => 'Al Munastir',
                'code' => 'MS',
                'adm1code' => 'TS16',
            ),
            160 => 
            array (
                'id' => 4175,
                'country_id' => 245,
                'name' => 'Bajah',
                'code' => 'BJ',
                'adm1code' => 'TS17',
            ),
            161 => 
            array (
                'id' => 4176,
                'country_id' => 245,
                'name' => 'Banzart',
                'code' => 'BZ',
                'adm1code' => 'TS18',
            ),
            162 => 
            array (
                'id' => 4177,
                'country_id' => 245,
                'name' => 'Nabul',
                'code' => 'NB',
                'adm1code' => 'TS19',
            ),
            163 => 
            array (
                'id' => 4178,
                'country_id' => 245,
                'name' => 'Silyanah',
                'code' => 'SL',
                'adm1code' => 'TS22',
            ),
            164 => 
            array (
                'id' => 4179,
                'country_id' => 245,
                'name' => 'Susah',
                'code' => 'SS',
                'adm1code' => 'TS23',
            ),
            165 => 
            array (
                'id' => 4180,
                'country_id' => 245,
                'name' => 'Aryanah',
                'code' => 'AN',
                'adm1code' => 'TS26',
            ),
            166 => 
            array (
                'id' => 4181,
                'country_id' => 245,
                'name' => 'Bin \'Arus',
                'code' => 'BA',
                'adm1code' => 'TS27',
            ),
            167 => 
            array (
                'id' => 4182,
                'country_id' => 245,
                'name' => 'Madanin',
                'code' => 'ME',
                'adm1code' => 'TS28',
            ),
            168 => 
            array (
                'id' => 4183,
                'country_id' => 245,
                'name' => 'Qabis',
                'code' => 'GB',
                'adm1code' => 'TS29',
            ),
            169 => 
            array (
                'id' => 4184,
                'country_id' => 245,
                'name' => 'Qafsah',
                'code' => 'QA',
                'adm1code' => 'TS30',
            ),
            170 => 
            array (
                'id' => 4185,
                'country_id' => 245,
                'name' => 'Qibili',
                'code' => 'KB',
                'adm1code' => 'TS31',
            ),
            171 => 
            array (
                'id' => 4186,
                'country_id' => 245,
                'name' => 'Safaqi',
                'code' => 'SF',
                'adm1code' => 'TS32',
            ),
            172 => 
            array (
                'id' => 4187,
                'country_id' => 245,
                'name' => 'Sidi Bu Zayd',
                'code' => 'SZ',
                'adm1code' => 'TS33',
            ),
            173 => 
            array (
                'id' => 4188,
                'country_id' => 245,
                'name' => 'Tatawin',
                'code' => 'TA',
                'adm1code' => 'TS34',
            ),
            174 => 
            array (
                'id' => 4189,
                'country_id' => 245,
                'name' => 'Tawzar',
                'code' => 'TO',
                'adm1code' => 'TS35',
            ),
            175 => 
            array (
                'id' => 4190,
                'country_id' => 245,
                'name' => 'Tunis',
                'code' => 'TU',
                'adm1code' => 'TS36',
            ),
            176 => 
            array (
                'id' => 4191,
                'country_id' => 245,
                'name' => 'Zaghwan',
                'code' => 'ZA',
                'adm1code' => 'TS37',
            ),
            177 => 
            array (
                'id' => 4192,
                'country_id' => 246,
                'name' => 'Adana',
                'code' => 'AA',
                'adm1code' => 'TU81',
            ),
            178 => 
            array (
                'id' => 4193,
                'country_id' => 246,
                'name' => 'Adiyaman',
                'code' => 'AD',
                'adm1code' => 'TU02',
            ),
            179 => 
            array (
                'id' => 4194,
                'country_id' => 246,
                'name' => 'Afyon',
                'code' => 'AF',
                'adm1code' => 'TU03',
            ),
            180 => 
            array (
                'id' => 4195,
                'country_id' => 246,
                'name' => 'Agri',
                'code' => 'AG',
                'adm1code' => 'TU04',
            ),
            181 => 
            array (
                'id' => 4196,
                'country_id' => 246,
                'name' => 'Amasya',
                'code' => 'AM',
                'adm1code' => 'TU05',
            ),
            182 => 
            array (
                'id' => 4198,
                'country_id' => 246,
                'name' => 'Antalya',
                'code' => 'AL',
                'adm1code' => 'TU07',
            ),
            183 => 
            array (
                'id' => 4199,
                'country_id' => 246,
                'name' => 'Artvin',
                'code' => 'AV',
                'adm1code' => 'TU08',
            ),
            184 => 
            array (
                'id' => 4200,
                'country_id' => 246,
                'name' => 'Aydin',
                'code' => 'AY',
                'adm1code' => 'TU09',
            ),
            185 => 
            array (
                'id' => 4201,
                'country_id' => 246,
                'name' => 'Balikesir',
                'code' => 'BK',
                'adm1code' => 'TU10',
            ),
            186 => 
            array (
                'id' => 4202,
                'country_id' => 246,
                'name' => 'Bilecik',
                'code' => 'BC',
                'adm1code' => 'TU11',
            ),
            187 => 
            array (
                'id' => 4203,
                'country_id' => 246,
                'name' => 'Bingol',
                'code' => 'BG',
                'adm1code' => 'TU12',
            ),
            188 => 
            array (
                'id' => 4204,
                'country_id' => 246,
                'name' => 'Bitlis',
                'code' => 'BT',
                'adm1code' => 'TU13',
            ),
            189 => 
            array (
                'id' => 4205,
                'country_id' => 246,
                'name' => 'Bolu',
                'code' => 'BL',
                'adm1code' => 'TU14',
            ),
            190 => 
            array (
                'id' => 4206,
                'country_id' => 246,
                'name' => 'Burdur',
                'code' => 'BD',
                'adm1code' => 'TU15',
            ),
            191 => 
            array (
                'id' => 4207,
                'country_id' => 246,
                'name' => 'Bursa',
                'code' => 'BU',
                'adm1code' => 'TU16',
            ),
            192 => 
            array (
                'id' => 4208,
                'country_id' => 246,
                'name' => 'Canakkale',
                'code' => 'CK',
                'adm1code' => 'TU17',
            ),
            193 => 
            array (
                'id' => 4209,
                'country_id' => 246,
                'name' => 'Cankiri',
                'code' => 'CI',
                'adm1code' => 'TU82',
            ),
            194 => 
            array (
                'id' => 4210,
                'country_id' => 246,
                'name' => 'Corum',
                'code' => 'CM',
                'adm1code' => 'TU19',
            ),
            195 => 
            array (
                'id' => 4211,
                'country_id' => 246,
                'name' => 'Denizli',
                'code' => 'DN',
                'adm1code' => 'TU20',
            ),
            196 => 
            array (
                'id' => 4212,
                'country_id' => 246,
                'name' => 'Diyarbakir',
                'code' => 'DY',
                'adm1code' => 'TU21',
            ),
            197 => 
            array (
                'id' => 4213,
                'country_id' => 246,
                'name' => 'Edirne',
                'code' => 'ED',
                'adm1code' => 'TU22',
            ),
            198 => 
            array (
                'id' => 4214,
                'country_id' => 246,
                'name' => 'Elazig',
                'code' => 'EG',
                'adm1code' => 'TU23',
            ),
            199 => 
            array (
                'id' => 4215,
                'country_id' => 246,
                'name' => 'Erzincan',
                'code' => 'EN',
                'adm1code' => 'TU24',
            ),
            200 => 
            array (
                'id' => 4216,
                'country_id' => 246,
                'name' => 'Erzurum',
                'code' => 'EM',
                'adm1code' => 'TU25',
            ),
            201 => 
            array (
                'id' => 4217,
                'country_id' => 246,
                'name' => 'Eskisehir',
                'code' => 'ES',
                'adm1code' => 'TU26',
            ),
            202 => 
            array (
                'id' => 4218,
                'country_id' => 246,
                'name' => 'Gaziantep',
                'code' => 'GA',
                'adm1code' => 'TU83',
            ),
            203 => 
            array (
                'id' => 4219,
                'country_id' => 246,
                'name' => 'Giresun',
                'code' => 'GI',
                'adm1code' => 'TU28',
            ),
            204 => 
            array (
                'id' => 4222,
                'country_id' => 246,
                'name' => 'Hatay',
                'code' => 'HT',
                'adm1code' => 'TU31',
            ),
            205 => 
            array (
                'id' => 4223,
                'country_id' => 246,
                'name' => 'Icel',
                'code' => 'IC',
                'adm1code' => 'TU32',
            ),
            206 => 
            array (
                'id' => 4224,
                'country_id' => 246,
                'name' => 'Isparta',
                'code' => 'IP',
                'adm1code' => 'TU33',
            ),
            207 => 
            array (
                'id' => 4225,
                'country_id' => 246,
                'name' => 'Istanbul',
                'code' => 'IB',
                'adm1code' => 'TU34',
            ),
            208 => 
            array (
                'id' => 4226,
                'country_id' => 246,
                'name' => 'Izmir',
                'code' => 'IZ',
                'adm1code' => 'TU35',
            ),
            209 => 
            array (
                'id' => 4227,
                'country_id' => 246,
                'name' => 'Kars',
                'code' => 'KA',
                'adm1code' => 'TU84',
            ),
            210 => 
            array (
                'id' => 4228,
                'country_id' => 246,
                'name' => 'Kastamonu',
                'code' => 'KS',
                'adm1code' => 'TU37',
            ),
            211 => 
            array (
                'id' => 4229,
                'country_id' => 246,
                'name' => 'Kayseri',
                'code' => 'KY',
                'adm1code' => 'TU38',
            ),
            212 => 
            array (
                'id' => 4230,
                'country_id' => 246,
                'name' => 'Kirklareli',
                'code' => 'KL',
                'adm1code' => 'TU39',
            ),
            213 => 
            array (
                'id' => 4231,
                'country_id' => 246,
                'name' => 'Kirsehir',
                'code' => 'KH',
                'adm1code' => 'TU40',
            ),
            214 => 
            array (
                'id' => 4232,
                'country_id' => 246,
                'name' => 'Kocaeli',
                'code' => 'KC',
                'adm1code' => 'TU41',
            ),
            215 => 
            array (
                'id' => 4234,
                'country_id' => 246,
                'name' => 'Kutahya',
                'code' => 'KU',
                'adm1code' => 'TU43',
            ),
            216 => 
            array (
                'id' => 4235,
                'country_id' => 246,
                'name' => 'Malatya',
                'code' => 'ML',
                'adm1code' => 'TU44',
            ),
            217 => 
            array (
                'id' => 4236,
                'country_id' => 246,
                'name' => 'Manisa',
                'code' => 'MN',
                'adm1code' => 'TU45',
            ),
            218 => 
            array (
                'id' => 4237,
                'country_id' => 246,
                'name' => 'Kahramanmaras',
                'code' => 'KM',
                'adm1code' => 'TU46',
            ),
            219 => 
            array (
                'id' => 4239,
                'country_id' => 246,
                'name' => 'Mugla',
                'code' => 'MG',
                'adm1code' => 'TU48',
            ),
            220 => 
            array (
                'id' => 4240,
                'country_id' => 246,
                'name' => 'Mus',
                'code' => 'MS',
                'adm1code' => 'TU49',
            ),
            221 => 
            array (
                'id' => 4241,
                'country_id' => 246,
                'name' => 'Nevsehir',
                'code' => 'NV',
                'adm1code' => 'TU50',
            ),
            222 => 
            array (
                'id' => 4243,
                'country_id' => 246,
                'name' => 'Ordu',
                'code' => 'OR',
                'adm1code' => 'TU52',
            ),
            223 => 
            array (
                'id' => 4244,
                'country_id' => 246,
                'name' => 'Rize',
                'code' => 'RI',
                'adm1code' => 'TU53',
            ),
            224 => 
            array (
                'id' => 4245,
                'country_id' => 246,
                'name' => 'Sakarya',
                'code' => 'SK',
                'adm1code' => 'TU54',
            ),
            225 => 
            array (
                'id' => 4246,
                'country_id' => 246,
                'name' => 'Samsun',
                'code' => 'SS',
                'adm1code' => 'TU55',
            ),
            226 => 
            array (
                'id' => 4248,
                'country_id' => 246,
                'name' => 'Sinop',
                'code' => 'SP',
                'adm1code' => 'TU57',
            ),
            227 => 
            array (
                'id' => 4249,
                'country_id' => 246,
                'name' => 'Sivas',
                'code' => 'SV',
                'adm1code' => 'TU58',
            ),
            228 => 
            array (
                'id' => 4250,
                'country_id' => 246,
                'name' => 'Tekirdag',
                'code' => 'TG',
                'adm1code' => 'TU59',
            ),
            229 => 
            array (
                'id' => 4251,
                'country_id' => 246,
                'name' => 'Tokat',
                'code' => 'TT',
                'adm1code' => 'TU60',
            ),
            230 => 
            array (
                'id' => 4252,
                'country_id' => 246,
                'name' => 'Trabzon',
                'code' => 'TB',
                'adm1code' => 'TU61',
            ),
            231 => 
            array (
                'id' => 4253,
                'country_id' => 246,
                'name' => 'Tunceli',
                'code' => 'TC',
                'adm1code' => 'TU62',
            ),
            232 => 
            array (
                'id' => 4254,
                'country_id' => 246,
                'name' => 'Sanliurfa',
                'code' => 'SU',
                'adm1code' => 'TU63',
            ),
            233 => 
            array (
                'id' => 4255,
                'country_id' => 246,
                'name' => 'Usak',
                'code' => 'US',
                'adm1code' => 'TU64',
            ),
            234 => 
            array (
                'id' => 4256,
                'country_id' => 246,
                'name' => 'Van',
                'code' => 'VA',
                'adm1code' => 'TU65',
            ),
            235 => 
            array (
                'id' => 4257,
                'country_id' => 246,
                'name' => 'Yozgat',
                'code' => 'YZ',
                'adm1code' => 'TU66',
            ),
            236 => 
            array (
                'id' => 4258,
                'country_id' => 246,
                'name' => 'Zonguldak',
                'code' => 'ZO',
                'adm1code' => 'TU85',
            ),
            237 => 
            array (
                'id' => 4259,
                'country_id' => 246,
                'name' => 'Ankara',
                'code' => 'AN',
                'adm1code' => 'TU68',
            ),
            238 => 
            array (
                'id' => 4260,
                'country_id' => 246,
                'name' => 'Gumushane',
                'code' => 'GU',
                'adm1code' => 'TU69',
            ),
            239 => 
            array (
                'id' => 4261,
                'country_id' => 246,
                'name' => 'Hakkari',
                'code' => 'HK',
                'adm1code' => 'TU70',
            ),
            240 => 
            array (
                'id' => 4262,
                'country_id' => 246,
                'name' => 'Konya',
                'code' => 'KO',
                'adm1code' => 'TU71',
            ),
            241 => 
            array (
                'id' => 4263,
                'country_id' => 246,
                'name' => 'Mardin',
                'code' => 'MR',
                'adm1code' => 'TU72',
            ),
            242 => 
            array (
                'id' => 4264,
                'country_id' => 246,
                'name' => 'Nigde',
                'code' => 'NG',
                'adm1code' => 'TU73',
            ),
            243 => 
            array (
                'id' => 4265,
                'country_id' => 246,
                'name' => 'Siirt',
                'code' => 'SI',
                'adm1code' => 'TU74',
            ),
            244 => 
            array (
                'id' => 4266,
                'country_id' => 246,
                'name' => 'Aksaray',
                'code' => 'AK',
                'adm1code' => 'TU75',
            ),
            245 => 
            array (
                'id' => 4267,
                'country_id' => 246,
                'name' => 'Batman',
                'code' => 'BM',
                'adm1code' => 'TU76',
            ),
            246 => 
            array (
                'id' => 4268,
                'country_id' => 246,
                'name' => 'Bayburt',
                'code' => 'BB',
                'adm1code' => 'TU77',
            ),
            247 => 
            array (
                'id' => 4269,
                'country_id' => 246,
                'name' => 'Karaman',
                'code' => 'KR',
                'adm1code' => 'TU78',
            ),
            248 => 
            array (
                'id' => 4270,
                'country_id' => 246,
                'name' => 'Kirikkale',
                'code' => 'KK',
                'adm1code' => 'TU79',
            ),
            249 => 
            array (
                'id' => 4271,
                'country_id' => 246,
                'name' => 'Sirnak',
                'code' => 'SR',
                'adm1code' => 'TU80',
            ),
            250 => 
            array (
                'id' => 4272,
                'country_id' => 236,
                'name' => 'Fu-chien',
                'code' => 'FK',
                'adm1code' => 'TW01',
            ),
            251 => 
            array (
                'id' => 4273,
                'country_id' => 236,
                'name' => 'Kao-hsiung',
                'code' => 'KH',
                'adm1code' => 'TW02',
            ),
            252 => 
            array (
                'id' => 4274,
                'country_id' => 236,
                'name' => 'T\'ai-pei',
                'code' => 'TP',
                'adm1code' => 'TW03',
            ),
            253 => 
            array (
                'id' => 4275,
                'country_id' => 236,
                'name' => 'T\'ai-wan',
                'code' => 'TA',
                'adm1code' => 'TW04',
            ),
            254 => 
            array (
                'id' => 4276,
                'country_id' => 238,
                'name' => 'Arusha',
                'code' => 'AR',
                'adm1code' => 'TZ01',
            ),
            255 => 
            array (
                'id' => 4277,
                'country_id' => 238,
                'name' => 'Dar es Salaam',
                'code' => 'DS',
                'adm1code' => 'TZ23',
            ),
            256 => 
            array (
                'id' => 4278,
                'country_id' => 238,
                'name' => 'Dodoma',
                'code' => 'DO',
                'adm1code' => 'TZ03',
            ),
            257 => 
            array (
                'id' => 4279,
                'country_id' => 238,
                'name' => 'Iringa',
                'code' => 'IR',
                'adm1code' => 'TZ04',
            ),
            258 => 
            array (
                'id' => 4280,
                'country_id' => 238,
                'name' => 'Kigoma',
                'code' => 'KM',
                'adm1code' => 'TZ05',
            ),
            259 => 
            array (
                'id' => 4281,
                'country_id' => 238,
                'name' => 'Kilimanjaro',
                'code' => 'KL',
                'adm1code' => 'TZ06',
            ),
            260 => 
            array (
                'id' => 4282,
                'country_id' => 238,
                'name' => 'Lindi',
                'code' => 'LI',
                'adm1code' => 'TZ07',
            ),
            261 => 
            array (
                'id' => 4283,
                'country_id' => 238,
                'name' => 'Mara',
                'code' => 'MA',
                'adm1code' => 'TZ08',
            ),
            262 => 
            array (
                'id' => 4284,
                'country_id' => 238,
                'name' => 'Mbeya',
                'code' => 'MB',
                'adm1code' => 'TZ09',
            ),
            263 => 
            array (
                'id' => 4285,
                'country_id' => 238,
                'name' => 'Morogoro',
                'code' => 'MO',
                'adm1code' => 'TZ10',
            ),
            264 => 
            array (
                'id' => 4286,
                'country_id' => 238,
                'name' => 'Mtwara',
                'code' => 'MT',
                'adm1code' => 'TZ11',
            ),
            265 => 
            array (
                'id' => 4287,
                'country_id' => 238,
                'name' => 'Mwanza',
                'code' => 'MW',
                'adm1code' => 'TZ12',
            ),
            266 => 
            array (
                'id' => 4288,
                'country_id' => 238,
                'name' => 'Pemba North',
                'code' => 'PN',
                'adm1code' => 'TZ13',
            ),
            267 => 
            array (
                'id' => 4289,
                'country_id' => 238,
                'name' => 'Ruvuma',
                'code' => 'RV',
                'adm1code' => 'TZ14',
            ),
            268 => 
            array (
                'id' => 4290,
                'country_id' => 238,
                'name' => 'Shinyanga',
                'code' => 'SH',
                'adm1code' => 'TZ15',
            ),
            269 => 
            array (
                'id' => 4291,
                'country_id' => 238,
                'name' => 'Singida',
                'code' => 'SD',
                'adm1code' => 'TZ16',
            ),
            270 => 
            array (
                'id' => 4292,
                'country_id' => 238,
                'name' => 'Tabora',
                'code' => 'TB',
                'adm1code' => 'TZ17',
            ),
            271 => 
            array (
                'id' => 4293,
                'country_id' => 238,
                'name' => 'Tanga',
                'code' => 'TN',
                'adm1code' => 'TZ18',
            ),
            272 => 
            array (
                'id' => 4294,
                'country_id' => 238,
                'name' => 'Kagera',
                'code' => 'KR',
                'adm1code' => 'TZ19',
            ),
            273 => 
            array (
                'id' => 4295,
                'country_id' => 238,
                'name' => 'Pemba South',
                'code' => 'PS',
                'adm1code' => 'TZ20',
            ),
            274 => 
            array (
                'id' => 4296,
                'country_id' => 238,
                'name' => 'Zanzibar Central//South',
                'code' => 'ZS',
                'adm1code' => 'TZ21',
            ),
            275 => 
            array (
                'id' => 4297,
                'country_id' => 238,
                'name' => 'Zanzibar North',
                'code' => 'ZN',
                'adm1code' => 'TZ22',
            ),
            276 => 
            array (
                'id' => 4298,
                'country_id' => 238,
                'name' => 'Rukwa',
                'code' => 'RK',
                'adm1code' => 'TZ24',
            ),
            277 => 
            array (
                'id' => 4299,
                'country_id' => 238,
                'name' => 'Zanzibar Urban//West',
                'code' => 'ZW',
                'adm1code' => 'TZ25',
            ),
            278 => 
            array (
                'id' => 4300,
                'country_id' => 250,
                'name' => 'Apac',
                'code' => 'AP',
                'adm1code' => 'UG26',
            ),
            279 => 
            array (
                'id' => 4301,
                'country_id' => 250,
                'name' => 'Arua',
                'code' => 'AR',
                'adm1code' => 'UG27',
            ),
            280 => 
            array (
                'id' => 4302,
                'country_id' => 250,
                'name' => 'Bundibogyo',
                'code' => 'BN',
                'adm1code' => 'UG28',
            ),
            281 => 
            array (
                'id' => 4303,
                'country_id' => 250,
                'name' => 'Bushenyi',
                'code' => 'BS',
                'adm1code' => 'UG29',
            ),
            282 => 
            array (
                'id' => 4304,
                'country_id' => 250,
                'name' => 'Gulu',
                'code' => 'GU',
                'adm1code' => 'UG30',
            ),
            283 => 
            array (
                'id' => 4305,
                'country_id' => 250,
                'name' => 'Hoima',
                'code' => 'HO',
                'adm1code' => 'UG31',
            ),
            284 => 
            array (
                'id' => 4306,
                'country_id' => 250,
                'name' => 'Iganga',
                'code' => 'IG',
                'adm1code' => 'UG68',
            ),
            285 => 
            array (
                'id' => 4307,
                'country_id' => 250,
                'name' => 'Jinja',
                'code' => 'JI',
                'adm1code' => 'UG33',
            ),
            286 => 
            array (
                'id' => 4308,
                'country_id' => 250,
                'name' => 'Kabale',
                'code' => 'KA',
                'adm1code' => 'UG34',
            ),
            287 => 
            array (
                'id' => 4309,
                'country_id' => 250,
                'name' => 'Kabarole',
                'code' => 'KB',
                'adm1code' => 'UG35',
            ),
            288 => 
            array (
                'id' => 4310,
                'country_id' => 250,
                'name' => 'Kalangala',
                'code' => 'KN',
                'adm1code' => 'UG36',
            ),
            289 => 
            array (
                'id' => 4311,
                'country_id' => 250,
                'name' => 'Kampala',
                'code' => 'KM',
                'adm1code' => 'UG37',
            ),
            290 => 
            array (
                'id' => 4312,
                'country_id' => 250,
                'name' => 'Kamuli',
                'code' => 'KL',
                'adm1code' => 'UG38',
            ),
            291 => 
            array (
                'id' => 4313,
                'country_id' => 250,
                'name' => 'Kapchorwa',
                'code' => 'KC',
                'adm1code' => 'UG39',
            ),
            292 => 
            array (
                'id' => 4314,
                'country_id' => 250,
                'name' => 'Kasese',
                'code' => 'KS',
                'adm1code' => 'UG40',
            ),
            293 => 
            array (
                'id' => 4315,
                'country_id' => 250,
                'name' => 'Kibale',
                'code' => 'KI',
                'adm1code' => 'UG41',
            ),
            294 => 
            array (
                'id' => 4316,
                'country_id' => 250,
                'name' => 'Kiboga',
                'code' => 'KG',
                'adm1code' => 'UG42',
            ),
            295 => 
            array (
                'id' => 4317,
                'country_id' => 250,
                'name' => 'Kisoro',
                'code' => 'KR',
                'adm1code' => 'UG43',
            ),
            296 => 
            array (
                'id' => 4318,
                'country_id' => 250,
                'name' => 'Kitgum',
                'code' => 'KT',
                'adm1code' => 'UG44',
            ),
            297 => 
            array (
                'id' => 4319,
                'country_id' => 250,
                'name' => 'Kotido',
                'code' => 'KO',
                'adm1code' => 'UG45',
            ),
            298 => 
            array (
                'id' => 4320,
                'country_id' => 250,
                'name' => 'Kumi',
                'code' => 'KU',
                'adm1code' => 'UG46',
            ),
            299 => 
            array (
                'id' => 4321,
                'country_id' => 250,
                'name' => 'Lira',
                'code' => 'LI',
                'adm1code' => 'UG47',
            ),
            300 => 
            array (
                'id' => 4322,
                'country_id' => 250,
                'name' => 'Luwero',
                'code' => 'LU',
                'adm1code' => 'UG70',
            ),
            301 => 
            array (
                'id' => 4323,
                'country_id' => 250,
                'name' => 'Masaka',
                'code' => 'MA',
                'adm1code' => 'UG71',
            ),
            302 => 
            array (
                'id' => 4324,
                'country_id' => 250,
                'name' => 'Masindi',
                'code' => 'MS',
                'adm1code' => 'UG50',
            ),
            303 => 
            array (
                'id' => 4325,
                'country_id' => 250,
                'name' => 'Mbale',
                'code' => 'ML',
                'adm1code' => 'UG51',
            ),
            304 => 
            array (
                'id' => 4326,
                'country_id' => 250,
                'name' => 'Mbarara',
                'code' => 'MR',
                'adm1code' => 'UG52',
            ),
            305 => 
            array (
                'id' => 4327,
                'country_id' => 250,
                'name' => 'Moroto',
                'code' => 'MO',
                'adm1code' => 'UG53',
            ),
            306 => 
            array (
                'id' => 4328,
                'country_id' => 250,
                'name' => 'Moyo',
                'code' => 'MY',
                'adm1code' => 'UG72',
            ),
            307 => 
            array (
                'id' => 4329,
                'country_id' => 250,
                'name' => 'Mpigi',
                'code' => 'MP',
                'adm1code' => 'UG55',
            ),
            308 => 
            array (
                'id' => 4330,
                'country_id' => 250,
                'name' => 'Mubende',
                'code' => 'MU',
                'adm1code' => 'UG56',
            ),
            309 => 
            array (
                'id' => 4331,
                'country_id' => 250,
                'name' => 'Mukono',
                'code' => 'MK',
                'adm1code' => 'UG57',
            ),
            310 => 
            array (
                'id' => 4332,
                'country_id' => 250,
                'name' => 'Nebbi',
                'code' => 'NE',
                'adm1code' => 'UG58',
            ),
            311 => 
            array (
                'id' => 4333,
                'country_id' => 250,
                'name' => 'Ntungamo',
                'code' => 'NT',
                'adm1code' => 'UG59',
            ),
            312 => 
            array (
                'id' => 4334,
                'country_id' => 250,
                'name' => 'Pallisa',
                'code' => 'PA',
                'adm1code' => 'UG60',
            ),
            313 => 
            array (
                'id' => 4335,
                'country_id' => 250,
                'name' => 'Rakai',
                'code' => 'RA',
                'adm1code' => 'UG61',
            ),
            314 => 
            array (
                'id' => 4336,
                'country_id' => 250,
                'name' => 'Rukungiri',
                'code' => 'RU',
                'adm1code' => 'UG62',
            ),
            315 => 
            array (
                'id' => 4337,
                'country_id' => 250,
                'name' => 'Soroti',
                'code' => 'SO',
                'adm1code' => 'UG75',
            ),
            316 => 
            array (
                'id' => 4338,
                'country_id' => 250,
                'name' => 'Tororo',
                'code' => 'TO',
                'adm1code' => 'UG76',
            ),
            317 => 
            array (
                'id' => 4431,
                'country_id' => 251,
                'name' => 'Cherkas\'ka Oblast\'',
                'code' => 'CK',
                'adm1code' => 'UP01',
            ),
            318 => 
            array (
                'id' => 4432,
                'country_id' => 251,
                'name' => 'Chernihivs\'ka Oblast\'',
                'code' => 'CH',
                'adm1code' => 'UP02',
            ),
            319 => 
            array (
                'id' => 4433,
                'country_id' => 251,
                'name' => 'Chernivets\'ka Oblast\'',
                'code' => 'CV',
                'adm1code' => 'UP03',
            ),
            320 => 
            array (
                'id' => 4434,
                'country_id' => 251,
                'name' => 'Dnipropetrovs\'ka Oblast\'',
                'code' => 'DP',
                'adm1code' => 'UP04',
            ),
            321 => 
            array (
                'id' => 4435,
                'country_id' => 251,
                'name' => 'Donets\'ka Oblast\'',
                'code' => 'DT',
                'adm1code' => 'UP05',
            ),
            322 => 
            array (
                'id' => 4436,
                'country_id' => 251,
                'name' => 'Ivano-Frankivs\'ka Oblast\'',
                'code' => 'IF',
                'adm1code' => 'UP06',
            ),
            323 => 
            array (
                'id' => 4437,
                'country_id' => 251,
                'name' => 'Kharkivs\'ka Oblast\'',
                'code' => 'KK',
                'adm1code' => 'UP07',
            ),
            324 => 
            array (
                'id' => 4438,
                'country_id' => 251,
                'name' => 'Khersons\'ka Oblast\'',
                'code' => 'KS',
                'adm1code' => 'UP08',
            ),
            325 => 
            array (
                'id' => 4439,
                'country_id' => 251,
                'name' => 'Khmel\'nyts\'ka Oblast\'',
                'code' => 'KM',
                'adm1code' => 'UP09',
            ),
            326 => 
            array (
                'id' => 4440,
                'country_id' => 251,
                'name' => 'Kirovohrads\'ka Oblast\'',
                'code' => 'KH',
                'adm1code' => 'UP10',
            ),
            327 => 
            array (
                'id' => 4441,
                'country_id' => 251,
                'name' => 'Avtonomna Respublika Krym',
                'code' => 'KR',
                'adm1code' => 'UP11',
            ),
            328 => 
            array (
                'id' => 4442,
                'country_id' => 251,
                'name' => 'Misto Kyyiv',
                'code' => 'KC',
                'adm1code' => 'UP12',
            ),
            329 => 
            array (
                'id' => 4443,
                'country_id' => 251,
                'name' => 'Kyyivs\'ka Oblast\'',
                'code' => 'KV',
                'adm1code' => 'UP13',
            ),
            330 => 
            array (
                'id' => 4444,
                'country_id' => 251,
                'name' => 'Luhans\'ka Oblast\'',
                'code' => 'LH',
                'adm1code' => 'UP14',
            ),
            331 => 
            array (
                'id' => 4445,
                'country_id' => 251,
                'name' => 'L\'vivs\'ka Oblast\'',
                'code' => 'LV',
                'adm1code' => 'UP15',
            ),
            332 => 
            array (
                'id' => 4446,
                'country_id' => 251,
                'name' => 'Mykolayivs\'ka Oblast\'',
                'code' => 'MY',
                'adm1code' => 'UP16',
            ),
            333 => 
            array (
                'id' => 4447,
                'country_id' => 251,
                'name' => 'Odes\'ka Oblast',
                'code' => 'OD',
                'adm1code' => 'UP17',
            ),
            334 => 
            array (
                'id' => 4448,
                'country_id' => 251,
                'name' => 'Poltavs\'ka Oblast\'',
                'code' => 'PL',
                'adm1code' => 'UP18',
            ),
            335 => 
            array (
                'id' => 4449,
                'country_id' => 251,
                'name' => 'Rivnens\'ka Oblast\'',
                'code' => 'RV',
                'adm1code' => 'UP19',
            ),
            336 => 
            array (
                'id' => 4450,
                'country_id' => 251,
                'name' => 'Misto Sevastopol',
                'code' => 'SC',
                'adm1code' => 'UP20',
            ),
            337 => 
            array (
                'id' => 4451,
                'country_id' => 251,
                'name' => 'Sums\'ka Oblast\'',
                'code' => 'SM',
                'adm1code' => 'UP21',
            ),
            338 => 
            array (
                'id' => 4452,
                'country_id' => 251,
                'name' => 'Ternopil\'s\'ka Oblast\'',
                'code' => 'TP',
                'adm1code' => 'UP22',
            ),
            339 => 
            array (
                'id' => 4453,
                'country_id' => 251,
                'name' => 'Vinnyts\'ka Oblast\'',
                'code' => 'VI',
                'adm1code' => 'UP23',
            ),
            340 => 
            array (
                'id' => 4454,
                'country_id' => 251,
                'name' => 'Volyns\'ka Oblast\'',
                'code' => 'VO',
                'adm1code' => 'UP24',
            ),
            341 => 
            array (
                'id' => 4455,
                'country_id' => 251,
                'name' => 'Zakarpats\'ka Oblast\'',
                'code' => 'ZK',
                'adm1code' => 'UP25',
            ),
            342 => 
            array (
                'id' => 4456,
                'country_id' => 251,
                'name' => 'Zaporiz\'ka Oblast\'',
                'code' => 'ZP',
                'adm1code' => 'UP26',
            ),
            343 => 
            array (
                'id' => 4457,
                'country_id' => 251,
                'name' => 'Zhytomyrs\'ka Oblast\'',
                'code' => 'ZT',
                'adm1code' => 'UP27',
            ),
            344 => 
            array (
                'id' => 4458,
                'country_id' => 38,
                'name' => 'Bam',
                'code' => 'BM',
                'adm1code' => 'UV15',
            ),
            345 => 
            array (
                'id' => 4459,
                'country_id' => 38,
                'name' => 'Bazega',
                'code' => 'BZ',
                'adm1code' => 'UV16',
            ),
            346 => 
            array (
                'id' => 4460,
                'country_id' => 38,
                'name' => 'Bougouriba',
                'code' => 'BB',
                'adm1code' => 'UV17',
            ),
            347 => 
            array (
                'id' => 4461,
                'country_id' => 38,
                'name' => 'Boulgou',
                'code' => 'BL',
                'adm1code' => 'UV18',
            ),
            348 => 
            array (
                'id' => 4462,
                'country_id' => 38,
                'name' => 'Boulkiemde',
                'code' => 'BK',
                'adm1code' => 'UV19',
            ),
            349 => 
            array (
                'id' => 4463,
                'country_id' => 38,
                'name' => 'Ganzourgou',
                'code' => 'GZ',
                'adm1code' => 'UV20',
            ),
            350 => 
            array (
                'id' => 4464,
                'country_id' => 38,
                'name' => 'Gnagna',
                'code' => 'GG',
                'adm1code' => 'UV21',
            ),
            351 => 
            array (
                'id' => 4465,
                'country_id' => 38,
                'name' => 'Gourma',
                'code' => 'GM',
                'adm1code' => 'UV22',
            ),
            352 => 
            array (
                'id' => 4466,
                'country_id' => 38,
                'name' => 'Houe',
                'code' => 'HO',
                'adm1code' => 'UV23',
            ),
            353 => 
            array (
                'id' => 4467,
                'country_id' => 38,
                'name' => 'Kadiogo',
                'code' => 'KA',
                'adm1code' => 'UV24',
            ),
            354 => 
            array (
                'id' => 4468,
                'country_id' => 38,
                'name' => 'Kenedougou',
                'code' => 'KN',
                'adm1code' => 'UV25',
            ),
            355 => 
            array (
                'id' => 4469,
                'country_id' => 38,
                'name' => 'Komoe',
                'code' => 'KM',
                'adm1code' => 'UV26',
            ),
            356 => 
            array (
                'id' => 4470,
                'country_id' => 38,
                'name' => 'Kossi',
                'code' => 'KS',
                'adm1code' => 'UV27',
            ),
            357 => 
            array (
                'id' => 4471,
                'country_id' => 38,
                'name' => 'Kouritenga',
                'code' => 'KR',
                'adm1code' => 'UV28',
            ),
            358 => 
            array (
                'id' => 4472,
                'country_id' => 38,
                'name' => 'Mouhoun',
                'code' => 'MO',
                'adm1code' => 'UV29',
            ),
            359 => 
            array (
                'id' => 4473,
                'country_id' => 38,
                'name' => 'Namentenga',
                'code' => 'NM',
                'adm1code' => 'UV30',
            ),
            360 => 
            array (
                'id' => 4474,
                'country_id' => 38,
                'name' => 'Naouri',
                'code' => 'NR',
                'adm1code' => 'UV31',
            ),
            361 => 
            array (
                'id' => 4475,
                'country_id' => 38,
                'name' => 'Oubritenga',
                'code' => 'OB',
                'adm1code' => 'UV32',
            ),
            362 => 
            array (
                'id' => 4476,
                'country_id' => 38,
                'name' => 'Oudalan',
                'code' => 'OD',
                'adm1code' => 'UV33',
            ),
            363 => 
            array (
                'id' => 4477,
                'country_id' => 38,
                'name' => 'Passore',
                'code' => 'PA',
                'adm1code' => 'UV34',
            ),
            364 => 
            array (
                'id' => 4478,
                'country_id' => 38,
                'name' => 'Poni',
                'code' => 'PO',
                'adm1code' => 'UV35',
            ),
            365 => 
            array (
                'id' => 4479,
                'country_id' => 38,
                'name' => 'Sanguie',
                'code' => 'SG',
                'adm1code' => 'UV36',
            ),
            366 => 
            array (
                'id' => 4480,
                'country_id' => 38,
                'name' => 'Sanmatenga',
                'code' => 'ST',
                'adm1code' => 'UV37',
            ),
            367 => 
            array (
                'id' => 4481,
                'country_id' => 38,
                'name' => 'Seno',
                'code' => 'SE',
                'adm1code' => 'UV38',
            ),
            368 => 
            array (
                'id' => 4482,
                'country_id' => 38,
                'name' => 'Sissili',
                'code' => 'SS',
                'adm1code' => 'UV39',
            ),
            369 => 
            array (
                'id' => 4483,
                'country_id' => 38,
                'name' => 'Soum',
                'code' => 'SM',
                'adm1code' => 'UV40',
            ),
            370 => 
            array (
                'id' => 4484,
                'country_id' => 38,
                'name' => 'Sourou',
                'code' => 'SR',
                'adm1code' => 'UV41',
            ),
            371 => 
            array (
                'id' => 4485,
                'country_id' => 38,
                'name' => 'Tapoa',
                'code' => 'TA',
                'adm1code' => 'UV42',
            ),
            372 => 
            array (
                'id' => 4486,
                'country_id' => 38,
                'name' => 'Yatenga',
                'code' => 'YT',
                'adm1code' => 'UV43',
            ),
            373 => 
            array (
                'id' => 4487,
                'country_id' => 38,
                'name' => 'Zoundweogo',
                'code' => 'ZW',
                'adm1code' => 'UV44',
            ),
            374 => 
            array (
                'id' => 4488,
                'country_id' => 256,
                'name' => 'Artigas',
                'code' => 'AR',
                'adm1code' => 'UY01',
            ),
            375 => 
            array (
                'id' => 4489,
                'country_id' => 256,
                'name' => 'Canelones',
                'code' => 'CA',
                'adm1code' => 'UY02',
            ),
            376 => 
            array (
                'id' => 4490,
                'country_id' => 256,
                'name' => 'Cerro Largo',
                'code' => 'CL',
                'adm1code' => 'UY03',
            ),
            377 => 
            array (
                'id' => 4491,
                'country_id' => 256,
                'name' => 'Colonia',
                'code' => 'CO',
                'adm1code' => 'UY04',
            ),
            378 => 
            array (
                'id' => 4492,
                'country_id' => 256,
                'name' => 'Durazno',
                'code' => 'DU',
                'adm1code' => 'UY05',
            ),
            379 => 
            array (
                'id' => 4493,
                'country_id' => 256,
                'name' => 'Flores',
                'code' => 'FS',
                'adm1code' => 'UY06',
            ),
            380 => 
            array (
                'id' => 4494,
                'country_id' => 256,
                'name' => 'Florida',
                'code' => 'FD',
                'adm1code' => 'UY07',
            ),
            381 => 
            array (
                'id' => 4495,
                'country_id' => 256,
                'name' => 'Lavalleja',
                'code' => 'LA',
                'adm1code' => 'UY08',
            ),
            382 => 
            array (
                'id' => 4496,
                'country_id' => 256,
                'name' => 'Maldonado',
                'code' => 'MA',
                'adm1code' => 'UY09',
            ),
            383 => 
            array (
                'id' => 4497,
                'country_id' => 256,
                'name' => 'Montevideo',
                'code' => 'MO',
                'adm1code' => 'UY10',
            ),
            384 => 
            array (
                'id' => 4498,
                'country_id' => 256,
                'name' => 'Paysandu',
                'code' => 'PA',
                'adm1code' => 'UY11',
            ),
            385 => 
            array (
                'id' => 4499,
                'country_id' => 256,
                'name' => 'Rio Negro',
                'code' => 'RN',
                'adm1code' => 'UY12',
            ),
            386 => 
            array (
                'id' => 4500,
                'country_id' => 256,
                'name' => 'Rivera',
                'code' => 'RV',
                'adm1code' => 'UY13',
            ),
            387 => 
            array (
                'id' => 4501,
                'country_id' => 256,
                'name' => 'Rocha',
                'code' => 'RO',
                'adm1code' => 'UY14',
            ),
            388 => 
            array (
                'id' => 4502,
                'country_id' => 256,
                'name' => 'Salto',
                'code' => 'SA',
                'adm1code' => 'UY15',
            ),
            389 => 
            array (
                'id' => 4503,
                'country_id' => 256,
                'name' => 'San Jose',
                'code' => 'SJ',
                'adm1code' => 'UY16',
            ),
            390 => 
            array (
                'id' => 4504,
                'country_id' => 256,
                'name' => 'Soriano',
                'code' => 'SO',
                'adm1code' => 'UY17',
            ),
            391 => 
            array (
                'id' => 4505,
                'country_id' => 256,
                'name' => 'Tacuarembo',
                'code' => 'TA',
                'adm1code' => 'UY18',
            ),
            392 => 
            array (
                'id' => 4506,
                'country_id' => 256,
                'name' => 'Treinta y Tres',
                'code' => 'TT',
                'adm1code' => 'UY19',
            ),
            393 => 
            array (
                'id' => 4507,
                'country_id' => 257,
                'name' => 'Andijon',
                'code' => 'AN',
                'adm1code' => 'UZ01',
            ),
            394 => 
            array (
                'id' => 4508,
                'country_id' => 257,
                'name' => 'Bukhoro',
                'code' => 'BU',
                'adm1code' => 'UZ02',
            ),
            395 => 
            array (
                'id' => 4509,
                'country_id' => 257,
                'name' => 'Farghona',
                'code' => 'FA',
                'adm1code' => 'UZ03',
            ),
            396 => 
            array (
                'id' => 4510,
                'country_id' => 257,
                'name' => 'Jizzakh',
                'code' => 'JI',
                'adm1code' => 'UZ15',
            ),
            397 => 
            array (
                'id' => 4511,
                'country_id' => 257,
                'name' => 'Khorazm',
                'code' => 'KH',
                'adm1code' => 'UZ05',
            ),
            398 => 
            array (
                'id' => 4512,
                'country_id' => 257,
                'name' => 'Namangan',
                'code' => 'NG',
                'adm1code' => 'UZ06',
            ),
            399 => 
            array (
                'id' => 4513,
                'country_id' => 257,
                'name' => 'Nawoiy',
                'code' => 'NW',
                'adm1code' => 'UZ07',
            ),
            400 => 
            array (
                'id' => 4514,
                'country_id' => 257,
                'name' => 'Qashqadaryo',
                'code' => 'QA',
                'adm1code' => 'UZ08',
            ),
            401 => 
            array (
                'id' => 4515,
                'country_id' => 257,
                'name' => 'Qoraqalpoghiston',
                'code' => 'QR',
                'adm1code' => 'UZ09',
            ),
            402 => 
            array (
                'id' => 4516,
                'country_id' => 257,
                'name' => 'Samarqand',
                'code' => 'SA',
                'adm1code' => 'UZ10',
            ),
            403 => 
            array (
                'id' => 4517,
                'country_id' => 257,
                'name' => 'Sirdaryo',
                'code' => 'SI',
                'adm1code' => 'UZ15',
            ),
            404 => 
            array (
                'id' => 4518,
                'country_id' => 257,
                'name' => 'Surkhondaryo',
                'code' => 'SU',
                'adm1code' => 'UZ12',
            ),
            405 => 
            array (
                'id' => 4519,
                'country_id' => 257,
                'name' => 'Toshkent',
                'code' => 'TO',
                'adm1code' => 'UZ14',
            ),
            406 => 
            array (
                'id' => 4520,
                'country_id' => 209,
                'name' => 'Charlotte',
                'code' => 'CH',
                'adm1code' => 'VC01',
            ),
            407 => 
            array (
                'id' => 4521,
                'country_id' => 209,
                'name' => 'Saint Andrew',
                'code' => 'AN',
                'adm1code' => 'VC02',
            ),
            408 => 
            array (
                'id' => 4522,
                'country_id' => 209,
                'name' => 'Saint David',
                'code' => 'DA',
                'adm1code' => 'VC03',
            ),
            409 => 
            array (
                'id' => 4523,
                'country_id' => 209,
                'name' => 'Saint George',
                'code' => 'GE',
                'adm1code' => 'VC04',
            ),
            410 => 
            array (
                'id' => 4524,
                'country_id' => 209,
                'name' => 'Saint Patrick',
                'code' => 'PA',
                'adm1code' => 'VC05',
            ),
            411 => 
            array (
                'id' => 4525,
                'country_id' => 209,
                'name' => 'Grenadines',
                'code' => 'GT',
                'adm1code' => 'VC06',
            ),
            412 => 
            array (
                'id' => 4526,
                'country_id' => 259,
                'name' => 'Amazonas',
                'code' => 'AM',
                'adm1code' => 'VE01',
            ),
            413 => 
            array (
                'id' => 4527,
                'country_id' => 259,
                'name' => 'Anzoategui',
                'code' => 'AN',
                'adm1code' => 'VE02',
            ),
            414 => 
            array (
                'id' => 4528,
                'country_id' => 259,
                'name' => 'Apure',
                'code' => 'AP',
                'adm1code' => 'VE03',
            ),
            415 => 
            array (
                'id' => 4529,
                'country_id' => 259,
                'name' => 'Aragua',
                'code' => 'AR',
                'adm1code' => 'VE04',
            ),
            416 => 
            array (
                'id' => 4530,
                'country_id' => 259,
                'name' => 'Barinas',
                'code' => 'BA',
                'adm1code' => 'VE05',
            ),
            417 => 
            array (
                'id' => 4531,
                'country_id' => 259,
                'name' => 'Bolivar',
                'code' => 'BO',
                'adm1code' => 'VE06',
            ),
            418 => 
            array (
                'id' => 4532,
                'country_id' => 259,
                'name' => 'Carabobo',
                'code' => 'CA',
                'adm1code' => 'VE07',
            ),
            419 => 
            array (
                'id' => 4533,
                'country_id' => 259,
                'name' => 'Cojedes',
                'code' => 'CO',
                'adm1code' => 'VE08',
            ),
            420 => 
            array (
                'id' => 4534,
                'country_id' => 259,
                'name' => 'Delta Amacuro',
                'code' => 'DA',
                'adm1code' => 'VE09',
            ),
            421 => 
            array (
                'id' => 4535,
                'country_id' => 259,
                'name' => 'Distrito Federal',
                'code' => 'DF',
                'adm1code' => 'VE25',
            ),
            422 => 
            array (
                'id' => 4536,
                'country_id' => 259,
                'name' => 'Falcon',
                'code' => 'FA',
                'adm1code' => 'VE11',
            ),
            423 => 
            array (
                'id' => 4537,
                'country_id' => 259,
                'name' => 'Guarico',
                'code' => 'GU',
                'adm1code' => 'VE12',
            ),
            424 => 
            array (
                'id' => 4538,
                'country_id' => 259,
                'name' => 'Lara',
                'code' => 'LA',
                'adm1code' => 'VE13',
            ),
            425 => 
            array (
                'id' => 4539,
                'country_id' => 259,
                'name' => 'Merida',
                'code' => 'ME',
                'adm1code' => 'VE14',
            ),
            426 => 
            array (
                'id' => 4540,
                'country_id' => 259,
                'name' => 'Miranda',
                'code' => 'MI',
                'adm1code' => 'VE15',
            ),
            427 => 
            array (
                'id' => 4541,
                'country_id' => 259,
                'name' => 'Monagas',
                'code' => 'MO',
                'adm1code' => 'VE16',
            ),
            428 => 
            array (
                'id' => 4542,
                'country_id' => 259,
                'name' => 'Nueva Esparta',
                'code' => 'NE',
                'adm1code' => 'VE17',
            ),
            429 => 
            array (
                'id' => 4543,
                'country_id' => 259,
                'name' => 'Portuguesa',
                'code' => 'PO',
                'adm1code' => 'VE18',
            ),
            430 => 
            array (
                'id' => 4544,
                'country_id' => 259,
                'name' => 'Sucre',
                'code' => 'SU',
                'adm1code' => 'VE19',
            ),
            431 => 
            array (
                'id' => 4545,
                'country_id' => 259,
                'name' => 'Tachira',
                'code' => 'TA',
                'adm1code' => 'VE20',
            ),
            432 => 
            array (
                'id' => 4546,
                'country_id' => 259,
                'name' => 'Trujillo',
                'code' => 'TR',
                'adm1code' => 'VE21',
            ),
            433 => 
            array (
                'id' => 4547,
                'country_id' => 259,
                'name' => 'Yaracuy',
                'code' => 'YA',
                'adm1code' => 'VE22',
            ),
            434 => 
            array (
                'id' => 4548,
                'country_id' => 259,
                'name' => 'Zulia',
                'code' => 'ZU',
                'adm1code' => 'VE23',
            ),
            435 => 
            array (
                'id' => 4549,
                'country_id' => 259,
                'name' => 'Dependencias Federales',
                'code' => 'DP',
                'adm1code' => 'VE24',
            ),
            436 => 
            array (
                'id' => 4551,
                'country_id' => 260,
                'name' => 'An Giang',
                'code' => 'AG',
                'adm1code' => 'VM01',
            ),
            437 => 
            array (
                'id' => 4553,
                'country_id' => 260,
                'name' => 'Ben Tre',
                'code' => 'BR',
                'adm1code' => 'VM03',
            ),
            438 => 
            array (
                'id' => 4555,
                'country_id' => 260,
                'name' => 'Cao Bang',
                'code' => 'CB',
                'adm1code' => 'VM05',
            ),
            439 => 
            array (
                'id' => 4557,
                'country_id' => 260,
                'name' => 'Dak Lak',
                'code' => 'DL',
                'adm1code' => 'VM07',
            ),
            440 => 
            array (
                'id' => 4558,
                'country_id' => 260,
                'name' => 'Dong Thap',
                'code' => 'DT',
                'adm1code' => 'VM09',
            ),
            441 => 
            array (
                'id' => 4562,
                'country_id' => 260,
                'name' => 'Hai Phong',
                'code' => 'HP',
                'adm1code' => 'VM13',
            ),
            442 => 
            array (
                'id' => 4564,
                'country_id' => 260,
                'name' => 'Ha Noi',
                'code' => 'HN',
                'adm1code' => 'VM44',
            ),
            443 => 
            array (
                'id' => 4568,
                'country_id' => 260,
                'name' => 'Ho Chi Minh',
                'code' => 'HC',
                'adm1code' => 'VM20',
            ),
            444 => 
            array (
                'id' => 4569,
                'country_id' => 260,
                'name' => 'Kien Giang',
                'code' => 'KG',
                'adm1code' => 'VM21',
            ),
            445 => 
            array (
                'id' => 4570,
                'country_id' => 260,
                'name' => 'Lai Chau',
                'code' => 'LC',
                'adm1code' => 'VM22',
            ),
            446 => 
            array (
                'id' => 4571,
                'country_id' => 260,
                'name' => 'Lam Dong',
                'code' => 'LD',
                'adm1code' => 'VM23',
            ),
            447 => 
            array (
                'id' => 4572,
                'country_id' => 260,
                'name' => 'Long An',
                'code' => 'LA',
                'adm1code' => 'VM24',
            ),
            448 => 
            array (
                'id' => 4578,
                'country_id' => 260,
                'name' => 'Quang Ninh',
                'code' => 'QN',
                'adm1code' => 'VM30',
            ),
            449 => 
            array (
                'id' => 4580,
                'country_id' => 260,
                'name' => 'Son La',
                'code' => 'SL',
                'adm1code' => 'VM32',
            ),
            450 => 
            array (
                'id' => 4581,
                'country_id' => 260,
                'name' => 'Tay Ninh',
                'code' => 'TN',
                'adm1code' => 'VM33',
            ),
            451 => 
            array (
                'id' => 4582,
                'country_id' => 260,
                'name' => 'Thanh Hoa',
                'code' => 'TH',
                'adm1code' => 'VM34',
            ),
            452 => 
            array (
                'id' => 4583,
                'country_id' => 260,
                'name' => 'Thai Binh',
                'code' => 'TB',
                'adm1code' => 'VM35',
            ),
            453 => 
            array (
                'id' => 4585,
                'country_id' => 260,
                'name' => 'Tien Giang',
                'code' => 'TG',
                'adm1code' => 'VM37',
            ),
            454 => 
            array (
                'id' => 4587,
                'country_id' => 260,
                'name' => 'Lang Son',
                'code' => 'LS',
                'adm1code' => 'VM39',
            ),
            455 => 
            array (
                'id' => 4590,
                'country_id' => 260,
                'name' => 'Dong Nai',
                'code' => 'DN',
                'adm1code' => 'VM43',
            ),
            456 => 
            array (
                'id' => 4591,
                'country_id' => 260,
                'name' => 'Ba Ria-Vung Tau',
                'code' => 'BV',
                'adm1code' => 'VM45',
            ),
            457 => 
            array (
                'id' => 4592,
                'country_id' => 260,
                'name' => 'Binh Dinh',
                'code' => 'BD',
                'adm1code' => 'VM46',
            ),
            458 => 
            array (
                'id' => 4593,
                'country_id' => 260,
                'name' => 'Binh Thuan',
                'code' => 'BU',
                'adm1code' => 'VM47',
            ),
            459 => 
            array (
                'id' => 4594,
                'country_id' => 260,
                'name' => 'Can Tho',
                'code' => 'CT',
                'adm1code' => 'VM48',
            ),
            460 => 
            array (
                'id' => 4595,
                'country_id' => 260,
                'name' => 'Gia Lai',
                'code' => 'GL',
                'adm1code' => 'VM49',
            ),
            461 => 
            array (
                'id' => 4596,
                'country_id' => 260,
                'name' => 'Ha Giang',
                'code' => 'HG',
                'adm1code' => 'VM50',
            ),
            462 => 
            array (
                'id' => 4597,
                'country_id' => 260,
                'name' => 'Ha Tay',
                'code' => 'HA',
                'adm1code' => 'VM51',
            ),
            463 => 
            array (
                'id' => 4598,
                'country_id' => 260,
                'name' => 'Ha Tinh',
                'code' => 'HT',
                'adm1code' => 'VM52',
            ),
            464 => 
            array (
                'id' => 4599,
                'country_id' => 260,
                'name' => 'Hoa Binh',
                'code' => 'HO',
                'adm1code' => 'VM53',
            ),
            465 => 
            array (
                'id' => 4600,
                'country_id' => 260,
                'name' => 'Khanh Hoa',
                'code' => 'KH',
                'adm1code' => 'VM54',
            ),
            466 => 
            array (
                'id' => 4601,
                'country_id' => 260,
                'name' => 'Kon Tum',
                'code' => 'KT',
                'adm1code' => 'VM55',
            ),
            467 => 
            array (
                'id' => 4602,
                'country_id' => 260,
                'name' => 'Lao Cai',
                'code' => 'LO',
                'adm1code' => 'VM56',
            ),
            468 => 
            array (
                'id' => 4604,
                'country_id' => 260,
                'name' => 'Nghe An',
                'code' => 'NA',
                'adm1code' => 'VM58',
            ),
            469 => 
            array (
                'id' => 4605,
                'country_id' => 260,
                'name' => 'Ninh Binh',
                'code' => 'NB',
                'adm1code' => 'VM59',
            ),
            470 => 
            array (
                'id' => 4606,
                'country_id' => 260,
                'name' => 'Ninh Thuan',
                'code' => 'NT',
                'adm1code' => 'VM60',
            ),
            471 => 
            array (
                'id' => 4607,
                'country_id' => 260,
                'name' => 'Phu Yen',
                'code' => 'PY',
                'adm1code' => 'VM61',
            ),
            472 => 
            array (
                'id' => 4608,
                'country_id' => 260,
                'name' => 'Quang Binh',
                'code' => 'QB',
                'adm1code' => 'VM62',
            ),
            473 => 
            array (
                'id' => 4609,
                'country_id' => 260,
                'name' => 'Quang Ngai',
                'code' => 'QG',
                'adm1code' => 'VM63',
            ),
            474 => 
            array (
                'id' => 4610,
                'country_id' => 260,
                'name' => 'Quang Tri',
                'code' => 'QT',
                'adm1code' => 'VM64',
            ),
            475 => 
            array (
                'id' => 4611,
                'country_id' => 260,
                'name' => 'Soc Trang',
                'code' => 'ST',
                'adm1code' => 'VM65',
            ),
            476 => 
            array (
                'id' => 4612,
                'country_id' => 260,
                'name' => 'Thura Thien-Hue',
                'code' => 'TT',
                'adm1code' => 'VM66',
            ),
            477 => 
            array (
                'id' => 4613,
                'country_id' => 260,
                'name' => 'Tra Vinh',
                'code' => 'TV',
                'adm1code' => 'VM67',
            ),
            478 => 
            array (
                'id' => 4614,
                'country_id' => 260,
                'name' => 'Tuyen Quang',
                'code' => 'TQ',
                'adm1code' => 'VM68',
            ),
            479 => 
            array (
                'id' => 4615,
                'country_id' => 260,
                'name' => 'Vinh Long',
                'code' => 'VL',
                'adm1code' => 'VM69',
            ),
            480 => 
            array (
                'id' => 4616,
                'country_id' => 260,
                'name' => 'Yen Bai',
                'code' => 'YB',
                'adm1code' => 'VM70',
            ),
            481 => 
            array (
                'id' => 4617,
                'country_id' => 260,
                'name' => 'Bac Giang',
                'code' => 'BG',
                'adm1code' => 'VM71',
            ),
            482 => 
            array (
                'id' => 4618,
                'country_id' => 260,
                'name' => 'Bac Kan',
                'code' => 'BK',
                'adm1code' => 'VM72',
            ),
            483 => 
            array (
                'id' => 4619,
                'country_id' => 260,
                'name' => 'Bac Lieu',
                'code' => 'BL',
                'adm1code' => 'VM73',
            ),
            484 => 
            array (
                'id' => 4620,
                'country_id' => 260,
                'name' => 'Bac Ninh',
                'code' => 'BN',
                'adm1code' => 'VM74',
            ),
            485 => 
            array (
                'id' => 4621,
                'country_id' => 260,
                'name' => 'Bin Duong',
                'code' => 'BI',
                'adm1code' => 'VM75',
            ),
            486 => 
            array (
                'id' => 4622,
                'country_id' => 260,
                'name' => 'Bin Phuoc',
                'code' => 'BP',
                'adm1code' => 'VM76',
            ),
            487 => 
            array (
                'id' => 4623,
                'country_id' => 260,
                'name' => 'Ca Mau',
                'code' => 'CM',
                'adm1code' => 'VM77',
            ),
            488 => 
            array (
                'id' => 4624,
                'country_id' => 260,
                'name' => 'Da Nang',
                'code' => 'DA',
                'adm1code' => 'VM78',
            ),
            489 => 
            array (
                'id' => 4625,
                'country_id' => 260,
                'name' => 'Hai Duong',
                'code' => 'HD',
                'adm1code' => 'VM79',
            ),
            490 => 
            array (
                'id' => 4626,
                'country_id' => 260,
                'name' => 'Ha Nam',
                'code' => 'HM',
                'adm1code' => 'VM80',
            ),
            491 => 
            array (
                'id' => 4627,
                'country_id' => 260,
                'name' => 'Hung Yen',
                'code' => 'HY',
                'adm1code' => 'VM81',
            ),
            492 => 
            array (
                'id' => 4628,
                'country_id' => 260,
                'name' => 'Nam Dinh',
                'code' => 'ND',
                'adm1code' => 'VM82',
            ),
            493 => 
            array (
                'id' => 4629,
                'country_id' => 260,
                'name' => 'Phu Tho',
                'code' => 'PT',
                'adm1code' => 'VM83',
            ),
            494 => 
            array (
                'id' => 4630,
                'country_id' => 260,
                'name' => 'Quang Nam',
                'code' => 'QM',
                'adm1code' => 'VM84',
            ),
            495 => 
            array (
                'id' => 4631,
                'country_id' => 260,
                'name' => 'Thai Nguyen',
                'code' => 'TY',
                'adm1code' => 'VM85',
            ),
            496 => 
            array (
                'id' => 4632,
                'country_id' => 260,
                'name' => 'Vinh Phuc',
                'code' => 'VC',
                'adm1code' => 'VM86',
            ),
            497 => 
            array (
                'id' => 4635,
                'country_id' => 171,
                'name' => 'Khomas',
                'code' => 'KH',
                'adm1code' => 'WA21',
            ),
            498 => 
            array (
                'id' => 4636,
                'country_id' => 171,
                'name' => 'Caprivi',
                'code' => 'CA',
                'adm1code' => 'WA28',
            ),
            499 => 
            array (
                'id' => 4637,
                'country_id' => 171,
                'name' => 'Erongo',
                'code' => 'ER',
                'adm1code' => 'WA29',
            ),
        ));
        \DB::table('state')->insert(array (
            0 => 
            array (
                'id' => 4638,
                'country_id' => 171,
                'name' => 'Hardap',
                'code' => 'HA',
                'adm1code' => 'WA30',
            ),
            1 => 
            array (
                'id' => 4639,
                'country_id' => 171,
                'name' => 'Karas',
                'code' => 'KA',
                'adm1code' => 'WA31',
            ),
            2 => 
            array (
                'id' => 4640,
                'country_id' => 171,
                'name' => 'Kunene',
                'code' => 'KU',
                'adm1code' => 'WA32',
            ),
            3 => 
            array (
                'id' => 4641,
                'country_id' => 171,
                'name' => 'Ohangwena',
                'code' => 'OW',
                'adm1code' => 'WA33',
            ),
            4 => 
            array (
                'id' => 4642,
                'country_id' => 171,
                'name' => 'Okavango',
                'code' => 'OK',
                'adm1code' => 'WA34',
            ),
            5 => 
            array (
                'id' => 4643,
                'country_id' => 171,
                'name' => 'Omaheke',
                'code' => 'OH',
                'adm1code' => 'WA35',
            ),
            6 => 
            array (
                'id' => 4644,
                'country_id' => 171,
                'name' => 'Omusati',
                'code' => 'OS',
                'adm1code' => 'WA36',
            ),
            7 => 
            array (
                'id' => 4645,
                'country_id' => 171,
                'name' => 'Oshana',
                'code' => 'ON',
                'adm1code' => 'WA37',
            ),
            8 => 
            array (
                'id' => 4646,
                'country_id' => 171,
                'name' => 'Oshikoto',
                'code' => 'OT',
                'adm1code' => 'WA38',
            ),
            9 => 
            array (
                'id' => 4647,
                'country_id' => 171,
                'name' => 'Otjozondjupa',
                'code' => 'OD',
                'adm1code' => 'WA39',
            ),
            10 => 
            array (
                'id' => 4648,
                'country_id' => 210,
                'name' => 'A\'ana',
                'code' => 'AA',
                'adm1code' => 'WS01',
            ),
            11 => 
            array (
                'id' => 4649,
                'country_id' => 210,
                'name' => 'Aiga-i-le-Tai',
                'code' => 'AL',
                'adm1code' => 'WS02',
            ),
            12 => 
            array (
                'id' => 4650,
                'country_id' => 210,
                'name' => 'Atua',
                'code' => 'AT',
                'adm1code' => 'WS03',
            ),
            13 => 
            array (
                'id' => 4651,
                'country_id' => 210,
                'name' => 'Fa\'asaleleaga',
                'code' => 'FA',
                'adm1code' => 'WS04',
            ),
            14 => 
            array (
                'id' => 4652,
                'country_id' => 210,
                'name' => 'Gaga\'emauga',
                'code' => 'GE',
                'adm1code' => 'WS05',
            ),
            15 => 
            array (
                'id' => 4653,
                'country_id' => 210,
                'name' => 'Va\'a-o-Fonoti',
                'code' => 'VF',
                'adm1code' => 'WS06',
            ),
            16 => 
            array (
                'id' => 4654,
                'country_id' => 210,
                'name' => 'Gagaifomauga',
                'code' => 'GI',
                'adm1code' => 'WS07',
            ),
            17 => 
            array (
                'id' => 4655,
                'country_id' => 210,
                'name' => 'Palauli',
                'code' => 'PA',
                'adm1code' => 'WS08',
            ),
            18 => 
            array (
                'id' => 4656,
                'country_id' => 210,
                'name' => 'Satupa\'itea',
                'code' => 'SA',
                'adm1code' => 'WS09',
            ),
            19 => 
            array (
                'id' => 4657,
                'country_id' => 210,
                'name' => 'Tuamasaga',
                'code' => 'TU',
                'adm1code' => 'WS10',
            ),
            20 => 
            array (
                'id' => 4658,
                'country_id' => 210,
                'name' => 'Vaisigano',
                'code' => 'VS',
                'adm1code' => 'WS11',
            ),
            21 => 
            array (
                'id' => 4659,
                'country_id' => 232,
                'name' => 'Hhohho',
                'code' => 'HH',
                'adm1code' => 'WZ01',
            ),
            22 => 
            array (
                'id' => 4660,
                'country_id' => 232,
                'name' => 'Lubombo',
                'code' => 'LU',
                'adm1code' => 'WZ02',
            ),
            23 => 
            array (
                'id' => 4661,
                'country_id' => 232,
                'name' => 'Manzini',
                'code' => 'MA',
                'adm1code' => 'WZ03',
            ),
            24 => 
            array (
                'id' => 4662,
                'country_id' => 232,
                'name' => 'Shiselweni',
                'code' => 'SH',
                'adm1code' => 'WZ04',
            ),
            25 => 
            array (
                'id' => 4663,
                'country_id' => 270,
                'name' => 'Abyan',
                'code' => 'AB',
                'adm1code' => 'YM01',
            ),
            26 => 
            array (
                'id' => 4664,
                'country_id' => 270,
                'name' => '\'Adan',
                'code' => 'AD',
                'adm1code' => 'YM02',
            ),
            27 => 
            array (
                'id' => 4665,
                'country_id' => 270,
                'name' => 'Al Mahrah',
                'code' => 'MR',
                'adm1code' => 'YM03',
            ),
            28 => 
            array (
                'id' => 4666,
                'country_id' => 270,
                'name' => 'Hadramawt',
                'code' => 'HD',
                'adm1code' => 'YM04',
            ),
            29 => 
            array (
                'id' => 4667,
                'country_id' => 270,
                'name' => 'Shabwah',
                'code' => 'SH',
                'adm1code' => 'YM05',
            ),
            30 => 
            array (
                'id' => 4668,
                'country_id' => 270,
                'name' => 'Lahij',
                'code' => 'LA',
                'adm1code' => 'YM06',
            ),
            31 => 
            array (
                'id' => 4669,
                'country_id' => 270,
                'name' => 'Al Bayda\'',
                'code' => 'BA',
                'adm1code' => 'YM07',
            ),
            32 => 
            array (
                'id' => 4670,
                'country_id' => 270,
                'name' => 'Al Hudaydah',
                'code' => 'HU',
                'adm1code' => 'YM08',
            ),
            33 => 
            array (
                'id' => 4671,
                'country_id' => 270,
                'name' => 'Al Jawf',
                'code' => 'JA',
                'adm1code' => 'YM09',
            ),
            34 => 
            array (
                'id' => 4672,
                'country_id' => 270,
                'name' => 'Al Mahwit',
                'code' => 'MW',
                'adm1code' => 'YM10',
            ),
            35 => 
            array (
                'id' => 4673,
                'country_id' => 270,
                'name' => 'Dhamar',
                'code' => 'DH',
                'adm1code' => 'YM11',
            ),
            36 => 
            array (
                'id' => 4674,
                'country_id' => 270,
                'name' => 'Hajjah',
                'code' => 'HJ',
                'adm1code' => 'YM12',
            ),
            37 => 
            array (
                'id' => 4675,
                'country_id' => 270,
                'name' => 'Ibb',
                'code' => 'IB',
                'adm1code' => 'YM13',
            ),
            38 => 
            array (
                'id' => 4676,
                'country_id' => 270,
                'name' => 'Ma\'rib',
                'code' => 'MA',
                'adm1code' => 'YM14',
            ),
            39 => 
            array (
                'id' => 4677,
                'country_id' => 270,
                'name' => 'Sa\'dah',
                'code' => 'SD',
                'adm1code' => 'YM15',
            ),
            40 => 
            array (
                'id' => 4678,
                'country_id' => 270,
                'name' => 'San\'a\'',
                'code' => 'SN',
                'adm1code' => 'YM16',
            ),
            41 => 
            array (
                'id' => 4679,
                'country_id' => 270,
                'name' => 'Ta\'izz',
                'code' => 'TA',
                'adm1code' => 'YM17',
            ),
            42 => 
            array (
                'id' => 4680,
                'country_id' => 273,
                'name' => 'North-Western',
                'code' => 'WE',
                'adm1code' => 'ZA01',
            ),
            43 => 
            array (
                'id' => 4681,
                'country_id' => 273,
                'name' => 'Copperbelt',
                'code' => 'CE',
                'adm1code' => 'ZA02',
            ),
            44 => 
            array (
                'id' => 4682,
                'country_id' => 273,
                'name' => 'Western',
                'code' => 'EA',
                'adm1code' => 'ZA03',
            ),
            45 => 
            array (
                'id' => 4683,
                'country_id' => 273,
                'name' => 'Southern',
                'code' => 'LP',
                'adm1code' => 'ZA04',
            ),
            46 => 
            array (
                'id' => 4684,
                'country_id' => 273,
                'name' => 'Central',
                'code' => 'NO',
                'adm1code' => 'ZA05',
            ),
            47 => 
            array (
                'id' => 4685,
                'country_id' => 273,
                'name' => 'Eastern',
                'code' => 'NW',
                'adm1code' => 'ZA06',
            ),
            48 => 
            array (
                'id' => 4686,
                'country_id' => 273,
                'name' => 'Northern',
                'code' => 'SO',
                'adm1code' => 'ZA07',
            ),
            49 => 
            array (
                'id' => 4687,
                'country_id' => 273,
                'name' => 'Luapula',
                'code' => 'CO',
                'adm1code' => 'ZA08',
            ),
            50 => 
            array (
                'id' => 4688,
                'country_id' => 273,
                'name' => 'Lusaka',
                'code' => 'LS',
                'adm1code' => 'ZA09',
            ),
            51 => 
            array (
                'id' => 4689,
                'country_id' => 274,
                'name' => 'Manicaland',
                'code' => 'MA',
                'adm1code' => 'ZI01',
            ),
            52 => 
            array (
                'id' => 4690,
                'country_id' => 274,
                'name' => 'Midlands',
                'code' => 'MI',
                'adm1code' => 'ZI02',
            ),
            53 => 
            array (
                'id' => 4691,
                'country_id' => 274,
                'name' => 'Mashonaland Central',
                'code' => 'MC',
                'adm1code' => 'ZI03',
            ),
            54 => 
            array (
                'id' => 4692,
                'country_id' => 274,
                'name' => 'Mashonaland East',
                'code' => 'ME',
                'adm1code' => 'ZI04',
            ),
            55 => 
            array (
                'id' => 4693,
                'country_id' => 274,
                'name' => 'Mashonaland West',
                'code' => 'MW',
                'adm1code' => 'ZI05',
            ),
            56 => 
            array (
                'id' => 4694,
                'country_id' => 274,
                'name' => 'Matabeleland North',
                'code' => 'MN',
                'adm1code' => 'ZI06',
            ),
            57 => 
            array (
                'id' => 4695,
                'country_id' => 274,
                'name' => 'Matabeleland South',
                'code' => 'MS',
                'adm1code' => 'ZI07',
            ),
            58 => 
            array (
                'id' => 4696,
                'country_id' => 274,
                'name' => 'Masvingo',
                'code' => 'MV',
                'adm1code' => 'ZI08',
            ),
            59 => 
            array (
                'id' => 4706,
                'country_id' => 178,
                'name' => 'Auckland',
                'code' => 'AU',
                'adm1code' => '',
            ),
            60 => 
            array (
                'id' => 4721,
                'country_id' => 178,
                'name' => 'Wellington',
                'code' => 'WG',
                'adm1code' => '',
            ),
            61 => 
            array (
                'id' => 4723,
                'country_id' => 178,
                'name' => 'Canterbury',
                'code' => 'CA',
                'adm1code' => '',
            ),
            62 => 
            array (
                'id' => 4729,
                'country_id' => 178,
                'name' => 'Bay of Plenty',
                'code' => 'BP',
                'adm1code' => '',
            ),
            63 => 
            array (
                'id' => 4741,
                'country_id' => 178,
                'name' => 'Northland',
                'code' => 'NO',
                'adm1code' => '',
            ),
            64 => 
            array (
                'id' => 4744,
                'country_id' => 178,
                'name' => 'Otago',
                'code' => 'OT',
                'adm1code' => '',
            ),
            65 => 
            array (
                'id' => 4761,
                'country_id' => 8,
                'name' => 'Enderby Land',
                'code' => 'EL',
                'adm1code' => '',
            ),
            66 => 
            array (
                'id' => 4763,
                'country_id' => 8,
                'name' => 'Ross Island',
                'code' => 'RI',
                'adm1code' => '',
            ),
            67 => 
            array (
                'id' => 4814,
                'country_id' => 178,
                'name' => 'Chatham Islands',
                'code' => 'CI',
                'adm1code' => '',
            ),
            68 => 
            array (
                'id' => 4879,
                'country_id' => 81,
                'name' => 'Etela-Suomen Laani',
                'code' => 'ES',
                'adm1code' => 'FI13',
            ),
            69 => 
            array (
                'id' => 4975,
                'country_id' => 156,
                'name' => 'Nouakchott',
                'code' => 'NO',
                'adm1code' => '',
            ),
            70 => 
            array (
                'id' => 4996,
                'country_id' => 43,
                'name' => 'Nunavut',
                'code' => 'NU',
                'adm1code' => 'CA14',
            ),
            71 => 
            array (
                'id' => 4997,
                'country_id' => 252,
            'name' => 'United Arab Emigrates (general)',
                'code' => 'UA',
                'adm1code' => 'AE00',
            ),
            72 => 
            array (
                'id' => 4998,
                'country_id' => 252,
                'name' => 'Abu Zaby',
                'code' => 'AZ',
                'adm1code' => 'AE01',
            ),
            73 => 
            array (
                'id' => 4999,
                'country_id' => 252,
                'name' => '\'Ajman',
                'code' => 'AJ',
                'adm1code' => 'AE02',
            ),
            74 => 
            array (
                'id' => 5002,
                'country_id' => 252,
                'name' => 'Dubayy',
                'code' => 'DU',
                'adm1code' => 'AE03',
            ),
            75 => 
            array (
                'id' => 5003,
                'country_id' => 252,
                'name' => 'Al Fujayrah',
                'code' => 'FU',
                'adm1code' => 'AE04',
            ),
            76 => 
            array (
                'id' => 5004,
                'country_id' => 252,
                'name' => 'Ra\'s al Khaymah',
                'code' => 'RK',
                'adm1code' => 'AE05',
            ),
            77 => 
            array (
                'id' => 5005,
                'country_id' => 252,
                'name' => 'Ash Shariqah',
                'code' => 'SH',
                'adm1code' => 'AE06',
            ),
            78 => 
            array (
                'id' => 5006,
                'country_id' => 252,
                'name' => 'Umm al Qaywayn',
                'code' => 'UQ',
                'adm1code' => 'AE07',
            ),
            79 => 
            array (
                'id' => 5007,
                'country_id' => 178,
                'name' => 'Gisborne',
                'code' => 'GI',
                'adm1code' => '',
            ),
            80 => 
            array (
                'id' => 5010,
                'country_id' => 178,
                'name' => 'Nelson',
                'code' => 'NE',
                'adm1code' => '',
            ),
            81 => 
            array (
                'id' => 5018,
                'country_id' => 178,
                'name' => 'Tasman',
                'code' => 'TS',
                'adm1code' => '',
            ),
            82 => 
            array (
                'id' => 5019,
                'country_id' => 178,
                'name' => 'Wanganui-Manawatu',
                'code' => 'MW',
                'adm1code' => '',
            ),
            83 => 
            array (
                'id' => 5020,
                'country_id' => 178,
                'name' => 'West Coast',
                'code' => 'WC',
                'adm1code' => '',
            ),
            84 => 
            array (
                'id' => 5022,
                'country_id' => 81,
                'name' => 'Ita-Suomen Laani',
                'code' => 'IS',
                'adm1code' => 'FI14',
            ),
            85 => 
            array (
                'id' => 5023,
                'country_id' => 81,
                'name' => 'Lansi-Suomen Laani',
                'code' => 'LS',
                'adm1code' => 'FI15',
            ),
            86 => 
            array (
                'id' => 5024,
                'country_id' => 271,
                'name' => 'Yugoslavia',
                'code' => 'YU',
                'adm1code' => '',
            ),
            87 => 
            array (
                'id' => 5025,
                'country_id' => 61,
                'name' => 'Bjelovarsko-Bilogorska',
                'code' => 'BB',
                'adm1code' => 'HR01',
            ),
            88 => 
            array (
                'id' => 5026,
                'country_id' => 61,
                'name' => 'Brodsko-Posavka',
                'code' => 'SP',
                'adm1code' => 'HR02',
            ),
            89 => 
            array (
                'id' => 5027,
                'country_id' => 61,
                'name' => 'Dubrovacko-Neretvanska',
                'code' => 'DN',
                'adm1code' => 'HR03',
            ),
            90 => 
            array (
                'id' => 5028,
                'country_id' => 61,
                'name' => 'Istarska',
                'code' => 'IS',
                'adm1code' => 'HR04',
            ),
            91 => 
            array (
                'id' => 5029,
                'country_id' => 61,
                'name' => 'Karlovacka',
                'code' => 'KA',
                'adm1code' => 'HR05',
            ),
            92 => 
            array (
                'id' => 5030,
                'country_id' => 61,
                'name' => 'Koprivnicko-Krizevacka',
                'code' => 'KK',
                'adm1code' => 'HR06',
            ),
            93 => 
            array (
                'id' => 5031,
                'country_id' => 61,
                'name' => 'Krapinsko-Zagorska',
                'code' => 'KZ',
                'adm1code' => 'HR07',
            ),
            94 => 
            array (
                'id' => 5032,
                'country_id' => 61,
                'name' => 'Licko-Senjska',
                'code' => 'LS',
                'adm1code' => 'HR08',
            ),
            95 => 
            array (
                'id' => 5033,
                'country_id' => 61,
                'name' => 'Medimurska',
                'code' => 'ME',
                'adm1code' => 'HR09',
            ),
            96 => 
            array (
                'id' => 5034,
                'country_id' => 61,
                'name' => 'Osjecko-Baranjska',
                'code' => 'OB',
                'adm1code' => 'HR10',
            ),
            97 => 
            array (
                'id' => 5035,
                'country_id' => 61,
                'name' => 'Pozesko-Slavonska',
                'code' => 'PS',
                'adm1code' => 'HR11',
            ),
            98 => 
            array (
                'id' => 5036,
                'country_id' => 61,
                'name' => 'Primorsko-Goranska',
                'code' => 'PG',
                'adm1code' => 'HR12',
            ),
            99 => 
            array (
                'id' => 5037,
                'country_id' => 61,
                'name' => 'Sibensko-Kninska',
                'code' => 'SB',
                'adm1code' => 'HR13',
            ),
            100 => 
            array (
                'id' => 5038,
                'country_id' => 61,
                'name' => 'Sisacko-Moslavacka',
                'code' => 'SM',
                'adm1code' => 'HR14',
            ),
            101 => 
            array (
                'id' => 5039,
                'country_id' => 61,
                'name' => 'Splitsko-Dalmatinska',
                'code' => 'SD',
                'adm1code' => 'HR15',
            ),
            102 => 
            array (
                'id' => 5040,
                'country_id' => 61,
                'name' => 'Varazdinska',
                'code' => 'VA',
                'adm1code' => 'HR16',
            ),
            103 => 
            array (
                'id' => 5041,
                'country_id' => 61,
                'name' => 'Viroviticko-Podravska',
                'code' => 'VP',
                'adm1code' => 'HR17',
            ),
            104 => 
            array (
                'id' => 5042,
                'country_id' => 61,
                'name' => 'Vukovarsko-Srijemska',
                'code' => 'VS',
                'adm1code' => 'HR18',
            ),
            105 => 
            array (
                'id' => 5043,
                'country_id' => 61,
                'name' => 'Zadarska',
                'code' => 'ZD',
                'adm1code' => 'HR19',
            ),
            106 => 
            array (
                'id' => 5044,
                'country_id' => 61,
                'name' => 'Zagrebacka',
                'code' => 'ZG',
                'adm1code' => 'HR20',
            ),
            107 => 
            array (
                'id' => 5045,
                'country_id' => 61,
                'name' => 'Grad Zagreb',
                'code' => 'GZ',
                'adm1code' => 'HR21',
            ),
            108 => 
            array (
                'id' => 5047,
                'country_id' => 176,
                'name' => 'Curacao',
                'code' => 'CU',
                'adm1code' => '',
            ),
            109 => 
            array (
                'id' => 5048,
                'country_id' => 176,
                'name' => 'Bonaire',
                'code' => 'BO',
                'adm1code' => '',
            ),
            110 => 
            array (
                'id' => 5049,
                'country_id' => 176,
                'name' => 'St Maarten',
                'code' => 'SM',
                'adm1code' => '',
            ),
            111 => 
            array (
                'id' => 5051,
                'country_id' => 24,
                'name' => 'Brussels',
                'code' => 'BU',
                'adm1code' => 'BE11',
            ),
            112 => 
            array (
                'id' => 5052,
                'country_id' => 5,
                'name' => 'Escaldes-Engordany',
                'code' => 'EE',
                'adm1code' => 'AN08',
            ),
            113 => 
            array (
                'id' => 5053,
                'country_id' => 247,
                'name' => 'Ahal',
                'code' => 'AL',
                'adm1code' => 'TX01',
            ),
            114 => 
            array (
                'id' => 5054,
                'country_id' => 247,
                'name' => 'Balkan',
                'code' => 'BA',
                'adm1code' => 'TX02',
            ),
            115 => 
            array (
                'id' => 5055,
                'country_id' => 247,
                'name' => 'Dashhowuz',
                'code' => 'DA',
                'adm1code' => 'TX03',
            ),
            116 => 
            array (
                'id' => 5056,
                'country_id' => 247,
                'name' => 'Lebap',
                'code' => 'LE',
                'adm1code' => 'TX04',
            ),
            117 => 
            array (
                'id' => 5057,
                'country_id' => 247,
                'name' => 'Mary',
                'code' => 'MA',
                'adm1code' => 'TX05',
            ),
            118 => 
            array (
                'id' => 5058,
                'country_id' => 41,
                'name' => 'Pailin',
                'code' => 'PL',
                'adm1code' => 'CB30',
            ),
            119 => 
            array (
                'id' => 5059,
                'country_id' => 70,
                'name' => 'Orellana',
                'code' => 'OR',
                'adm1code' => 'EC24',
            ),
            120 => 
            array (
                'id' => 5060,
                'country_id' => 114,
                'name' => 'Maluku Utara',
                'code' => 'MU',
                'adm1code' => 'ID29',
            ),
            121 => 
            array (
                'id' => 5061,
                'country_id' => 259,
                'name' => 'Vargas',
                'code' => 'VA',
                'adm1code' => 'VE26',
            ),
            122 => 
            array (
                'id' => 5062,
                'country_id' => 271,
            'name' => 'Crna Gora (Montenegro)',
                'code' => 'CG',
                'adm1code' => 'YI01',
            ),
            123 => 
            array (
                'id' => 5063,
                'country_id' => 271,
            'name' => 'Srbija (Serbia)',
                'code' => 'SR',
                'adm1code' => 'YI02',
            ),
            124 => 
            array (
                'id' => 5064,
                'country_id' => 55,
                'name' => 'Maniema',
                'code' => 'MN',
                'adm1code' => 'CG10',
            ),
            125 => 
            array (
                'id' => 5065,
                'country_id' => 55,
                'name' => 'Nord-Kivu',
                'code' => 'NK',
                'adm1code' => 'CG11',
            ),
            126 => 
            array (
                'id' => 5066,
                'country_id' => 55,
                'name' => 'Sud-Kivu',
                'code' => 'SK',
                'adm1code' => 'CG12',
            ),
            127 => 
            array (
                'id' => 5067,
                'country_id' => 126,
                'name' => 'Ajlun',
                'code' => 'AJ',
                'adm1code' => 'JO20',
            ),
            128 => 
            array (
                'id' => 5068,
                'country_id' => 126,
                'name' => 'Al Aqabah',
                'code' => 'AQ',
                'adm1code' => 'JO21',
            ),
            129 => 
            array (
                'id' => 5069,
                'country_id' => 126,
                'name' => 'Jarash',
                'code' => 'JA',
                'adm1code' => 'JO22',
            ),
            130 => 
            array (
                'id' => 5070,
                'country_id' => 126,
                'name' => 'Madaba',
                'code' => 'MD',
                'adm1code' => 'JO23',
            ),
            131 => 
            array (
                'id' => 5071,
                'country_id' => 258,
                'name' => 'Malampa',
                'code' => 'ML',
                'adm1code' => 'NH16',
            ),
            132 => 
            array (
                'id' => 5072,
                'country_id' => 258,
                'name' => 'Penama',
                'code' => 'PM',
                'adm1code' => 'NH17',
            ),
            133 => 
            array (
                'id' => 5073,
                'country_id' => 258,
                'name' => 'Shefa',
                'code' => 'SE',
                'adm1code' => 'NH18',
            ),
            134 => 
            array (
                'id' => 5074,
                'country_id' => 181,
                'name' => 'Bayelsa',
                'code' => 'BY',
                'adm1code' => 'NI52',
            ),
            135 => 
            array (
                'id' => 5075,
                'country_id' => 181,
                'name' => 'Ebonyi',
                'code' => 'EB',
                'adm1code' => 'NI53',
            ),
            136 => 
            array (
                'id' => 5079,
                'country_id' => 181,
                'name' => 'Ekiti',
                'code' => 'EK',
                'adm1code' => 'NI54',
            ),
            137 => 
            array (
                'id' => 5080,
                'country_id' => 181,
                'name' => 'Gombe',
                'code' => 'GO',
                'adm1code' => 'NI55',
            ),
            138 => 
            array (
                'id' => 5081,
                'country_id' => 181,
                'name' => 'Nassarawa',
                'code' => 'NA',
                'adm1code' => 'NI56',
            ),
            139 => 
            array (
                'id' => 5082,
                'country_id' => 181,
                'name' => 'Zamfara',
                'code' => 'ZA',
                'adm1code' => 'NI57',
            ),
            140 => 
            array (
                'id' => 5083,
                'country_id' => 163,
                'name' => 'Lapusna',
                'code' => 'LP',
                'adm1code' => 'MD52',
            ),
            141 => 
            array (
                'id' => 5084,
                'country_id' => 163,
                'name' => 'Tighina',
                'code' => 'TG',
                'adm1code' => 'MD55',
            ),
            142 => 
            array (
                'id' => 5085,
                'country_id' => 37,
                'name' => 'Blagoevgrad',
                'code' => 'BL',
                'adm1code' => 'BU38',
            ),
            143 => 
            array (
                'id' => 5086,
                'country_id' => 37,
                'name' => 'Dobrich',
                'code' => 'DO',
                'adm1code' => 'BU40',
            ),
            144 => 
            array (
                'id' => 5087,
                'country_id' => 37,
                'name' => 'Gabrovo ',
                'code' => 'GB',
                'adm1code' => 'BU41',
            ),
            145 => 
            array (
                'id' => 5088,
                'country_id' => 37,
                'name' => 'Kurdzhali',
                'code' => 'KZ',
                'adm1code' => 'BU44',
            ),
            146 => 
            array (
                'id' => 5089,
                'country_id' => 37,
                'name' => 'Kyustendil',
                'code' => 'KY',
                'adm1code' => 'BU45',
            ),
            147 => 
            array (
                'id' => 5090,
                'country_id' => 37,
                'name' => 'Pazardzhik',
                'code' => 'PZ',
                'adm1code' => 'BU48',
            ),
            148 => 
            array (
                'id' => 5091,
                'country_id' => 37,
                'name' => 'Pernik',
                'code' => 'PN',
                'adm1code' => 'BU49',
            ),
            149 => 
            array (
                'id' => 5092,
                'country_id' => 37,
                'name' => 'Pleven',
                'code' => 'PV',
                'adm1code' => 'BU50',
            ),
            150 => 
            array (
                'id' => 5093,
                'country_id' => 37,
                'name' => 'Ruse',
                'code' => 'RS',
                'adm1code' => 'BU53',
            ),
            151 => 
            array (
                'id' => 5094,
                'country_id' => 37,
                'name' => 'Shumen',
                'code' => 'SH',
                'adm1code' => 'BU54',
            ),
            152 => 
            array (
                'id' => 5095,
                'country_id' => 37,
                'name' => 'Silistra',
                'code' => 'SI',
                'adm1code' => 'BU55',
            ),
            153 => 
            array (
                'id' => 5096,
                'country_id' => 37,
                'name' => 'Sliven',
                'code' => 'SL',
                'adm1code' => 'BU56',
            ),
            154 => 
            array (
                'id' => 5097,
                'country_id' => 37,
                'name' => 'Smolyan',
                'code' => 'SM',
                'adm1code' => 'BU57',
            ),
            155 => 
            array (
                'id' => 5098,
                'country_id' => 37,
                'name' => 'Stara Zagora',
                'code' => 'SZ',
                'adm1code' => 'BU59',
            ),
            156 => 
            array (
                'id' => 5099,
                'country_id' => 37,
                'name' => 'Turgovishte',
                'code' => 'TU',
                'adm1code' => 'BU60',
            ),
            157 => 
            array (
                'id' => 5100,
                'country_id' => 37,
                'name' => 'Veliko Turnovo',
                'code' => 'VT',
                'adm1code' => 'BU62',
            ),
            158 => 
            array (
                'id' => 5101,
                'country_id' => 37,
                'name' => 'Vidin',
                'code' => 'VD',
                'adm1code' => 'BU63',
            ),
            159 => 
            array (
                'id' => 5102,
                'country_id' => 37,
                'name' => 'Vratsa',
                'code' => 'VR',
                'adm1code' => 'BU64',
            ),
            160 => 
            array (
                'id' => 5103,
                'country_id' => 37,
                'name' => 'Yambol',
                'code' => 'YA',
                'adm1code' => 'BU65',
            ),
            161 => 
            array (
                'id' => 5104,
                'country_id' => 115,
                'name' => 'Golestan',
                'code' => 'GO',
                'adm1code' => 'IR37',
            ),
            162 => 
            array (
                'id' => 5105,
                'country_id' => 115,
                'name' => 'Qazvin',
                'code' => 'QZ',
                'adm1code' => 'IR38',
            ),
            163 => 
            array (
                'id' => 5106,
                'country_id' => 115,
                'name' => 'Qom',
                'code' => 'QM',
                'adm1code' => 'IR39',
            ),
            164 => 
            array (
                'id' => 5107,
                'country_id' => 246,
                'name' => 'Ardahan',
                'code' => 'AR',
                'adm1code' => 'TU86',
            ),
            165 => 
            array (
                'id' => 5108,
                'country_id' => 246,
                'name' => 'Bartin',
                'code' => 'BR',
                'adm1code' => 'TU87',
            ),
            166 => 
            array (
                'id' => 5109,
                'country_id' => 246,
                'name' => 'Igdir',
                'code' => 'IG',
                'adm1code' => 'TU88',
            ),
            167 => 
            array (
                'id' => 5110,
                'country_id' => 246,
                'name' => 'Karabuk',
                'code' => 'KB',
                'adm1code' => 'TU89',
            ),
            168 => 
            array (
                'id' => 5111,
                'country_id' => 246,
                'name' => 'Kilis',
                'code' => 'KI',
                'adm1code' => 'TU90',
            ),
            169 => 
            array (
                'id' => 5112,
                'country_id' => 246,
                'name' => 'Osmaniye',
                'code' => 'OS',
                'adm1code' => 'TU91',
            ),
            170 => 
            array (
                'id' => 5113,
                'country_id' => 246,
                'name' => 'Yalova',
                'code' => 'YL',
                'adm1code' => 'TU92',
            ),
            171 => 
            array (
                'id' => 5114,
                'country_id' => 18,
                'name' => 'Ar Rifa\' wa al Mintaqah al Janubiyah',
                'code' => 'RF',
                'adm1code' => 'BA13',
            ),
            172 => 
            array (
                'id' => 5115,
                'country_id' => 30,
                'name' => 'Republika Srpska',
                'code' => 'SR',
                'adm1code' => 'BK02',
            ),
            173 => 
            array (
                'id' => 5116,
                'country_id' => 30,
                'name' => 'Federation of Bosnia and Herzegovina',
                'code' => 'BF',
                'adm1code' => 'BK01',
            ),
            174 => 
            array (
                'id' => 5118,
                'country_id' => 135,
                'name' => 'Batken',
                'code' => 'BA',
                'adm1code' => 'KG09',
            ),
            175 => 
            array (
                'id' => 5119,
                'country_id' => 132,
                'name' => 'P\'yongan-bukto',
                'code' => 'PB',
                'adm1code' => 'KN11',
            ),
            176 => 
            array (
                'id' => 5120,
                'country_id' => 203,
                'name' => 'Tyva',
                'code' => 'TU',
                'adm1code' => 'RS79',
            ),
            177 => 
            array (
                'id' => 5122,
                'country_id' => 64,
                'name' => 'Jihomoravsky Kraj',
                'code' => 'JM',
                'adm1code' => 'EZ78',
            ),
            178 => 
            array (
                'id' => 5123,
                'country_id' => 64,
                'name' => 'Jihocesky Kraj',
                'code' => 'JC',
                'adm1code' => 'EZ79',
            ),
            179 => 
            array (
                'id' => 5124,
                'country_id' => 64,
                'name' => 'Vysocina',
                'code' => 'VY',
                'adm1code' => 'EZ80',
            ),
            180 => 
            array (
                'id' => 5125,
                'country_id' => 64,
                'name' => 'Karlovarsky Kraj',
                'code' => 'KA',
                'adm1code' => 'EZ81',
            ),
            181 => 
            array (
                'id' => 5126,
                'country_id' => 64,
                'name' => 'Kralovehradecky Kraj',
                'code' => 'KR',
                'adm1code' => 'EZ82',
            ),
            182 => 
            array (
                'id' => 5127,
                'country_id' => 64,
                'name' => 'Liberecky Kraj',
                'code' => 'LI',
                'adm1code' => 'EZ83',
            ),
            183 => 
            array (
                'id' => 5128,
                'country_id' => 64,
                'name' => 'Olomoucky Kraj',
                'code' => 'OL',
                'adm1code' => 'EZ84',
            ),
            184 => 
            array (
                'id' => 5129,
                'country_id' => 64,
                'name' => 'Moravskoslezsky Kraj',
                'code' => 'MO',
                'adm1code' => 'EZ85',
            ),
            185 => 
            array (
                'id' => 5130,
                'country_id' => 64,
                'name' => 'Pardubicky Kraj',
                'code' => 'PA',
                'adm1code' => 'EZ86',
            ),
            186 => 
            array (
                'id' => 5131,
                'country_id' => 64,
                'name' => 'Plzensky Kraj',
                'code' => 'PL',
                'adm1code' => 'EZ87',
            ),
            187 => 
            array (
                'id' => 5132,
                'country_id' => 64,
                'name' => 'Stredocesky Kraj',
                'code' => 'ST',
                'adm1code' => 'EZ88',
            ),
            188 => 
            array (
                'id' => 5133,
                'country_id' => 64,
                'name' => 'Ustecky Kraj',
                'code' => 'US',
                'adm1code' => 'EZ89',
            ),
            189 => 
            array (
                'id' => 5134,
                'country_id' => 64,
                'name' => 'Zlinsky Kraj',
                'code' => 'ZL',
                'adm1code' => 'EZ90',
            ),
            190 => 
            array (
                'id' => 5135,
                'country_id' => 146,
                'name' => 'Aracinovo',
                'code' => 'AR',
                'adm1code' => 'MK01',
            ),
            191 => 
            array (
                'id' => 5136,
                'country_id' => 146,
                'name' => 'Bac',
                'code' => 'BA',
                'adm1code' => 'MK02',
            ),
            192 => 
            array (
                'id' => 5137,
                'country_id' => 146,
                'name' => 'Belcista',
                'code' => 'BE',
                'adm1code' => 'MK03',
            ),
            193 => 
            array (
                'id' => 5138,
                'country_id' => 146,
                'name' => 'Berovo',
                'code' => 'BR',
                'adm1code' => 'MK04',
            ),
            194 => 
            array (
                'id' => 5139,
                'country_id' => 146,
                'name' => 'Bistrica',
                'code' => 'BI',
                'adm1code' => 'MK05',
            ),
            195 => 
            array (
                'id' => 5140,
                'country_id' => 146,
                'name' => 'Bitola',
                'code' => 'BO',
                'adm1code' => 'MK06',
            ),
            196 => 
            array (
                'id' => 5141,
                'country_id' => 146,
                'name' => 'Blatec',
                'code' => 'BL',
                'adm1code' => 'MK07',
            ),
            197 => 
            array (
                'id' => 5142,
                'country_id' => 146,
                'name' => 'Bogdanci',
                'code' => 'BG',
                'adm1code' => 'MK08',
            ),
            198 => 
            array (
                'id' => 5143,
                'country_id' => 146,
                'name' => 'Bogomila',
                'code' => 'BM',
                'adm1code' => 'MK09',
            ),
            199 => 
            array (
                'id' => 5144,
                'country_id' => 146,
                'name' => 'Bogovinje',
                'code' => 'BJ',
                'adm1code' => 'MK10',
            ),
            200 => 
            array (
                'id' => 5145,
                'country_id' => 146,
                'name' => 'Bosilovo',
                'code' => 'BS',
                'adm1code' => 'MK11',
            ),
            201 => 
            array (
                'id' => 5146,
                'country_id' => 146,
                'name' => 'Brvenica',
                'code' => 'BN',
                'adm1code' => 'MK12',
            ),
            202 => 
            array (
                'id' => 5147,
                'country_id' => 146,
                'name' => 'Cair',
                'code' => 'CR',
                'adm1code' => 'MK13',
            ),
            203 => 
            array (
                'id' => 5148,
                'country_id' => 146,
                'name' => 'Capari',
                'code' => 'CP',
                'adm1code' => 'MK14',
            ),
            204 => 
            array (
                'id' => 5149,
                'country_id' => 146,
                'name' => 'Caska',
                'code' => 'CK',
                'adm1code' => 'MK15',
            ),
            205 => 
            array (
                'id' => 5150,
                'country_id' => 146,
                'name' => 'Cegrane',
                'code' => 'CG',
                'adm1code' => 'MK16',
            ),
            206 => 
            array (
                'id' => 5151,
                'country_id' => 146,
                'name' => 'Centar',
                'code' => 'CE',
                'adm1code' => 'MK17',
            ),
            207 => 
            array (
                'id' => 5152,
                'country_id' => 146,
                'name' => 'Centar Zupa',
                'code' => 'CZ',
                'adm1code' => 'MK18',
            ),
            208 => 
            array (
                'id' => 5153,
                'country_id' => 146,
                'name' => 'Cesinovo',
                'code' => 'CN',
                'adm1code' => 'MK19',
            ),
            209 => 
            array (
                'id' => 5154,
                'country_id' => 146,
                'name' => 'Cucer-Sandevo',
                'code' => 'CS',
                'adm1code' => 'MK20',
            ),
            210 => 
            array (
                'id' => 5155,
                'country_id' => 146,
                'name' => 'Debar',
                'code' => 'DB',
                'adm1code' => 'MK21',
            ),
            211 => 
            array (
                'id' => 5156,
                'country_id' => 146,
                'name' => 'Delcevo',
                'code' => 'DL',
                'adm1code' => 'MK22',
            ),
            212 => 
            array (
                'id' => 5157,
                'country_id' => 146,
                'name' => 'Delogozdi',
                'code' => 'DG',
                'adm1code' => 'MK23',
            ),
            213 => 
            array (
                'id' => 5158,
                'country_id' => 146,
                'name' => 'Demir Hisar',
                'code' => 'DX',
                'adm1code' => 'MK24',
            ),
            214 => 
            array (
                'id' => 5159,
                'country_id' => 146,
                'name' => 'Demir Kapija',
                'code' => 'DK',
                'adm1code' => 'MK25',
            ),
            215 => 
            array (
                'id' => 5160,
                'country_id' => 146,
                'name' => 'Dobrusevo',
                'code' => 'DO',
                'adm1code' => 'MK26',
            ),
            216 => 
            array (
                'id' => 5161,
                'country_id' => 146,
                'name' => 'Dolna Banjica',
                'code' => 'DJ',
                'adm1code' => 'MK27',
            ),
            217 => 
            array (
                'id' => 5162,
                'country_id' => 146,
                'name' => 'Dolneni',
                'code' => 'DN',
                'adm1code' => 'MK28',
            ),
            218 => 
            array (
                'id' => 5163,
                'country_id' => 146,
                'name' => 'Dorce Petrov',
                'code' => 'GP',
                'adm1code' => 'MK29',
            ),
            219 => 
            array (
                'id' => 5164,
                'country_id' => 146,
                'name' => 'Drugovo',
                'code' => 'DR',
                'adm1code' => 'MK30',
            ),
            220 => 
            array (
                'id' => 5165,
                'country_id' => 146,
                'name' => 'Dzepciste',
                'code' => 'DZ',
                'adm1code' => 'MK31',
            ),
            221 => 
            array (
                'id' => 5166,
                'country_id' => 146,
                'name' => 'Gazi Baba',
                'code' => 'GB',
                'adm1code' => 'MK32',
            ),
            222 => 
            array (
                'id' => 5167,
                'country_id' => 146,
                'name' => 'Gevgelija',
                'code' => 'GE',
                'adm1code' => 'MK33',
            ),
            223 => 
            array (
                'id' => 5168,
                'country_id' => 146,
                'name' => 'Gostivar',
                'code' => 'GO',
                'adm1code' => 'MK34',
            ),
            224 => 
            array (
                'id' => 5169,
                'country_id' => 146,
                'name' => 'Gradsko',
                'code' => 'GR',
                'adm1code' => 'MK35',
            ),
            225 => 
            array (
                'id' => 5170,
                'country_id' => 146,
                'name' => 'Ilinden',
                'code' => 'IL',
                'adm1code' => 'MK36',
            ),
            226 => 
            array (
                'id' => 5171,
                'country_id' => 146,
                'name' => 'Izvor',
                'code' => 'IZ',
                'adm1code' => 'MK37',
            ),
            227 => 
            array (
                'id' => 5172,
                'country_id' => 146,
                'name' => 'Jegunovce',
                'code' => 'JE',
                'adm1code' => 'MK38',
            ),
            228 => 
            array (
                'id' => 5173,
                'country_id' => 146,
                'name' => 'Kamenjane',
                'code' => 'KJ',
                'adm1code' => 'MK39',
            ),
            229 => 
            array (
                'id' => 5174,
                'country_id' => 146,
                'name' => 'Karbinci',
                'code' => 'KB',
                'adm1code' => 'MK40',
            ),
            230 => 
            array (
                'id' => 5175,
                'country_id' => 146,
                'name' => 'Karpos',
                'code' => 'KX',
                'adm1code' => 'MK41',
            ),
            231 => 
            array (
                'id' => 5176,
                'country_id' => 146,
                'name' => 'Kavadarci',
                'code' => 'KD',
                'adm1code' => 'MK42',
            ),
            232 => 
            array (
                'id' => 5177,
                'country_id' => 146,
                'name' => 'Kicevo',
                'code' => 'KH',
                'adm1code' => 'MK43',
            ),
            233 => 
            array (
                'id' => 5178,
                'country_id' => 146,
                'name' => 'Kisela Voda',
                'code' => 'KV',
                'adm1code' => 'MK44',
            ),
            234 => 
            array (
                'id' => 5179,
                'country_id' => 146,
                'name' => 'Klecevce',
                'code' => 'KL',
                'adm1code' => 'MK45',
            ),
            235 => 
            array (
                'id' => 5180,
                'country_id' => 146,
                'name' => 'Kocani',
                'code' => 'KC',
                'adm1code' => 'MK46',
            ),
            236 => 
            array (
                'id' => 5181,
                'country_id' => 146,
                'name' => 'Konce',
                'code' => 'KN',
                'adm1code' => 'MK47',
            ),
            237 => 
            array (
                'id' => 5182,
                'country_id' => 146,
                'name' => 'Kondovo',
                'code' => 'KW',
                'adm1code' => 'MK48',
            ),
            238 => 
            array (
                'id' => 5183,
                'country_id' => 146,
                'name' => 'Konopiste',
                'code' => 'KF',
                'adm1code' => 'MK49',
            ),
            239 => 
            array (
                'id' => 5184,
                'country_id' => 146,
                'name' => 'Kosel',
                'code' => 'KE',
                'adm1code' => 'MK50',
            ),
            240 => 
            array (
                'id' => 5185,
                'country_id' => 146,
                'name' => 'Kartovo',
                'code' => 'KY',
                'adm1code' => 'MK51',
            ),
            241 => 
            array (
                'id' => 5186,
                'country_id' => 146,
                'name' => 'Kriva Palanka',
                'code' => 'KZ',
                'adm1code' => 'MK52',
            ),
            242 => 
            array (
                'id' => 5187,
                'country_id' => 146,
                'name' => 'Krivogastani',
                'code' => 'KG',
                'adm1code' => 'MK53',
            ),
            243 => 
            array (
                'id' => 5188,
                'country_id' => 146,
                'name' => 'Krusevo',
                'code' => 'KS',
                'adm1code' => 'MK54',
            ),
            244 => 
            array (
                'id' => 5189,
                'country_id' => 146,
                'name' => 'Kuklis',
                'code' => 'KK',
                'adm1code' => 'MK55',
            ),
            245 => 
            array (
                'id' => 5190,
                'country_id' => 146,
                'name' => 'Kukurecani',
                'code' => 'KQ',
                'adm1code' => 'MK56',
            ),
            246 => 
            array (
                'id' => 5191,
                'country_id' => 146,
                'name' => 'Kumanovo',
                'code' => 'KM',
                'adm1code' => 'MK57',
            ),
            247 => 
            array (
                'id' => 5192,
                'country_id' => 146,
                'name' => 'Labunista',
                'code' => 'LA',
                'adm1code' => 'MK58',
            ),
            248 => 
            array (
                'id' => 5193,
                'country_id' => 146,
                'name' => 'Lipkovo',
                'code' => 'LI',
                'adm1code' => 'MK59',
            ),
            249 => 
            array (
                'id' => 5194,
                'country_id' => 146,
                'name' => 'Lozovo',
                'code' => 'LO',
                'adm1code' => 'MK60',
            ),
            250 => 
            array (
                'id' => 5195,
                'country_id' => 146,
                'name' => 'Lukovo',
                'code' => 'LU',
                'adm1code' => 'MK61',
            ),
            251 => 
            array (
                'id' => 5196,
                'country_id' => 146,
                'name' => 'Makedonska Kamenica',
                'code' => 'MM',
                'adm1code' => 'MK62',
            ),
            252 => 
            array (
                'id' => 5197,
                'country_id' => 146,
                'name' => 'Makedonski Brod',
                'code' => 'MB',
                'adm1code' => 'MK63',
            ),
            253 => 
            array (
                'id' => 5198,
                'country_id' => 146,
                'name' => 'Mavrovi Anovi',
                'code' => 'MA',
                'adm1code' => 'MK64',
            ),
            254 => 
            array (
                'id' => 5199,
                'country_id' => 146,
                'name' => 'Meseista',
                'code' => 'ME',
                'adm1code' => 'MK65',
            ),
            255 => 
            array (
                'id' => 5200,
                'country_id' => 146,
                'name' => 'Miravci',
                'code' => 'MI',
                'adm1code' => 'MK66',
            ),
            256 => 
            array (
                'id' => 5201,
                'country_id' => 146,
                'name' => 'Mogila',
                'code' => 'MO',
                'adm1code' => 'MK67',
            ),
            257 => 
            array (
                'id' => 5202,
                'country_id' => 146,
                'name' => 'Murtino',
                'code' => 'MU',
                'adm1code' => 'MK68',
            ),
            258 => 
            array (
                'id' => 5203,
                'country_id' => 146,
                'name' => 'Negotino',
                'code' => 'NG',
                'adm1code' => 'MK69',
            ),
            259 => 
            array (
                'id' => 5204,
                'country_id' => 146,
                'name' => 'Negotino-Polosko',
                'code' => 'NP',
                'adm1code' => 'MK70',
            ),
            260 => 
            array (
                'id' => 5205,
                'country_id' => 146,
                'name' => 'Novaci',
                'code' => 'NO',
                'adm1code' => 'MK71',
            ),
            261 => 
            array (
                'id' => 5206,
                'country_id' => 146,
                'name' => 'Novo Selo',
                'code' => 'NS',
                'adm1code' => 'MK72',
            ),
            262 => 
            array (
                'id' => 5207,
                'country_id' => 146,
                'name' => 'Oblesevo',
                'code' => 'OB',
                'adm1code' => 'MK73',
            ),
            263 => 
            array (
                'id' => 5208,
                'country_id' => 146,
                'name' => 'Ohrid',
                'code' => 'OX',
                'adm1code' => 'MK74',
            ),
            264 => 
            array (
                'id' => 5209,
                'country_id' => 146,
                'name' => 'Orasac',
                'code' => 'OR',
                'adm1code' => 'MK75',
            ),
            265 => 
            array (
                'id' => 5210,
                'country_id' => 146,
                'name' => 'Orizari',
                'code' => 'OZ',
                'adm1code' => 'MK76',
            ),
            266 => 
            array (
                'id' => 5211,
                'country_id' => 146,
                'name' => 'Oslomej',
                'code' => 'OS',
                'adm1code' => 'MK77',
            ),
            267 => 
            array (
                'id' => 5212,
                'country_id' => 146,
                'name' => 'Pehcevo',
                'code' => 'PH',
                'adm1code' => 'MK78',
            ),
            268 => 
            array (
                'id' => 5213,
                'country_id' => 146,
                'name' => 'Petrovec',
                'code' => 'PE',
                'adm1code' => 'MK79',
            ),
            269 => 
            array (
                'id' => 5214,
                'country_id' => 146,
                'name' => 'Plasnica',
                'code' => 'PN',
                'adm1code' => 'MK80',
            ),
            270 => 
            array (
                'id' => 5215,
                'country_id' => 146,
                'name' => 'Podares',
                'code' => 'PO',
                'adm1code' => 'MK81',
            ),
            271 => 
            array (
                'id' => 5216,
                'country_id' => 146,
                'name' => 'Prilep',
                'code' => 'PR',
                'adm1code' => 'MK82',
            ),
            272 => 
            array (
                'id' => 5217,
                'country_id' => 146,
                'name' => 'Probistip',
                'code' => 'PB',
                'adm1code' => 'MK83',
            ),
            273 => 
            array (
                'id' => 5218,
                'country_id' => 146,
                'name' => 'Radovis',
                'code' => 'RD',
                'adm1code' => 'MK84',
            ),
            274 => 
            array (
                'id' => 5219,
                'country_id' => 146,
                'name' => 'Rankovce',
                'code' => 'RN',
                'adm1code' => 'MK85',
            ),
            275 => 
            array (
                'id' => 5220,
                'country_id' => 146,
                'name' => 'Resen',
                'code' => 'RE',
                'adm1code' => 'MK86',
            ),
            276 => 
            array (
                'id' => 5221,
                'country_id' => 146,
                'name' => 'Rosoman',
                'code' => 'RM',
                'adm1code' => 'MK87',
            ),
            277 => 
            array (
                'id' => 5222,
                'country_id' => 146,
                'name' => 'Rostusa',
                'code' => 'RT',
                'adm1code' => 'MK88',
            ),
            278 => 
            array (
                'id' => 5223,
                'country_id' => 146,
                'name' => 'Samokov',
                'code' => 'SA',
                'adm1code' => 'MK89',
            ),
            279 => 
            array (
                'id' => 5224,
                'country_id' => 146,
                'name' => 'Saraj',
                'code' => 'SJ',
                'adm1code' => 'MK90',
            ),
            280 => 
            array (
                'id' => 5225,
                'country_id' => 146,
                'name' => 'Sipkovica',
                'code' => 'SI',
                'adm1code' => 'MK91',
            ),
            281 => 
            array (
                'id' => 5226,
                'country_id' => 146,
                'name' => 'Sopiste',
                'code' => 'SS',
                'adm1code' => 'MK92',
            ),
            282 => 
            array (
                'id' => 5227,
                'country_id' => 146,
                'name' => 'Sopotnica',
                'code' => 'SC',
                'adm1code' => 'MK93',
            ),
            283 => 
            array (
                'id' => 5228,
                'country_id' => 146,
                'name' => 'Srbinovo',
                'code' => 'SB',
                'adm1code' => 'MK94',
            ),
            284 => 
            array (
                'id' => 5229,
                'country_id' => 146,
                'name' => 'Staravina',
                'code' => 'SV',
                'adm1code' => 'MK95',
            ),
            285 => 
            array (
                'id' => 5230,
                'country_id' => 146,
                'name' => 'Star Dojran',
                'code' => 'SD',
                'adm1code' => 'MK96',
            ),
            286 => 
            array (
                'id' => 5231,
                'country_id' => 146,
                'name' => 'Star Nagoricane',
                'code' => 'SE',
                'adm1code' => 'MK97',
            ),
            287 => 
            array (
                'id' => 5232,
                'country_id' => 146,
                'name' => 'Stip',
                'code' => 'ST',
                'adm1code' => 'MK98',
            ),
            288 => 
            array (
                'id' => 5233,
                'country_id' => 146,
                'name' => 'Struga',
                'code' => 'SQ',
                'adm1code' => 'MK99',
            ),
            289 => 
            array (
                'id' => 5234,
                'country_id' => 146,
                'name' => 'Strumica',
                'code' => 'SR',
                'adm1code' => 'MKA1',
            ),
            290 => 
            array (
                'id' => 5235,
                'country_id' => 146,
                'name' => 'Studenicani',
                'code' => 'SU',
                'adm1code' => 'MKA2',
            ),
            291 => 
            array (
                'id' => 5236,
                'country_id' => 146,
                'name' => 'Suto Orizari',
                'code' => 'SO',
                'adm1code' => 'MKA3',
            ),
            292 => 
            array (
                'id' => 5237,
                'country_id' => 146,
                'name' => 'Sveti Nikole',
                'code' => 'SL',
                'adm1code' => 'MKA4',
            ),
            293 => 
            array (
                'id' => 5238,
                'country_id' => 146,
                'name' => 'Tearce',
                'code' => 'TR',
                'adm1code' => 'MKA5',
            ),
            294 => 
            array (
                'id' => 5239,
                'country_id' => 146,
                'name' => 'Tetovo',
                'code' => 'TT',
                'adm1code' => 'MKA6',
            ),
            295 => 
            array (
                'id' => 5240,
                'country_id' => 146,
                'name' => 'Topolcani',
                'code' => 'TO',
                'adm1code' => 'MKA7',
            ),
            296 => 
            array (
                'id' => 5241,
                'country_id' => 146,
                'name' => 'Valandovo',
                'code' => 'VA',
                'adm1code' => 'MKA8',
            ),
            297 => 
            array (
                'id' => 5242,
                'country_id' => 146,
                'name' => 'Vasilevo',
                'code' => 'VL',
                'adm1code' => 'MKA9',
            ),
            298 => 
            array (
                'id' => 5243,
                'country_id' => 146,
                'name' => 'Veles',
                'code' => 'VE',
                'adm1code' => 'MKB1',
            ),
            299 => 
            array (
                'id' => 5244,
                'country_id' => 146,
                'name' => 'Velesta',
                'code' => 'VS',
                'adm1code' => 'MKB2',
            ),
            300 => 
            array (
                'id' => 5245,
                'country_id' => 146,
                'name' => 'Vevcani',
                'code' => 'VV',
                'adm1code' => 'MKB3',
            ),
            301 => 
            array (
                'id' => 5246,
                'country_id' => 146,
                'name' => 'Vinica',
                'code' => 'VN',
                'adm1code' => 'MKB4',
            ),
            302 => 
            array (
                'id' => 5247,
                'country_id' => 146,
                'name' => 'Vitoliste',
                'code' => 'VT',
                'adm1code' => 'MKB5',
            ),
            303 => 
            array (
                'id' => 5248,
                'country_id' => 146,
                'name' => 'Vranestica',
                'code' => 'VC',
                'adm1code' => 'MKB6',
            ),
            304 => 
            array (
                'id' => 5249,
                'country_id' => 146,
                'name' => 'Vrapciste',
                'code' => 'VP',
                'adm1code' => 'MKB7',
            ),
            305 => 
            array (
                'id' => 5250,
                'country_id' => 146,
                'name' => 'Vratnica',
                'code' => 'VR',
                'adm1code' => 'MKB8',
            ),
            306 => 
            array (
                'id' => 5251,
                'country_id' => 146,
                'name' => 'Vrutok',
                'code' => 'VK',
                'adm1code' => 'MKB9',
            ),
            307 => 
            array (
                'id' => 5252,
                'country_id' => 146,
                'name' => 'Zajas',
                'code' => 'ZA',
                'adm1code' => 'MKC1',
            ),
            308 => 
            array (
                'id' => 5253,
                'country_id' => 146,
                'name' => 'Zelenikovo',
                'code' => 'ZK',
                'adm1code' => 'MKC2',
            ),
            309 => 
            array (
                'id' => 5254,
                'country_id' => 146,
                'name' => 'Zelino',
                'code' => 'ZE',
                'adm1code' => 'MKC3',
            ),
            310 => 
            array (
                'id' => 5255,
                'country_id' => 146,
                'name' => 'Zitose',
                'code' => 'ZI',
                'adm1code' => 'MKC4',
            ),
            311 => 
            array (
                'id' => 5256,
                'country_id' => 146,
                'name' => 'Zletovo',
                'code' => 'ZL',
                'adm1code' => 'MKC5',
            ),
            312 => 
            array (
                'id' => 5257,
                'country_id' => 146,
                'name' => 'Zrnovci',
                'code' => 'ZR',
                'adm1code' => 'MKC6',
            ),
            313 => 
            array (
                'id' => 5258,
                'country_id' => 271,
                'name' => 'Kosovo',
                'code' => 'KM',
                'adm1code' => '',
            ),
            314 => 
            array (
                'id' => 5259,
                'country_id' => 113,
                'name' => 'Uttaranchal',
                'code' => 'UL',
                'adm1code' => 'IN39',
            ),
            315 => 
            array (
                'id' => 5260,
                'country_id' => 254,
                'name' => 'AOL',
                'code' => 'AO',
                'adm1code' => '',
            ),
            316 => 
            array (
                'id' => 5261,
                'country_id' => 254,
                'name' => 'WebTV',
                'code' => 'WE',
                'adm1code' => '',
            ),
            317 => 
            array (
                'id' => 5263,
                'country_id' => 253,
                'name' => 'AOL',
                'code' => 'AO',
                'adm1code' => '',
            ),
            318 => 
            array (
                'id' => 5264,
                'country_id' => 33,
                'name' => 'AOL',
                'code' => 'AO',
                'adm1code' => '',
            ),
            319 => 
            array (
                'id' => 5265,
                'country_id' => 122,
                'name' => 'AOL',
                'code' => 'AO',
                'adm1code' => '',
            ),
            320 => 
            array (
                'id' => 5266,
                'country_id' => 91,
                'name' => 'AOL',
                'code' => 'AO',
                'adm1code' => '',
            ),
            321 => 
            array (
                'id' => 5267,
                'country_id' => 113,
                'name' => 'Chhattisgarh',
                'code' => 'CT',
                'adm1code' => 'IN37',
            ),
            322 => 
            array (
                'id' => 5268,
                'country_id' => 113,
                'name' => 'Jharkhand',
                'code' => 'JH',
                'adm1code' => 'IN38',
            ),
            323 => 
            array (
                'id' => 5269,
                'country_id' => 40,
                'name' => 'Mwaro',
                'code' => 'MW',
                'adm1code' => 'BY23',
            ),
            324 => 
            array (
                'id' => 5270,
                'country_id' => 274,
                'name' => 'Bulawayo',
                'code' => 'BU',
                'adm1code' => 'ZI09',
            ),
            325 => 
            array (
                'id' => 5271,
                'country_id' => 274,
                'name' => 'Harare',
                'code' => 'HA',
                'adm1code' => 'ZI10',
            ),
            326 => 
            array (
                'id' => 5272,
                'country_id' => 60,
                'name' => 'Adiake',
                'code' => 'AD',
                'adm1code' => 'IV63',
            ),
            327 => 
            array (
                'id' => 5273,
                'country_id' => 60,
                'name' => 'Alepe',
                'code' => 'AL',
                'adm1code' => 'IV64',
            ),
            328 => 
            array (
                'id' => 5274,
                'country_id' => 60,
                'name' => 'Bocanda',
                'code' => 'BN',
                'adm1code' => 'IV65',
            ),
            329 => 
            array (
                'id' => 5275,
                'country_id' => 60,
                'name' => 'Dabou',
                'code' => 'DA',
                'adm1code' => 'IV66',
            ),
            330 => 
            array (
                'id' => 5276,
                'country_id' => 60,
                'name' => 'Grand-Bassam',
                'code' => 'GR',
                'adm1code' => 'IV68',
            ),
            331 => 
            array (
                'id' => 5277,
                'country_id' => 60,
                'name' => 'Jacqueville',
                'code' => 'JA',
                'adm1code' => 'IV70',
            ),
            332 => 
            array (
                'id' => 5278,
                'country_id' => 60,
                'name' => 'Toulepleu',
                'code' => 'TP',
                'adm1code' => 'IV72',
            ),
            333 => 
            array (
                'id' => 5279,
                'country_id' => 102,
                'name' => 'Mandiana',
                'code' => 'MD',
                'adm1code' => 'GV37',
            ),
            334 => 
            array (
                'id' => 5280,
                'country_id' => 102,
                'name' => 'Lola',
                'code' => 'LO',
                'adm1code' => 'GV36',
            ),
            335 => 
            array (
                'id' => 5281,
                'country_id' => 102,
                'name' => 'Lelouma',
                'code' => 'LE',
                'adm1code' => 'GV35',
            ),
            336 => 
            array (
                'id' => 5282,
                'country_id' => 102,
                'name' => 'Koubia',
                'code' => 'KB',
                'adm1code' => 'GV33',
            ),
            337 => 
            array (
                'id' => 5283,
                'country_id' => 102,
                'name' => 'Coyah',
                'code' => 'CO',
                'adm1code' => 'GV30',
            ),
            338 => 
            array (
                'id' => 5284,
                'country_id' => 114,
                'name' => 'Gorontalo',
                'code' => 'GO',
                'adm1code' => 'ID34',
            ),
            339 => 
            array (
                'id' => 5285,
                'country_id' => 114,
                'name' => 'Kepulauan Bangka Belitung',
                'code' => 'BB',
                'adm1code' => 'ID35',
            ),
            340 => 
            array (
                'id' => 5286,
                'country_id' => 114,
                'name' => 'Banten',
                'code' => 'BT',
                'adm1code' => 'ID33',
            ),
            341 => 
            array (
                'id' => 5287,
                'country_id' => 133,
                'name' => 'Ulsan-gwangyoksi',
                'code' => 'UL',
                'adm1code' => 'KS21',
            ),
            342 => 
            array (
                'id' => 5289,
                'country_id' => 250,
                'name' => 'Sembabule',
                'code' => 'SE',
                'adm1code' => 'UG74',
            ),
            343 => 
            array (
                'id' => 5290,
                'country_id' => 250,
                'name' => 'Nakasongola',
                'code' => 'NA',
                'adm1code' => 'UG73',
            ),
            344 => 
            array (
                'id' => 5291,
                'country_id' => 250,
                'name' => 'Katakwi',
                'code' => 'KW',
                'adm1code' => 'UG69',
            ),
            345 => 
            array (
                'id' => 5292,
                'country_id' => 250,
                'name' => 'Busia',
                'code' => 'BU',
                'adm1code' => 'UG67',
            ),
            346 => 
            array (
                'id' => 5293,
                'country_id' => 250,
                'name' => 'Bugiri',
                'code' => 'BG',
                'adm1code' => 'UG66',
            ),
            347 => 
            array (
                'id' => 5294,
                'country_id' => 250,
                'name' => 'Adjumani',
                'code' => 'AD',
                'adm1code' => 'UG65',
            ),
            348 => 
            array (
                'id' => 5295,
                'country_id' => 138,
                'name' => 'Nabatiye',
                'code' => 'NA',
                'adm1code' => 'LE07',
            ),
            349 => 
            array (
                'id' => 5296,
                'country_id' => 1,
                'name' => 'Khost',
                'code' => 'KT',
                'adm1code' => '',
            ),
            350 => 
            array (
                'id' => 5297,
                'country_id' => 1,
                'name' => 'Nuristan',
                'code' => 'NR',
                'adm1code' => '',
            ),
            351 => 
            array (
                'id' => 5298,
                'country_id' => 16,
                'name' => 'Sarur',
                'code' => 'SR',
                'adm1code' => '',
            ),
            352 => 
            array (
                'id' => 5299,
                'country_id' => 16,
                'name' => 'Sahbuz',
                'code' => 'SH',
                'adm1code' => '',
            ),
            353 => 
            array (
                'id' => 5300,
                'country_id' => 16,
                'name' => 'Sadarak',
                'code' => 'SD',
                'adm1code' => '',
            ),
            354 => 
            array (
                'id' => 5301,
                'country_id' => 16,
                'name' => 'Ordubud',
                'code' => 'OR',
                'adm1code' => '',
            ),
            355 => 
            array (
                'id' => 5302,
                'country_id' => 16,
                'name' => 'Babak',
                'code' => 'BB',
                'adm1code' => '',
            ),
            356 => 
            array (
                'id' => 5303,
                'country_id' => 20,
                'name' => 'Barisal',
                'code' => 'BA',
                'adm1code' => '',
            ),
            357 => 
            array (
                'id' => 5304,
                'country_id' => 20,
                'name' => 'Sylhet',
                'code' => 'SY',
                'adm1code' => '',
            ),
            358 => 
            array (
                'id' => 5305,
                'country_id' => 24,
                'name' => 'Brabant Wallon',
                'code' => 'BW',
                'adm1code' => 'BE10',
            ),
            359 => 
            array (
                'id' => 5306,
                'country_id' => 24,
                'name' => 'Vlaams-Brabant',
                'code' => 'VB',
                'adm1code' => 'BE12',
            ),
            360 => 
            array (
                'id' => 5308,
                'country_id' => 27,
                'name' => 'Hamilton',
                'code' => 'HA',
                'adm1code' => 'BD02',
            ),
            361 => 
            array (
                'id' => 5309,
                'country_id' => 4,
                'name' => 'Eastern Tutuila',
                'code' => 'ET',
                'adm1code' => '',
            ),
            362 => 
            array (
                'id' => 5310,
                'country_id' => 4,
                'name' => 'Unorganized',
                'code' => 'UU',
                'adm1code' => '',
            ),
            363 => 
            array (
                'id' => 5311,
                'country_id' => 4,
                'name' => 'Western Tutuila',
                'code' => 'WT',
                'adm1code' => '',
            ),
            364 => 
            array (
                'id' => 5312,
                'country_id' => 4,
                'name' => 'Manu\'a',
                'code' => 'MA',
                'adm1code' => '',
            ),
            365 => 
            array (
                'id' => 5313,
                'country_id' => 30,
                'name' => 'Brcko District',
                'code' => 'BR',
                'adm1code' => 'BKBD',
            ),
            366 => 
            array (
                'id' => 5314,
                'country_id' => 28,
                'name' => 'Tashi Yangtse',
                'code' => 'TY',
                'adm1code' => '',
            ),
            367 => 
            array (
                'id' => 5315,
                'country_id' => 28,
                'name' => 'Gasa',
                'code' => 'GA',
                'adm1code' => '',
            ),
            368 => 
            array (
                'id' => 5316,
                'country_id' => 26,
                'name' => 'Plateau',
                'code' => 'PL',
                'adm1code' => '',
            ),
            369 => 
            array (
                'id' => 5317,
                'country_id' => 26,
                'name' => 'Littoral',
                'code' => 'LI',
                'adm1code' => '',
            ),
            370 => 
            array (
                'id' => 5318,
                'country_id' => 26,
                'name' => 'Donga',
                'code' => 'DO',
                'adm1code' => '',
            ),
            371 => 
            array (
                'id' => 5319,
                'country_id' => 26,
                'name' => 'Couffo',
                'code' => 'CF',
                'adm1code' => '',
            ),
            372 => 
            array (
                'id' => 5320,
                'country_id' => 26,
                'name' => 'Collines',
                'code' => 'CL',
                'adm1code' => '',
            ),
            373 => 
            array (
                'id' => 5321,
                'country_id' => 26,
                'name' => 'Alibori',
                'code' => 'AL',
                'adm1code' => '',
            ),
            374 => 
            array (
                'id' => 5322,
                'country_id' => 90,
                'name' => 'Guria',
                'code' => 'GU',
                'adm1code' => '',
            ),
            375 => 
            array (
                'id' => 5323,
                'country_id' => 90,
                'name' => 'Imereti',
                'code' => 'IM',
                'adm1code' => '',
            ),
            376 => 
            array (
                'id' => 5324,
                'country_id' => 90,
                'name' => 'Kakheti',
                'code' => 'KA',
                'adm1code' => '',
            ),
            377 => 
            array (
                'id' => 5325,
                'country_id' => 90,
                'name' => 'Kvemo Kartli',
                'code' => 'KK',
                'adm1code' => '',
            ),
            378 => 
            array (
                'id' => 5327,
                'country_id' => 90,
                'name' => 'Mtskheta-Mtianeti',
                'code' => 'MM',
                'adm1code' => '',
            ),
            379 => 
            array (
                'id' => 5328,
                'country_id' => 90,
                'name' => 'Racha-Lochkhumi-Kvemo Svaneti',
                'code' => 'RL',
                'adm1code' => '',
            ),
            380 => 
            array (
                'id' => 5329,
                'country_id' => 90,
                'name' => 'Samegrelo-Zemo Svateni',
                'code' => 'SZ',
                'adm1code' => '',
            ),
            381 => 
            array (
                'id' => 5330,
                'country_id' => 90,
                'name' => 'Samtskhe-Javakheti',
                'code' => 'SJ',
                'adm1code' => '',
            ),
            382 => 
            array (
                'id' => 5331,
                'country_id' => 90,
                'name' => 'Shida Kartli',
                'code' => 'SK',
                'adm1code' => '',
            ),
            383 => 
            array (
                'id' => 5332,
                'country_id' => 165,
                'name' => 'Govi-Sumber',
                'code' => 'GS',
                'adm1code' => 'MG24',
            ),
            384 => 
            array (
                'id' => 5333,
                'country_id' => 165,
                'name' => 'Darhan Uul',
                'code' => 'DA',
                'adm1code' => 'MG23',
            ),
            385 => 
            array (
                'id' => 5334,
                'country_id' => 132,
                'name' => 'Najin Sonbong-si',
                'code' => 'NJ',
                'adm1code' => 'KN18',
            ),
            386 => 
            array (
                'id' => 5335,
                'country_id' => 74,
                'name' => 'Anseba',
                'code' => 'AN',
                'adm1code' => '',
            ),
            387 => 
            array (
                'id' => 5336,
                'country_id' => 74,
                'name' => 'Semenawi Keyih Bahri',
                'code' => 'SK',
                'adm1code' => '',
            ),
            388 => 
            array (
                'id' => 5337,
                'country_id' => 74,
                'name' => 'Maekel',
                'code' => 'MA',
                'adm1code' => '',
            ),
            389 => 
            array (
                'id' => 5338,
                'country_id' => 74,
                'name' => 'Gash Barka',
                'code' => 'GB',
                'adm1code' => '',
            ),
            390 => 
            array (
                'id' => 5339,
                'country_id' => 74,
                'name' => 'Debubawi Keyih Bahri',
                'code' => 'DK',
                'adm1code' => '',
            ),
            391 => 
            array (
                'id' => 5340,
                'country_id' => 74,
                'name' => 'Debub',
                'code' => 'DU',
                'adm1code' => '',
            ),
            392 => 
            array (
                'id' => 5341,
                'country_id' => 44,
                'name' => 'Mosteiros',
                'code' => 'MO',
                'adm1code' => '',
            ),
            393 => 
            array (
                'id' => 5342,
                'country_id' => 44,
                'name' => 'Porto Novo',
                'code' => 'PN',
                'adm1code' => '',
            ),
            394 => 
            array (
                'id' => 5343,
                'country_id' => 44,
                'name' => 'Santa Cruz',
                'code' => 'SZ',
                'adm1code' => '',
            ),
            395 => 
            array (
                'id' => 5344,
                'country_id' => 44,
                'name' => 'SÃ£o Domingos',
                'code' => 'SD',
                'adm1code' => '',
            ),
            396 => 
            array (
                'id' => 5345,
                'country_id' => 44,
                'name' => 'SÃ£o Filipe',
                'code' => 'SF',
                'adm1code' => '',
            ),
            397 => 
            array (
                'id' => 5346,
                'country_id' => 38,
                'name' => 'BalÃ©',
                'code' => 'BA',
                'adm1code' => '',
            ),
            398 => 
            array (
                'id' => 5347,
                'country_id' => 38,
                'name' => 'Banwa',
                'code' => 'BW',
                'adm1code' => '',
            ),
            399 => 
            array (
                'id' => 5348,
                'country_id' => 38,
                'name' => 'Ioba',
                'code' => 'IO',
                'adm1code' => '',
            ),
            400 => 
            array (
                'id' => 5349,
                'country_id' => 38,
                'name' => 'Komondjari',
                'code' => 'KJ',
                'adm1code' => '',
            ),
            401 => 
            array (
                'id' => 5350,
                'country_id' => 38,
                'name' => 'Kompienga',
                'code' => 'KP',
                'adm1code' => '',
            ),
            402 => 
            array (
                'id' => 5351,
                'country_id' => 38,
                'name' => 'KoulpÃ©logo',
                'code' => 'KL',
                'adm1code' => '',
            ),
            403 => 
            array (
                'id' => 5352,
                'country_id' => 38,
                'name' => 'KourwÃ©ogo',
                'code' => 'KW',
                'adm1code' => '',
            ),
            404 => 
            array (
                'id' => 5353,
                'country_id' => 38,
                'name' => 'LÃ©raba',
                'code' => 'LE',
                'adm1code' => '',
            ),
            405 => 
            array (
                'id' => 5354,
                'country_id' => 38,
                'name' => 'Loroum',
                'code' => 'LO',
                'adm1code' => '',
            ),
            406 => 
            array (
                'id' => 5355,
                'country_id' => 38,
                'name' => 'Nayala',
                'code' => 'NY',
                'adm1code' => '',
            ),
            407 => 
            array (
                'id' => 5356,
                'country_id' => 38,
                'name' => 'Noumbiel',
                'code' => 'NB',
                'adm1code' => '',
            ),
            408 => 
            array (
                'id' => 5357,
                'country_id' => 38,
                'name' => 'Tui',
                'code' => 'TU',
                'adm1code' => '',
            ),
            409 => 
            array (
                'id' => 5358,
                'country_id' => 38,
                'name' => 'Yagha',
                'code' => 'YG',
                'adm1code' => '',
            ),
            410 => 
            array (
                'id' => 5359,
                'country_id' => 38,
                'name' => 'Ziro',
                'code' => 'ZR',
                'adm1code' => '',
            ),
            411 => 
            array (
                'id' => 5360,
                'country_id' => 38,
                'name' => 'Zondoma',
                'code' => 'ZM',
                'adm1code' => '',
            ),
            412 => 
            array (
                'id' => 5361,
                'country_id' => 97,
                'name' => 'Carriacou',
                'code' => 'CA',
                'adm1code' => '',
            ),
            413 => 
            array (
                'id' => 5362,
                'country_id' => 140,
                'name' => 'River Gee',
                'code' => 'RG',
                'adm1code' => '',
            ),
            414 => 
            array (
                'id' => 5363,
                'country_id' => 140,
                'name' => 'Gbarpolu',
                'code' => 'GP',
                'adm1code' => '',
            ),
            415 => 
            array (
                'id' => 5364,
                'country_id' => 238,
                'name' => 'Pwani',
                'code' => 'PW',
                'adm1code' => 'TZ02',
            ),
            416 => 
            array (
                'id' => 5365,
                'country_id' => 246,
                'name' => 'DÃ¼zce',
                'code' => 'DU',
                'adm1code' => 'TU93',
            ),
            417 => 
            array (
                'id' => 5366,
                'country_id' => 245,
                'name' => 'Manouba',
                'code' => 'MN',
                'adm1code' => '',
            ),
            418 => 
            array (
                'id' => 5367,
                'country_id' => 151,
                'name' => 'Kidal',
                'code' => 'KD',
                'adm1code' => '',
            ),
            419 => 
            array (
                'id' => 5368,
                'country_id' => 184,
                'name' => 'Rota',
                'code' => 'RO',
                'adm1code' => '',
            ),
            420 => 
            array (
                'id' => 5369,
                'country_id' => 184,
                'name' => 'Saipan',
                'code' => 'SA',
                'adm1code' => '',
            ),
            421 => 
            array (
                'id' => 5370,
                'country_id' => 184,
                'name' => 'Tinian',
                'code' => 'TA',
                'adm1code' => '',
            ),
            422 => 
            array (
                'id' => 5371,
                'country_id' => 204,
                'name' => 'Kigali-Ville',
                'code' => 'KV',
                'adm1code' => '',
            ),
            423 => 
            array (
                'id' => 5372,
                'country_id' => 204,
                'name' => 'Umutara',
                'code' => 'UM',
                'adm1code' => '',
            ),
            424 => 
            array (
                'id' => 5373,
                'country_id' => 155,
                'name' => 'TrinitÃ©',
                'code' => 'TR',
                'adm1code' => '',
            ),
            425 => 
            array (
                'id' => 5374,
                'country_id' => 155,
                'name' => 'Saint-Pierre',
                'code' => 'SP',
                'adm1code' => '',
            ),
            426 => 
            array (
                'id' => 5375,
                'country_id' => 155,
                'name' => 'Marin',
                'code' => 'MA',
                'adm1code' => '',
            ),
            427 => 
            array (
                'id' => 5376,
                'country_id' => 155,
                'name' => 'Fort-de-France',
                'code' => 'FF',
                'adm1code' => '',
            ),
            428 => 
            array (
                'id' => 5377,
                'country_id' => 163,
                'name' => 'Taraclia',
                'code' => 'TR',
                'adm1code' => '',
            ),
            429 => 
            array (
                'id' => 5378,
                'country_id' => 148,
                'name' => 'Phalombe',
                'code' => 'PH',
                'adm1code' => '',
            ),
            430 => 
            array (
                'id' => 5379,
                'country_id' => 148,
                'name' => 'Likoma',
                'code' => 'LK',
                'adm1code' => '',
            ),
            431 => 
            array (
                'id' => 5380,
                'country_id' => 148,
                'name' => 'Balaka',
                'code' => 'BA',
                'adm1code' => '',
            ),
            432 => 
            array (
                'id' => 5381,
                'country_id' => 149,
                'name' => 'Putrajaya',
                'code' => 'PJ',
                'adm1code' => '',
            ),
            433 => 
            array (
                'id' => 5382,
                'country_id' => 84,
                'name' => 'Saint-Laurent-du-Maroni',
                'code' => 'SL',
                'adm1code' => '',
            ),
            434 => 
            array (
                'id' => 5383,
                'country_id' => 84,
                'name' => 'Cayenne',
                'code' => 'CY',
                'adm1code' => '',
            ),
            435 => 
            array (
                'id' => 5384,
                'country_id' => 261,
                'name' => 'Saint Thomas',
                'code' => 'ST',
                'adm1code' => '',
            ),
            436 => 
            array (
                'id' => 5385,
                'country_id' => 261,
                'name' => 'Saint John',
                'code' => 'SJ',
                'adm1code' => '',
            ),
            437 => 
            array (
                'id' => 5386,
                'country_id' => 261,
                'name' => 'Saint Croix',
                'code' => 'SC',
                'adm1code' => '',
            ),
            438 => 
            array (
                'id' => 5387,
                'country_id' => 275,
                'name' => 'West Bank',
                'code' => 'WE',
                'adm1code' => '',
            ),
            439 => 
            array (
                'id' => 5388,
                'country_id' => 275,
                'name' => 'Gaza',
                'code' => 'GZ',
                'adm1code' => '',
            ),
            440 => 
            array (
                'id' => 5389,
                'country_id' => 253,
                'name' => 'Wales',
                'code' => 'WA',
                'adm1code' => '',
            ),
            441 => 
            array (
                'id' => 5390,
                'country_id' => 253,
                'name' => 'Scotland',
                'code' => 'SC',
                'adm1code' => '',
            ),
            442 => 
            array (
                'id' => 5391,
                'country_id' => 253,
                'name' => 'Northern Ireland',
                'code' => 'NI',
                'adm1code' => '',
            ),
            443 => 
            array (
                'id' => 5392,
                'country_id' => 253,
                'name' => 'England',
                'code' => 'EN',
                'adm1code' => '',
            ),
            444 => 
            array (
                'id' => 5393,
                'country_id' => 240,
                'name' => 'Centre',
                'code' => 'CE',
                'adm1code' => '',
            ),
            445 => 
            array (
                'id' => 5394,
                'country_id' => 240,
                'name' => 'Kara',
                'code' => 'KA',
                'adm1code' => '',
            ),
            446 => 
            array (
                'id' => 5395,
                'country_id' => 240,
                'name' => 'Maritime',
                'code' => 'MA',
                'adm1code' => '',
            ),
            447 => 
            array (
                'id' => 5396,
                'country_id' => 240,
                'name' => 'Plateaux',
                'code' => 'PL',
                'adm1code' => '',
            ),
            448 => 
            array (
                'id' => 5397,
                'country_id' => 240,
                'name' => 'Savanes',
                'code' => 'SA',
                'adm1code' => '',
            ),
            449 => 
            array (
                'id' => 5398,
                'country_id' => 221,
                'name' => 'Imo',
                'code' => 'IM',
                'adm1code' => 'NI28',
            ),
            450 => 
            array (
                'id' => 5399,
                'country_id' => 181,
                'name' => 'Katsina',
                'code' => 'KT',
                'adm1code' => 'NI24',
            ),
        ));
        
        
    }
}
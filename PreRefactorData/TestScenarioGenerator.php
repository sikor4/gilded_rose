<?php

namespace App\PreRefactorData;

use App\GildedRose;
use App\Item;

class TestScenarioGenerator
{
    public function __construct(){}
    
    public function generateSnapshotAndSaveToFile($filePath): void
    {        
        if (file_exists($filePath)) {
            echo "Snapshot exists. Skipping" . PHP_EOL;
            die;
        }

        $results = $this->generateSnapshot();

        file_put_contents($filePath, json_encode($results));
        
        echo "Snapshot created with " . count($results) . " records" . PHP_EOL;
        die;
    }

    private function generateSnapshot(): array
    {
        $results = [];
        $names = [
            'Aged Brie', 
            'Backstage passes to a TAFKAL80ETC concert', 
            'Sulfuras, Hand of Ragnaros', 
            'Elixir of the Mongoose'
        ];

        $sellIns = range(-11, 11);
        $qualities = range(-1, 81);

        foreach ($names as $key => $name) {
            foreach ($sellIns as $sellIn) {
                foreach ($qualities as $quality) {

                    $item = new Item($name, $sellIn, $quality);
                    $gildedRose = new GildedRose();
                    $gildedRose->updateQuality($item);

                    $results[] = [
                        'initial' => [
                            'name' => $name, 
                            'sellIn' => $sellIn, 
                            'quality' => $quality
                        ],

                        'result' => [
                            'sellIn' => $item->sell_in, 
                            'quality' => $item->quality
                        ]
                    ];
                }
            }
        }

        return $results; 
    }
}

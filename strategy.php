<?php

namespace DesignPatterns;

/**
 * - sorting a list of objects, one strategy by date, the other by id
 * - simplify unit testing: e.g. switching between file and in-memory storage
 *
 */

interface Comparator
{
    public function compare($a, $b);
}

class ObjectCollection
{
    private $_elements;
    private $_comparator;

    public function __construct(array $elements = array())
    {
        $this->_elements = $elements;
    }

    public function sort()
    {
        $callback = array($this->_comparator, 'compare');
        uasort($this->_elements, $callback);
        return $this->_elements;
    }

    public function setComparator(Comparator $comparator)
    {
        $this->_comparator = $comparator;
    }
}

class IdComparator implements Comparator
{
    public function compare($a, $b)
    {
        if ($a['id'] == $b['id']) {
            return 0;
        } else {
            return $a['id'] < $b['id'] ? -1 : 1;
        }
    }
}

class DateComparator implements Comparator
{
    public function compare($a, $b)
    {
        $aDate = strtotime($a['date']);
        $bDate = strtotime($b['date']);

        if ($aDate == $bDate) {
            return 0;
        } else {
            return $aDate < $bDate ? -1 : 1;
        }
    }
}

$elements = array(
    array(
        'id' => 2,
        'date' => '2011-01-01',
    ),
    array(
        'id' => 1,
        'date' => '2011-02-01'
    )
);

$collection = new ObjectCollection($elements);
$collection->setComparator(new IdComparator());
$sort_order_1 = $collection->sort();
echo "Test 1\n";
print_r($sort_order_1);
echo "\n\n";
echo "Test 2\n";
$collection->setComparator(new DateComparator());
$sort_order_2 = $collection->sort();
print_r($sort_order_2);
echo "\n";

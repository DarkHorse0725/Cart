<?php namespace Moltin\Cart;

class Item
{
    protected $identifier;
    protected $store;

    protected $id;
    protected $name;
    protected $quantity;
    protected $price;

    /**
     * Construct the item
     * 
     * @param string           $identifier
     * @param array            $item
     * @param StorageInterface $store
     */
    public function __construct($identifier, array $item, StorageInterface $store)
    {
        $this->identifier = $identifier;
        $this->store = $store;

        if (array_key_exists('identifier', $item)) {
            throw new InvalidArgumentException("'identifier' is a disallowed key for cart items");
        }

        foreach ($item as $key => $value) $this->$key = $value;
    }

    /**
     * Return the value of protected methods
     * 
     * @param  any $param
     * @return mixed
     */
    public function __get($param)
    {
        return $this->$param;
    }

    /**
     * Removes the current item from the cart
     * 
     * @return void
     */
    public function remove()
    {
        $this->store->remove($this->identifier);
    }
}
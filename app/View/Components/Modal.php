<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Modal extends Component
{
    /**
     * The Modal ID
     *
     * @var string
     */
    public string $id;

    public bool $open;

    /**
     * Create the component instance.
     *
     * @param string $id
     * @param bool $open
     */
    public function __construct(string $id, bool $open = false)
    {
        $this->id = "Modal-$id";
        $this->open = $open;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.modal');
    }
}

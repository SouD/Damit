<?php
namespace Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractFormRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $guardName = 'api';

    /**
     * @return string
     */
    public function getGuardName(): string
    {
        return $this->guardName;
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $guardName = $this->getGuardName();

        if ($this->user($guardName) && $this->user($guardName)->isAdmin()) {
            return true;
        }

        return $this->check();
    }

    /**
     * @return bool
     */
    abstract public function check(): bool;

    /**
     * @return array
     */
    abstract public function rules(): array;
}

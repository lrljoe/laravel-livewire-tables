<?php

namespace Rappasoft\LaravelLivewireTables\Features\Core;

use Illuminate\View\ComponentAttributeBag;

trait HandlesCoreAttributes
{
    
    protected function checkItemAttributeArrays($attributeArray): array
    {
        foreach($attributeArray as $index => $arrayItem)
        {
            if(is_array($arrayItem))
            {
                $attributeArray[$index] = null;
            }
        }
        return $attributeArray;
    }

    protected function setInternalAttribute(string $propertyName, array $attributeArray): self
    {
        $this->{$propertyName} = [...$this->{$propertyName}, ...$this->checkItemAttributeArrays($attributeArray)];
        
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @return boolean
     */
    public function hasCustomAttributes(string $propertyName): bool
    {
        return property_exists($this, $propertyName) && isset($this->{$propertyName});
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param boolean $default
     * @param boolean $classicMode
     * @return array<mixed>
     */
    public function getCustomAttributes(string $propertyName, bool $default = false, bool $classicMode = true): array
    {
        if ($classicMode) {
            if ($this->hasCustomAttributes($propertyName)) {
                $vals = array_merge(['default' => $default, 'default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);

                return $vals;
            }

            return ['default' => $default, 'default-colors' => $default, 'default-styling' => $default];
        } else {
            if ($this->hasCustomAttributes($propertyName)) {
                $vals = array_merge(['default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);

                return $vals;
            }

            return ['default-colors' => $default, 'default-styling' => $default];

        }
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @return ComponentAttributeBag
     */
    public function getCustomAttributesBag(string $propertyName): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getCustomAttributes($propertyName));
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param array<mixed> $customAttributes
     * @return self
     */
    protected function setCustomAttributes(string $propertyName, array $customAttributes): self
    {
        $customAttributes = $this->checkItemAttributeArrays($customAttributes);
        $this->{$propertyName} = $customAttributes;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param array<mixed> $customAttributes
     * @return self
     */
    protected function mergeCustomAttributes(string $propertyName, array $customAttributes): self
    {
        $customAttributes = $this->checkItemAttributeArrays($customAttributes);
        $mergedArray = array_merge($this->{$propertyName}, $customAttributes);
        ksort($mergedArray);
        $this->{$propertyName} = $mergedArray;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param array<mixed> $customAttributes
     * @return self
     */
    protected function mergeCustomAttributesClassic(string $propertyName, array $customAttributes): self
    {
        $attributes = [...$this->getCustomAttributes(propertyName: $propertyName, default: false, classicMode: true), ...$customAttributes];
        ksort($attributes);

        return $this->setCustomAttributes($propertyName, $attributes);
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param array<mixed> $customAttributes
     * @return self
     */
    protected function mergeCustomAttributesModern(string $propertyName, array $customAttributes): self
    {
        $attributes = [...$this->getCustomAttributes(propertyName: $propertyName, default: false, classicMode: false), ...$customAttributes];
        ksort($attributes);

        return $this->setCustomAttributes($propertyName, $attributes);
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributesArray
     * @return ComponentAttributeBag
     */
    public function getCustomAttributesBagFromArray(array $attributesArray): ComponentAttributeBag
    {
        return new ComponentAttributeBag($attributesArray);
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param boolean $default
     * @param boolean $classicMode
     * @return array<mixed>
     */
    public function getCustomAttributesNew(string $propertyName, bool $default = false, bool $classicMode = true): array
    {

        if ($classicMode) {
            $defaultItems = ['default', 'default-colors', 'default-styling'];

            if ($this->hasCustomAttributes($propertyName)) {
                $vals = $this->{$propertyName};

                foreach ($defaultItems as $defaultItem) {
                    if (! array_key_exists($defaultItem, $vals) || is_null($vals[$defaultItem])) {
                        $vals[$defaultItem] = $default;
                    }
                }

                ksort($vals);

                return $vals;
            }

            return ['default' => $default, 'default-colors' => $default, 'default-styling' => $default];
        } else {
            $defaultItems = ['default-colors', 'default-styling'];

            if ($this->hasCustomAttributes($propertyName)) {
                $vals = $this->{$propertyName};
                foreach ($defaultItems as $defaultItem) {
                    if (! array_key_exists($defaultItem, $vals) || is_null($vals[$defaultItem])) {
                        $vals[$defaultItem] = $default;
                    }
                }

                ksort($vals);

                return $vals;
            }

            return ['default-colors' => $default, 'default-styling' => $default];

        }
    }

    /**
     * Undocumented function
     *
     * @param string $propertyName
     * @param array<mixed> $customAttributes
     * @param boolean $default
     * @param boolean $classicMode
     * @return self
     */
    protected function setCustomAttributesDefaults(string $propertyName, array $customAttributes, bool $default = false, bool $classicMode = true): self
    {

        $this->{$propertyName} = array_merge($this->getCustomAttributesNew(propertyName: $propertyName, default: $default, classicMode: $classicMode), $customAttributes);

        return $this;
    }

}

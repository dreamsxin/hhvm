<?hh <<__EntryPoint>> function main(): void {
var_dump(
  array_map(
    NULL,
    array(1,2,3),
    array(4,5,6),
    array(7,8,9)
  )
);
}

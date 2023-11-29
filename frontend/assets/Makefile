SRC = $(wildcard jsx/*.js)
LIB = $(SRC:jsx/%.js=js/%.js)

lib: $(LIB)
lib/%.js: jsx/%.js babel.config.json
  mkdir -p $(@D)
  babel $< -o $@

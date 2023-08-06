INCLUDE_PATH = include
CXXFLAGS = -I./include -O2

EXE_CHECKER = \
	builtin/checker/lcmp \
	builtin/checker/casencmp \
	builtin/checker/rcmp6 \
	builtin/checker/dcmp \
	builtin/checker/rcmp4 \
	builtin/checker/casewcmp \
	builtin/checker/acmp \
	builtin/checker/fcmp \
	builtin/checker/rncmp \
	builtin/checker/icmp \
	builtin/checker/rcmp9 \
	builtin/checker/uncmp \
	builtin/checker/rcmp \
	builtin/checker/hcmp \
	builtin/checker/yesno \
	builtin/checker/caseicmp \
	builtin/checker/wcmp \
	builtin/checker/ncmp \
	builtin/checker/nyesno

EXE = main_judger \
	run/formatter \
	run/run_program \
	run/run_interaction \
	builtin/judger/judger

all: $(EXE) $(EXE_CHECKER)
runner: $(EXE)
checker: $(EXE_CHECKER)

% : %.cpp
	$(CXX) $(CXXFLAGS) $(EXTRA_CXXFLAGS) $< -o $@

run/run_program: include/uoj_env.h run/run_program_conf.h
run/formatter  : include/testlib.h
run/run_interaction: run/run_interaction.cpp include/uoj_env.h
	$(CXX) $(CXXFLAGS) --std=c++11 -pthread $< -o $@

builtin/judger/judger: include
main_judger: include

$(EXE_CHECKER): include/testlib.h

clean:
	rm -f $(EXE) $(EXE_CHECKER)

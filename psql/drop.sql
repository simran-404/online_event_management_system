-- Drop feedback table first (no dependencies)
DROP TABLE IF EXISTS feedback CASCADE;
-- Drop transaction table (depends on event)
DROP TABLE IF EXISTS transaction CASCADE;
-- Drop catering table (depends on event)
DROP TABLE IF EXISTS catering CASCADE;
-- Drop flower table (depends on decoration)
DROP TABLE IF EXISTS flower CASCADE;
-- Drop decoration table (depends on event)
DROP TABLE IF EXISTS decoration CASCADE;
-- Drop activity table (depends on event)
DROP TABLE IF EXISTS activity CASCADE;
-- Drop event table (depends on customer and package)
DROP TABLE IF EXISTS event CASCADE;
-- Drop package table (no dependencies)
DROP TABLE IF EXISTS package CASCADE;
-- Drop login table (no dependencies)
DROP TABLE IF EXISTS login CASCADE;
-- Drop customer table (no dependencies)
DROP TABLE IF EXISTS customer CASCADE;

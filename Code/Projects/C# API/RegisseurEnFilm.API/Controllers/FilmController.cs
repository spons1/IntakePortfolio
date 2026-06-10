using Microsoft.AspNetCore.Mvc;
using RegisseurEnFilm.API.DTO.Films;
using RegisseurEnFilm.API.Repositories;

namespace RegisseurEnFilm.API.Controllers
{

    [ApiController]
    [Route("api/[controller]")]
    public class FilmController : Controller
    {
        private readonly FilmRepository filmRepository;

        public FilmController(FilmRepository filmRepository) 
        {
            this.filmRepository = filmRepository;
        }

        [HttpGet]
        public ActionResult<IEnumerable<FilmListItem>> GetAllFilms()
        {
            var films = filmRepository.geefAlleFilms();
            return Ok(films);
        }

        [HttpGet("search/{titel}")]
        public ActionResult<IEnumerable<FilmListItem>> ZoekFilms([FromQuery] string titel)
        {
            var films = filmRepository.ZoekNaarFilm(titel);
            return Ok(films);
        }

        [HttpGet("id")]
        public ActionResult<IEnumerable<FilmDetailItem>> GetFilmById(int id) 
        {
            var film = filmRepository.GeefFilmById(id);
            if (film == null) return NotFound();

            return Ok(film);
        }

        [HttpPost]
        public IActionResult MaakFilmAan([FromBody] FilmCreateRequest request)
        {
            filmRepository.maakFilmAan(request);
            return CreatedAtAction(nameof(GetFilmById), new { id = request.Titel }, request);
        }

        [HttpPut("id")]
        public IActionResult UpdateFilm(int id, [FromBody] FilmUpdateRequest request)
        {
            var updated = filmRepository.UpdateFilm(id, request);
            if (!updated) 
            { 
                return NotFound(); 
            }

            return NoContent();
        }

        [HttpDelete("id")]
        public IActionResult VerwijderFilm(int id)
        {
            var deleted = filmRepository.DeleteFilm(id);
            if (!deleted)
                return NotFound(); 

            return NoContent();
        }

    }
}
